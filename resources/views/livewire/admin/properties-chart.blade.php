<div>
    <div class="flex w-full p-1">
        <p class="pl-3 mr-auto text-sm">Properties</p>

        <div id="chart-legend">
            <x-chart-color-text text="Houses" color="bg-[#2563eb]" />

            <x-chart-color-text text="Appartements" color="bg-[#ef4444]" />

            <x-chart-color-text text="Offices" color="bg-[#16a34a]" />
        </div>
    </div>

    <div class="w-full bg-gray-800 rounded-[10px] p-4" wire:loading.class="opacity-30">
        <div class="pb-4">
            <select wire:change="updatePieChart($event.target.value)" name="PropertyTypeChart" id="property-type-chart" class="bg-gray-900 rounded-[10px] pl-2 p-1 pr-8 text-sm">
                <option selected value="Available">Available</option>
                <option value="Sold">Sold</option>
                <option value="Rented">Rented</option>
                <option value="Removed">Removed</option>
                <option value="Unavailable">Unavailable</option>
            </select>
        </div>

        <div class="ct-chart h-[300px] w-full mb-auto"></div>

        <div id="mobile-chart-legend" class="flex items-center w-full justify-evenly">
            <x-chart-color-text text="Houses" color="bg-[#2563eb]" />

            <x-chart-color-text text="Appartements" color="bg-[#ef4444]" />

            <x-chart-color-text text="Offices" color="bg-[#16a34a]" />
        </div>
    </div>

    @script
        <script>
            $wire.on('updateDonutChart', (data) => {
                let donutChartData = {
                    labels: data[0].labels,
                    series: data[0].series,
                };

                let responsiveOptions = [
                    ['screen and (min-width: 640px)', {
                        chartPadding: 30,
                        labelOffset: 20,
                        labelDirection: 'explode',
                        labelInterpolationFnc: function(value, index) {
                            var total = donutChartData.series.reduce((a, b) => a + b, 0);
                            var percentage = Math.round((donutChartData.series[index] / total) * 100) + '%';
                            return value + ' (' + percentage + ')';  // Display label with percentage
                        }
                    }],
                    ['screen and (min-width: 1024px)', {
                        labelOffset: 70,
                        chartPadding: 40,
                        labelInterpolationFnc: function(value, index) {
                            var total = donutChartData.series.reduce((a, b) => a + b, 0);
                            var percentage = Math.round((donutChartData.series[index] / total) * 100) + '%';
                            return value + ' (' + percentage + ')'; // Display label with percentage
                        }
                    }]
                ];

                var donutChart = new Chartist.Pie('.ct-chart', donutChartData, {
                    donut: true,
                    donutWidth: 100,
                    startAngle: 0,
                    showLabel: true,
                    chartPadding: 10,
                }, responsiveOptions);

                donutChart.on('draw', function (data) {
                    if (data.type === 'slice') {
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
                                dur: 1000,
                                from: -pathLength + 'px',
                                to: '0px',
                                easing: Chartist.Svg.Easing.easeOutQuint,
                                fill: 'freeze',
                            },
                        };

                        if (data.index !== 0) {
                            animationDefinition['stroke-dashoffset'].begin = 'anim' + (data.index - 1) + '.end';
                        }

                        data.element.animate(animationDefinition, false);
                    }
                });

                let timerId;

                donutChart.on('created', function () {
                    if (timerId) {
                        clearTimeout(timerId);
                    }
                });
            });
        </script>
    @endscript
</div>
