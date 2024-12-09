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
                <!-- Update Property Form -->
                <div class="flex flex-col items-center justify-center p-4 mx-auto bg-gray-900 rounded-lg w-[90%]">
                    <!-- Title -->
                    <div class="flex w-full gap-4">
                        <div class="flex flex-col w-1/2">
                            <p class="p-1 text-sm">Total profit</p>

                            <div class="w-full bg-gray-800 rounded-[10px]">
                                <div class="ct-chart h-[300px] w-full mb-auto pt-4"></div>
                            </div>
                        </div>

                        <div class="flex flex-col w-1/2">
                            <div class="flex p-1">
                                <p class="mr-auto text-sm">Profit</p>

                                <div class="flex items-center justify-center gap-2">

                                    {{-- napravi komponentu od ovog dole i tjt
                                        sredi lijepo ovaj graf
                                        i uradi dole actions tabelu --}}
                                    <p class="text-sm">
                                        Total
                                    </p>

                                    <div class="bg-[#ef4444] w-4 h-4 rounded-[5px]">
                                    </div>
                                </div>
                            </div>


                            <div class="w-full bg-gray-800 rounded-[10px]">
                                <div class="ct-chart1 h-[300px] w-full mb-auto pt-4"></div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        @include('admin.footer')
    </div>


    <script>
        new Chartist.Line('.ct-chart', {
            // labels su kolone, x-osa
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
            // series su redovi, y-osa
            series: [
                [5, 9, 7, 8, 5, 3, 5, 4, 1, 6, 1, 11]
            ]
        }, {
            low: 0,
            showArea: true,
        });

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
