<x-admin-layout>
    <x-slot:title>
        {{ $property->name }}
    </x-slot:title>

    <!-- Page content -->
    <div id="page-content" class="flex flex-col min-h-screen bg-gray-900">
        <!-- Admin topbar -->
        <div class="fixed top-0 left-0 z-10 w-full bg-gray-800">
            @include('components.topbar-admin')
        </div>

        <div class="flex w-full pt-[100px] flex-grow">
            @include('components.sidebar-admin')

            <!-- Main content -->
            <div id="main-content" class="flex flex-col flex-grow w-full pt-6 bg-gray-900">
                <div class="w-[80%] mx-auto py-8">
                    <!-- Update Property Form -->
                    <form action="{{ route('update-property', ['property' => $property->id]) }}" method="POST" enctype="multipart/form-data" class="w-full p-4 mx-auto bg-gray-800 rounded-lg shadow-lg">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <h1 class="mb-6 text-xl font-bold text-center">Update Property Information</h1>

                        <div class="w-full px-20">
                            <!-- Data special for property type and for every property -->
                            <div class="flex w-full">
                                <!-- General property data -->
                                <div class="w-[500px]">
                                    <!-- Property Price -->
                                    <div class="mb-4 mr-auto">
                                        <label for="price" class="block mb-2 font-bold">Price:</label>
                                        <input type="text" name="price" id="price" value="{{ old('price', $property->price) }}" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('price') border-red-500 @enderror">
                                        @error('price')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Offer Type -->
                                    <div class="mb-4 mr-auto">
                                        <label class="block mb-2 font-bold">Offer Type:</label>
                                        <div class="flex gap-4">
                                            <button type="button"
                                                    class="flex-1 px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('offer_type', $property->lease_duration === null) == 'sale' ? 'bg-blue-600 text-white' : '' }}"
                                                    onclick="updateOfferType('sale')">
                                                For Sale
                                            </button>
                                            <button type="button"
                                                    class="flex-1 px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('offer_type', $property->lease_duration !== null) == 'rent' ? 'bg-blue-600 text-white' : '' }}"
                                                    onclick="updateOfferType('rent')">
                                                For Rent
                                            </button>
                                        </div>
                                        <input type="hidden" name="offer_type" id="offer_type_input" value="{{ old('offer_type', $property->lease_duration === null ? 'sale' : 'rent') }}">
                                    </div>

                                    <!-- Property Type -->
                                    <div class="mb-4 mr-auto">
                                        <label class="block mb-2 font-bold">Property Type:</label>
                                        <div class="flex gap-4">
                                            <button type="button"
                                                    class="flex-1 px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('type_id', $property->type_id) == 1 ? 'bg-blue-600 text-white' : '' }}"
                                                    onclick="updatePropertyType(1)">
                                                Office
                                            </button>
                                            <button type="button"
                                                    class="flex-1 px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('type_id', $property->type_id) == 2 ? 'bg-blue-600 text-white' : '' }}"
                                                    onclick="updatePropertyType(2)">
                                                House
                                            </button>
                                            <button type="button"
                                                    class="flex-1 px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('type_id', $property->type_id) == 3 ? 'bg-blue-600 text-white' : '' }}"
                                                    onclick="updatePropertyType(3)">
                                                Apartment
                                            </button>
                                        </div>
                                        <input type="hidden" name="type_id" id="type_id_input" value="{{ old('type_id', $property->type_id) }}">
                                    </div>

                                    <!-- Year Built -->
                                    <div class="mb-4 mr-auto">
                                        <label for="year_built" class="block mb-2 font-bold">Year Built:</label>
                                        <input type="text" name="year_built" id="year_built" value="{{ old('year_built', $property->year_built) }}" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('year_built') border-red-500 @enderror">
                                        @error('year_built')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="mb-4 mr-auto">
                                        <label class="block mb-2 font-bold">Status:</label>
                                        <div class="flex gap-4">
                                            <button type="button"
                                                    class="flex-1 px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('status', $property->status) == 'Available' ? 'bg-blue-600 text-white' : '' }}"
                                                    onclick="updateStatus('Available')">
                                                Available
                                            </button>
                                            <button type="button"
                                                    class="flex-1 px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('status', $property->status) == 'Sold' ? 'bg-blue-600 text-white' : '' }}"
                                                    onclick="updateStatus('Sold')">
                                                Sold
                                            </button>
                                        </div>
                                        <input type="hidden" name="status" id="status_input" value="{{ old('status', $property->status) }}">
                                    </div>
                                </div>

                                <!-- Input data based on property type selected (this selection process needs to be updated)-->
                                <div class="ml-auto w-fit">
                                    <!-- Number of Bedrooms -->
                                    <div class="w-full mb-4 mr-auto">
                                        <label for="bedrooms" class="block mb-2 font-bold">Number of Bedrooms:</label>
                                        <input type="number" name="bedrooms" id="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}" min="0" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('bedrooms') border-red-500 @enderror">
                                        @error('bedrooms')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Number of Toilets -->
                                    <div class="w-full mb-4 mr-auto">
                                        <label for="toilets" class="block mb-2 font-bold">Number of Toilets:</label>
                                        <input type="number" name="toilets" id="toilets" value="{{ old('toilets', $property->toilets) }}" min="0" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('toilets') border-red-500 @enderror">
                                        @error('toilets')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Number of Floors -->
                                    <div class="w-full mb-4 mr-auto">
                                        <label for="floors" class="block mb-2 font-bold">Number of Floors:</label>
                                        <input type="number" name="floors" id="floors" value="{{ old('floors', $property->floors) }}" min="0" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('floors') border-red-500 @enderror">
                                        @error('floors')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Number of Rooms -->
                                    <div class="w-full mb-6 mr-auto">
                                        <label for="rooms" class="block mb-2 font-bold">Number of Rooms:</label>
                                        <input type="number" name="rooms" id="rooms" value="{{ old('rooms', $property->rooms) }}" min="0" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('rooms') border-red-500 @enderror">
                                        @error('rooms')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Garden -->
                                    <div class="flex items-center w-full gap-3 mb-4 mr-auto">
                                        <label class="block mb-2 font-bold">Garden:</label>
                                        <div class="flex items-center justify-center mb-2">
                                            <label class="flex items-center justify-center mr-4">
                                                <input type="radio" name="garden" value="yes" {{ old('garden', $property->garden) == 1 ? 'checked' : '' }} class="mr-2"> Yes
                                            </label>
                                            <label class="flex items-center justify-center mr-4">
                                                <input type="radio" name="garden" value="no" {{ old('garden', $property->garden) == 0 ? 'checked' : '' }} class="mr-2"> No
                                            </label>
                                        </div>
                                        @error('garden')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <!-- Map and location inputs -->
                            <div class="flex items-center justify-center w-full mb-4">
                                <div class="mr-auto">
                                    <!-- Leaflet Map -->
                                    <div id="map" style="height: 400px; width: 500px; margin-top: 20px; z-index: 20;" class="rounded-[10px]">

                                    </div>
                                </div>

                                <div class="pt-1 ml-5">
                                    <!-- Longitude -->
                                    <div class="mb-4">
                                        <label for="longitude" class="block mb-2 font-bold">Longitude:</label>
                                        <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $property->lon) }}" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('longitude') border-red-500 @enderror">
                                        @error('longitude')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Latitude -->
                                    <div class="mb-4">
                                        <label for="latitude" class="block mb-2 font-bold">Latitude:</label>
                                        <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $property->lat) }}" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('latitude') border-red-500 @enderror">
                                        @error('latitude')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- City -->
                                    <div class="mb-4">
                                        <label for="city" class="block mb-2 font-bold">City:</label>
                                        <input type="text" name="city" id="city" value="{{ old('city', $property->city) }}" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('city') border-red-500 @enderror">
                                        @error('city')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Street -->
                                    <div class="mb-4">
                                        <label for="street" class="block mb-2 font-bold">Street:</label>
                                        <input type="text" name="street" id="street" value="{{ old('street', $property->street) }}" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('street') border-red-500 @enderror">
                                        @error('street')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="">
                                        <p class="text-xs">Please make sure to double check the values inserted by the map (City, Street)</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Update Button -->
                        <div class="text-center">
                            <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg">
                                Update Property
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('admin.footer')
    </div>


    <script>
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

        function reverseGeocode(lat, lng) {
            var url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    console.log(data);  // Check the full data returned from Nominatim

                    if (data.address) {
                        // Extract street number, street, and city from the response
                        var houseNumber = data.address.house_number || '';
                        var street = data.address.road || '';
                        var city = data.address.city || data.address.town || data.address.village || '';

                        // Combine street number with street name
                        var fullStreet = houseNumber ? `${houseNumber} ${street}` : street;

                        // Set the values in your form inputs
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
            // Update button styles
            document.querySelectorAll('button').forEach(button => {
                button.classList.remove('bg-blue-600', 'text-white');
            });
            event.target.classList.add('bg-blue-600', 'text-white');
        }

        function updatePropertyType(type) {
            document.getElementById('type_id_input').value = type;
            // Update button styles
            document.querySelectorAll('button').forEach(button => {
                button.classList.remove('bg-blue-600', 'text-white');
            });
            event.target.classList.add('bg-blue-600', 'text-white');
        }

        function updateStatus(status) {
            document.getElementById('status_input').value = status;
            // Update button styles
            document.querySelectorAll('button').forEach(button => {
                button.classList.remove('bg-blue-600', 'text-white');
            });
            event.target.classList.add('bg-blue-600', 'text-white');
        }
    </script>

</x-admin-layout>
