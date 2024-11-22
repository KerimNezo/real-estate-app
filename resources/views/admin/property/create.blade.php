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
            @include('components.sidebar-admin')

            <!-- Main content -->
            <div id="main-content" class="w-full py-6 bg-gray-900">
                <!-- Update Property Form -->
                <div class="flex flex-col items-center justify-center p-4 mx-auto bg-gray-800 rounded-lg shadow-lg w-[80%]">
                    <!-- Title -->
                    <h1 class="py-4 text-xl font-bold text-center">
                        Create New Property
                    </h1>

                    <div class="w-full h-full px-4">
                        <livewire:admin.store-property />
                    </div>
                </div>
            </div>
        </div>

        {{-- <script>
            var map = L.map('map');

            map.setView([{{ $property->lat }}, {{ $property->lon }}], 16);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            }).addTo(map);

            var marker = L.marker([{{ $property->lat }}, {{ $property->lon }}]).addTo(map);

            map.on('click', function(e) {
                var latlng = e.latlng;
                marker.setLatLng(latlng);
                reverseGeocode(latlng.lat, latlng.lng);
                document.getElementById('latitude').value = latlng.lat.toFixed(3);
                document.getElementById('longitude').value = latlng.lng.toFixed(3);
                document.getElementById('')
            });

            // funkcija pomoću koje dobijamo adresu  korisnik klikne na mapu
            function reverseGeocode(lat, lng) {
                var url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);

                        if (data.address) {
                            var houseNumber = data.address.house_number || '';
                            var street = data.address.road || '';
                            var city = data.address.city || data.address.town || data.address.village || '';

                            var fullStreet = houseNumber ? `${houseNumber} ${street}` : street;

                            document.getElementById('street').value = fullStreet;
                            document.getElementById('city').value = city;
                        } else {
                            alert('No address found for these coordinates.');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching address:', error);
                    });
            }

            function updateOfferType(type) {
                document.getElementById('offer_type_input').value = type;
                console.log(type);

                document.querySelectorAll('button[id="offerType"]').forEach(button => {
                    button.classList.remove('bg-blue-600', 'text-white');
                });

                event.target.classList.add('bg-blue-600', 'text-white');
            }

            function updatePropertyType(type) {
                document.getElementById('type_id_input').value = type;
                console.log(type);

                document.querySelectorAll('button[id="propertyType"]').forEach(button => {
                    button.classList.remove('bg-blue-600', 'text-white');
                });

                event.target.classList.add('bg-blue-600', 'text-white');
            }

            function updateStatus(status) {
                document.getElementById('status_input').value = status;
                console.log(status);

                document.querySelectorAll('button[id="Available"], button[id="Sold"]').forEach(button => {
                    button.classList.remove('bg-blue-600', 'text-white');
                });

                event.target.classList.add('bg-blue-600', 'text-white');
            }
        </script> --}}

        @include('admin.footer')
    </div>
</x-admin-layout>
