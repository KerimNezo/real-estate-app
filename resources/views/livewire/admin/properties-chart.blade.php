<div>
    <div class="flex w-full p-1">
        <p class="pl-3 mr-auto text-sm">
            @if (Auth::user()->hasRole('agent'))
                Your properties
            @else
                Properties
            @endif
        </p>
    </div>

    <div class="w-full bg-gray-800 rounded-[10px] p-4" wire:loading.class="opacity-30">
        <div class="pb-4">
            <select wire:loading.attr="disabled" wire:change="updateChartData($event.target.value)" name="PropertyTypeChart" id="property-type-chart" class="bg-gray-900 rounded-[10px] pl-2 p-1 pr-8 text-sm">
                <option selected value="Available">Available</option>
                <option value="Sold">Sold</option>
                <option value="Rented">Rented</option>
                <option value="Removed">Removed</option>
                <option value="Unavailable">Unavailable</option>
            </select>
        </div>

        <div id="propertiesChart" class="ct-chart h-[300px] w-full mb-auto flex justify-center items-center" wire:ignore></div>
    </div>

    @script
        <script>
            let wasEmpty = false;
            let donutChart = null;

            $wire.on('updateDonutChart', (data) => {
                const chartContainer = document.getElementById('propertiesChart');

                // Clear previous chart content and remove event listeners
                if (chartContainer) {
                    chartContainer.innerHTML = ''; // Reset the container
                }

                // Log the incoming data for debugging
                console.log('Incoming Data:', data);

                // If there's no data, display a message and exit
                if (data[0].labels.length === 0 || data[0].series.length === 0) {
                    chartContainer.innerHTML = '<p class="text-center text-gray-500">No data available for the selected properties</p>';
                    console.log('No data available, displaying message');
                    wasEmpty = true;
                    return;
                }

                // Define chart data based on the incoming data
                const donutChartData = {
                    labels: data[0].labels,
                    series: data[0].series,
                };

                // Log the chart data
                console.log('Chart Data:', donutChartData);

                // Define responsive options
                const responsiveOptions = [
                    ['screen and (min-width: 640px)', {
                        chartPadding: 30,
                        labelOffset: 20,
                        labelDirection: 'explode',
                        labelInterpolationFnc: function(value, index) {
                            const total = donutChartData.series.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((donutChartData.series[index] / total) * 100) + '%';
                            return value + ' (' + percentage + ')';
                        }
                    }],
                    ['screen and (min-width: 1024px)', {
                        labelOffset: 70,
                        chartPadding: 40,
                        labelInterpolationFnc: function(value, index) {
                            const total = donutChartData.series.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((donutChartData.series[index] / total) * 100) + '%';
                            return value + ' (' + percentage + ')';
                        }
                    }]];

                // Initialize the donut chart
                const donutChart = new Chartist.Pie('.ct-chart', donutChartData, {
                    donut: true,
                    donutWidth: 100,
                    startAngle: 0,
                    showLabel: true,
                    chartPadding: 10,
                }, responsiveOptions);

                donutChart.on('draw', function(data) {
                    if (data.type === 'slice') {
                        console.log('Animating slice:', data);

                        const node = data.element.getNode();
                        if (!node || typeof node.getTotalLength !== 'function') {
                            console.error('SVG node not valid or getTotalLength not supported.');
                            return;
                        }

                        const pathLength = node.getTotalLength();
                        data.element.attr({
                            'stroke-dasharray': `${pathLength}px ${pathLength}px`,
                            'stroke-dashoffset': `${-pathLength}px`,
                        });

                        const animationDefinition = {
                            'stroke-dashoffset': {
                                id: 'anim' + data.index,
                                dur: 2000,
                                from: -pathLength + 'px',
                                to: '0px',
                                easing: Chartist.Svg.Easing.easeOutQuint,
                                fill: 'freeze',
                            },
                        };

                        if (data.index !== 0) {
                            animationDefinition['stroke-dashoffset'].begin = 'anim' + (data.index - 1) + '.end';
                        }

                        setTimeout(() => {
                            data.element.animate(animationDefinition, false);
                        });
                    }
                });

                // Conditionally force a redraw if the previous state was empty
                if (wasEmpty) {
                    setTimeout(() => {
                        donutChart.update();
                    }, 5);
                }
            });

            wasEmpty = false;
        </script>
    @endscript
</div>
