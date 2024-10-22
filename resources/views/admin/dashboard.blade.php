<x-admin-layout>
    <x-slot:title>
        Admin Panel
    </x-slot:title>

    <!-- Page content -->
    <div class="flex flex-col min-h-screen bg-gray-900">
        <!-- Admin topbar -->
        <div class="fixed top-0 left-0 z-10 w-full bg-gray-800">
            @include('components.topbar-admin')
        </div>

        <div class="flex w-full pt-[150px]">
            @include('components.sidebar-admin')

            <!-- Main content-->
            <div id="main-content" class="flex flex-col flex-grow w-full bg-gray-900">
                <div class="flex flex-col items-center justify-center w-full z-9">
                    <p class="mb-auto">Welcome back to dashboard page, {{ Auth::user()->name }}</p>

                    <!-- Chart container -->
                    {{-- Responsive design will be a pain.... --}}
                    <div class="w-[850px] bg-gray-800 rounded-[10px]">
                        <div class="ct-chart h-[400px] w-full mb-auto pt-4"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-auto">
            @include('admin.footer')
        </div>

    </div>

    <script>
        new Chartist.Line('.ct-chart', {
            // labels su kolone, x-osa
            labels: [1, 2, 3, 4, 5, 6, 7, 8],
            // series su redovi, y-osa
            series: [
                [5, 9, 7, 8, 5, 3, 5, 4]
            ]
        }, {
            low: 0,
            showArea: true
        });

        // Trebaš skontati kako uraditi: boje, tačknice, datu i onda mijenjanje vremena
    </script>

</x-admin-layout>
