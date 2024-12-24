<x-admin-layout>
    <x-slot:title>
        Create property
    </x-slot:title>

    <!-- Page content -->
    <div class="flex flex-col min-h-screen bg-gray-900">
        <!-- Admin topbar -->
        <div class="fixed top-0 left-0 z-10 w-full bg-gray-800">
            @include('components.topbar-admin')
        </div>

        <div class="flex w-full pt-[100px] flex-grow">
            @include('components.sidebar-agent')

            <!-- Main content -->
            <div id="main-content" class="flex flex-col w-full overflow-hidden bg-gray-900">
                <!-- Update Property Form -->
                <div class="py-6 mx-auto w-[80%]">
                    <div class="w-full h-full lg:px-4 sm:px-0">
                        <livewire:admin.store-property />
                    </div>
                </div>
            </div>
        </div>

        <script>
            var map = L.map('admin-map');

            map.setView([44.20169, 17.90397], 7);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            }).addTo(map);

            map.on('click', function(e) {
                var latlng = e.latlng;
                reverseGeocode(latlng.lat, latlng.lng);
            });
        </script>

        @include('admin.footer')
    </div>
</x-admin-layout>
