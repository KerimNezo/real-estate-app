<x-admin-layout>
    <x-slot:title>
        Create agent
    </x-slot:title>

    <!-- Page content -->
    <div class="flex flex-col min-h-screen bg-gray-900">
        <!-- Admin topbar -->
        <div class="fixed top-0 left-0 z-10 w-full bg-gray-800">
            @include('components.topbar-admin')
        </div>

        <div class="flex w-full pt-[100px] flex-grow">
            @include('components.sidebar-admin')

            <!-- Main content -->
            <div id="main-content" class="w-full py-6 bg-gray-900">
                <!-- Admin dashboard page content -->
                <div class="flex flex-col items-center justify-center p-4 mx-auto bg-gray-900 rounded-lg w-[90%]">
                    <!-- Charts -->
                    <div class="flex flex-col w-full gap-8 lg:gap-4 lg:flex-row">
                        <!-- Property Type Pie Chart -->
                        <div class="flex flex-col w-full lg:w-1/2">
                            <div class="flex w-full p-1">
                                <p class="pl-3 mr-auto text-sm">Properties</p>

                                <x-chart-color-text text="Houses" color="bg-[#2563eb]" />

                                <x-chart-color-text text="Appartements" color="bg-[#ef4444]" />

                                <x-chart-color-text text="Offices" color="bg-[#16a34a]" />
                            </div>

                            <div class="w-full bg-gray-800 rounded-[10px] p-4">
                                <div class="pb-4">
                                    <select name="PropertyTypeChart" id="property-type-chart" class="bg-gray-900 rounded-[10px] pl-2 p-1 pr-8 text-sm">
                                        <option selected value="Available">Available</option>
                                        <option value="Sold">Sold</option>
                                        <option value="Rented">Rented</option>
                                    </select>
                                </div>

                                <div class="ct-chart h-[300px] w-full mb-auto"></div>
                            </div>
                        </div>

                        <!-- Profit Line Chart -->
                        <div class="flex flex-col w-full lg:w-1/2">
                            <div class="flex w-full p-1">
                                <p class="pl-3 mr-auto text-sm">Profit</p>

                                <x-chart-color-text text="Total" color="bg-[#2563eb]" />

                                <x-chart-color-text text="Sell" color="bg-[#ef4444]" />

                                <x-chart-color-text text="Rent" color="bg-[#16a34a]" />
                            </div>

                            <div class="w-full bg-gray-800 rounded-[10px] p-4">
                                <div class="pb-4">
                                    <select name="PropertyTypeChart" id="property-type-chart" class="bg-gray-900 rounded-[10px] pl-2 p-1 pr-8 text-sm">
                                        <option selected value="1">30 Days</option>
                                        <option value="6">6 Months</option>
                                        <option value="12">Last Year</option>
                                    </select>
                                </div>

                                <div class="ct-chart1 h-[300px] w-full mb-auto"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Table display of most recent actions -->
                    <div>

                    </div>
                </div>
            </div>
        </div>

        @include('admin.footer')
    </div>

    <!-- Chart scripts -->
    <script>
        var pieData = {
            labels: ['Houses', 'Appartements', 'Offices'],
            series: [20, 14, 10],
        }

        var sum = function(a, b) { return a + b };

        var options = {
            labelInterpolationFnc: function(value) {
                return Math.round(value / pieData.series.reduce(sum) * 100) + '%';
            }
        };

        var responsiveOptions = [
            ['screen and (min-width: 640px)', {
                chartPadding: 30,
                labelOffset: 100,
                labelDirection: 'explode',
                labelInterpolationFnc: function(value) {
                    return value;
                }
            }], ['screen and (min-width: 1024px)', {
                labelOffset: 80,
                chartPadding: 20
                }]
            ];

        new Chartist.Pie('.ct-chart', pieData, options, responsiveOptions);

        new Chartist.Line('.ct-chart1', {
            // labels su kolone, x-osa
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
            // series su redovi, y-osa
            series: [
                [5, 10, 25, 8, 14, 10, 16, 5, 11, 9, 10, 11], // UKUPNE PRODAJE GRAPH (ovdje ćemo stavljati liste vrijednosti iz baze koje pokupimp za različite vrste podataka i linija)
                [2, 6, 17, 3, 7, 4, 9, 3, 5, 4, 3, 5], // SELL PRODAJE GRAPH
                [3, 4, 8, 5, 7, 6, 7, 1, 6, 5, 7, 6], // RENT PRODAJE GRAPH
            ]
        }, {
            low: 0,
            showArea: true,
        });

    </script>
</x-admin-layout>
