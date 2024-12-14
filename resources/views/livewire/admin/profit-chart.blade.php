<div>
    <div class="flex w-full p-1">
        <p class="pl-3 mr-auto text-sm">Profit</p>

        <div id="chart-legend">
            <x-chart-color-text text="Total" color="bg-[#2563eb]" />

            <x-chart-color-text text="Sell" color="bg-[#ef4444]" />

            <x-chart-color-text text="Rent" color="bg-[#16a34a]" />
        </div>
    </div>

    <div class="w-full bg-gray-800 rounded-[10px] p-4">
        <div class="pb-4">
            <select wire:model="timeframe" name="timeframe" id="timeframe" class="bg-gray-900 rounded-[10px] pl-2 p-1 pr-8 text-sm">
                <option wire:click="updateLineChart()" value="3" >3 Months</option>
                <option wire:click="updateLineChart()" value="6" >6 Months</option>
                <option wire:click="updateLineChart()" value="12" >Last Year</option>
            </select>
        </div>

        <div class="ct-chart1 h-[300px] w-full mb-auto"></div>

        <div id="mobile-chart-legend" class="flex items-center w-full justify-evenly">
            <x-chart-color-text text="Total" color="bg-[#2563eb]" />

            <x-chart-color-text text="Sell" color="bg-[#ef4444]" />

            <x-chart-color-text text="Rent" color="bg-[#16a34a]" />
        </div>
    </div>

    @script
    <script>

        // kupit ćemo podatke iz action tabele, jer će ona imati uviđaj kad je prodano/rentano šta, te ćemo znati tako kad je baš sellan property
        // ovo ćemo koristiti od starta, stavit ćemo da se on component load, dispatcha ovaj event i tjt
        $wire.on('updateLineChart', (data) => {
            let labels = data[0].labels;
            let totalSeries = data[0].totalSeries;
            let sellSeries = data[0].sellSeries;
            let rentSeries = data[0].rentSeries;

            var chart = new Chartist.Line('.ct-chart1', {
                // labels su kolone, x-osa
                labels: labels,
                // series su redovi, y-osa
                series: [
                    totalSeries,
                    sellSeries,
                    rentSeries,
                ]
            }, {
                low: 0,
                showArea: true,
            });

            // Let's put a sequence number aside so we can use it in the event callbacks
            var seq = 0,
            delays = 80,
            durations = 500;

            // Once the chart is fully created we reset the sequence
            chart.on('created', function() {
                seq = 0;
            });

            // On each drawn element by Chartist we use the Chartist.Svg API to trigger SMIL animations
            chart.on('draw', function(data) {
            seq++;

            if(data.type === 'line') {
                // If the drawn element is a line we do a simple opacity fade in. This could also be achieved using CSS3 animations.
                data.element.animate({
                    opacity: {
                        // The delay when we like to start the animation
                        begin: seq * delays + 1000,
                        // Duration of the animation
                        dur: durations,
                        // The value where the animation should start
                        from: 0,
                        // The value where it should end
                        to: 1
                    }
                });
            } else if(data.type === 'label' && data.axis === 'x') {
                data.element.animate({
                    y: {
                        begin: seq * delays,
                        dur: durations,
                        from: data.y + 100,
                        to: data.y,
                        // We can specify an easing function from Chartist.Svg.Easing
                        easing: 'easeOutQuart'
                    }
                });
            } else if(data.type === 'label' && data.axis === 'y') {
                data.element.animate({
                    x: {
                        begin: seq * delays,
                        dur: durations,
                        from: data.x - 100,
                        to: data.x,
                        easing: 'easeOutQuart'
                    }
                });
            } else if(data.type === 'point') {
                data.element.animate({
                    x1: {
                        begin: seq * delays,
                        dur: durations,
                        from: data.x - 10,
                        to: data.x,
                        easing: 'easeOutQuart'
                    },
                    x2: {
                        begin: seq * delays,
                        dur: durations,
                        from: data.x - 10,
                        to: data.x,
                        easing: 'easeOutQuart'
                    },
                    opacity: {
                        begin: seq * delays,
                        dur: durations,
                        from: 0,
                        to: 1,
                        easing: 'easeOutQuart'
                    }
                });
            } else if(data.type === 'grid') {
                // Using data.axis we get x or y which we can use to construct our animation definition objects
                var pos1Animation = {
                begin: seq * delays,
                dur: durations,
                from: data[data.axis.units.pos + '1'] - 30,
                to: data[data.axis.units.pos + '1'],
                easing: 'easeOutQuart'
                };

                var pos2Animation = {
                begin: seq * delays,
                dur: durations,
                from: data[data.axis.units.pos + '2'] - 100,
                to: data[data.axis.units.pos + '2'],
                easing: 'easeOutQuart'
                };

                var animations = {};
                animations[data.axis.units.pos + '1'] = pos1Animation;
                animations[data.axis.units.pos + '2'] = pos2Animation;
                animations['opacity'] = {
                begin: seq * delays,
                dur: durations,
                from: 0,
                to: 1,
                easing: 'easeOutQuart'
                };

                data.element.animate(animations);
            }
            });
        });
    </script>
    @endscript
</div>
