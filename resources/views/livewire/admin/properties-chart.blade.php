<div>
    <div class="flex w-full p-1">
        <p class="pl-3 mr-auto text-sm">Properties</p>

        <x-chart-color-text text="Houses" color="bg-[#2563eb]" />

        <x-chart-color-text text="Appartements" color="bg-[#ef4444]" />

        <x-chart-color-text text="Offices" color="bg-[#16a34a]" />
    </div>

    <div class="w-full bg-gray-800 rounded-[10px] p-4">
        <div class="pb-4">
            <select name="PropertyTypeChart" id="property-type-chart" class="bg-gray-900 rounded-[10px] pl-2 p-1 pr-8 text-sm">
                <option wire:click="updatePieChart()" selected value="Available">Available</option>
                <option wire:click="updatePieChart()" value="Sold">Sold</option>
                <option wire:click="updatePieChart()" value="Rented">Rented</option>
            </select>
        </div>

        <div class="ct-chart h-[300px] w-full mb-auto"></div>
    </div>

    @script
        <script>
            let pieData = {
                labels: ['Houses', 'Apartments', 'Offices'], // prvi label odgovara prvoj series value
                series: [20, 14, 10],
            };

            $wire.on('updatePieChart', (data) => {
                let pieData = {
                    labels: data[0].labels,
                    series: data[0].series,
                }

                let responsiveOptions = [
                    ['screen and (min-width: 640px)', {
                        chartPadding: 30,
                        labelOffset: 100,
                        labelDirection: 'explode',
                        labelInterpolationFnc: function(value, index) {
                            var total = pieData.series.reduce((a, b) => a + b, 0);
                            var percentage = Math.round((pieData.series[index] / total) * 100) + '%';
                            return value + ' (' + percentage + ')';
                        }
                    }],
                    ['screen and (min-width: 1024px)', {
                        labelOffset: 80,
                        chartPadding: 20
                    }]
                ];

                var pitaChart = new Chartist.Pie('.ct-chart', pieData, {
                    labelInterpolationFnc: function(value, index) {
                        var total = pieData.series.reduce((a, b) => a + b, 0);
                        var percentage = Math.round((pieData.series[index] / total) * 100) + '%';
                        return percentage; // Display label with percentage
                    }
                }, responsiveOptions);

                pitaChart.on('draw', function (data) {
                    if (data.type === 'slice') {
                        const node = data.element.getNode();
                        if (!node || typeof node.getTotalLength !== 'function') {
                            console.error('SVG node not valid or getTotalLength not supported.');
                            return;
                        }

                        const pathLength = node.getTotalLength();
                        console.log('Path Length:', pathLength);

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

                pitaChart.on('created', function () {
                    if (timerId) {
                        clearTimeout(timerId);
                    }

                    //timerId = setTimeout(() => pitaChart.update(), 10000);
                });
            });
        </script>
    @endscript
</div>
