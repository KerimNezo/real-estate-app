<div>

    <div class="flex flex-col items-center justify-center w-full p-4 mx-auto bg-gray-800 rounded-lg shadow-lg">
        <!-- Title -->
        <h1 class="pb-4 text-xl font-bold text-center">
            Create New Property
        </h1>

        <div class="w-full mx-auto">
            <!-- Update Property Form -->
            <form wire:submit.prevent="storeProperty" class="w-full mx-auto bg-gray-800 rounded-lg " enctype="multipart/form-data" >
                @csrf
                <div class="w-full">
                    <!-- Data special for property type and for every property -->
                    <div class="flex w-full gap-5 mb-6">
                        <!-- General property data -->
                        <div class="flex-grow mr-auto">
                            <x-formInput type="text" title="name" label="Name" model='name' placeholder='E.g. Two bedroom house'/>

                            <x-formInput type="text" title="price" label="Price" model='price' placeholder='E.g. 100000'/>

                            <x-formInput type="text" title="year_built" label="Year Built" model='year_built' placeholder='E.g. 1990'/>

                            <!-- Offer Type -->
                            <div class="w-full mb-4 mr-auto">
                                <div class="relative w-full">
                                    <label class="block mb-1 font-bold">Offer Type:</label>

                                    @error('lease_duration')
                                        <div class="absolute text-red-500 -translate-y-1/2 top-1/2 right-4 group">
                                            <div class="flex items-center justify-center w-6 h-6 border-2 border-red-500 rounded-full cursor-pointer">
                                                i
                                            </div>

                                            <!-- Tooltip on Hover -->
                                            <div class="absolute right-0 hidden w-40 px-2 py-1 mb-2 text-sm text-white bg-gray-800 border-gray-900 rounded-lg opacity-75 border-3 bottom-full group-hover:block">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                </div>

                                <div class="flex gap-4">
                                    <select id="offer_input" wire:model.blur="lease_duration" class="w-full rounded-[5px] h-[40px] pl-[10px] pr-8 text-[#989898]-black bg-gray-800 @error('lease_duration') border-red-500 @enderror" name="offer_type">
                                        <option value="null" disabled selected>Choose offer type</option>
                                        <option value="0">For Sale</option>
                                        <option value="1">For Rent</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Property Type -->
                            <div class="w-full mb-3 mr-auto">
                                <div class="relative w-full">
                                    <label class="block mb-1 font-bold">Property Type:</label>

                                    @error('type_id')
                                        <div class="absolute text-red-500 -translate-y-1/2 top-1/2 right-4 group">
                                            <div class="flex items-center justify-center w-6 h-6 border-2 border-red-500 rounded-full cursor-pointer">
                                                i
                                            </div>

                                            <!-- Tooltip on Hover -->
                                            <div class="absolute right-0 hidden w-40 px-2 py-1 mb-2 text-sm text-white bg-gray-800 border-gray-900 rounded-lg opacity-75 border-3 bottom-full group-hover:block">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                </div>

                                <div class="flex gap-4">
                                    <select id="type_input" wire:model.blur="type_id" class="w-full rounded-[5px] h-[40px] pl-[10px] pr-8 text-[#989898]-black bg-gray-800 @error('type_id') border-red-500 @enderror" name="offer_type">
                                        <option value="null" disabled selected>Choose property type</option>
                                        <option value="1">Office</option>
                                        <option value="2">House</option>
                                        <option value="3">Appartement</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Other property input data -->
                        <div class="!w-[500px] ml-auto flex flex-col justify-center items-center mb-auto">
                            <!-- Number inputs -->
                            <div class="w-full mb-auto">
                                <!-- Number of Bedrooms -->
                                <x-formInput type="number" title="bedrooms" label="Number of Bedrooms" model='bedrooms' />

                                <!-- Number of Toilets -->
                                <x-formInput type="number" title="toilets" label="Number of Toilets" model='toilets' />

                                <!-- Number of Floors -->
                                <x-formInput type="number" title="floors" label="Number of Floors" model='floors' />

                                <!-- Number of Rooms -->
                                <x-formInput type="number" title="rooms" label="Number of Rooms" model='rooms' />
                            </div>

                            <!-- Radio buttons input -->
                            <div class="flex items-center justify-center w-full mt-2 mb-auto">
                                <div class="flex flex-col items-center justify-center w-1/3">
                                    <!-- Garden -->
                                    <x-checkbox-input name="garden" label="Garden" />

                                    <!-- Furnished -->
                                    <x-checkbox-input name="furnished" label="Furnished" />
                                </div>

                                <div class="flex flex-col items-center justify-center w-1/3">
                                    <!-- Video -->
                                    <x-checkbox-input name="video_intercom" label="Intercom" />

                                    <!-- Garage -->
                                    <x-checkbox-input name="garage" label="Garage" />
                                </div>

                                <div class="flex flex-col items-center justify-center w-1/3">
                                    <!-- Keycard -->
                                    <x-checkbox-input name="keycard_entry" label="Keycard entry" />

                                    <!-- Elevator -->
                                    <x-checkbox-input name="elevator" label="Elevator" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description and Location data input -->
                    <div class="flex items-start justify-center w-full mb-4">
                        <!-- Description Section -->
                        <div class="flex-grow mr-auto">
                            <!-- Property Description -->
                            <div class="w-full">
                                <div class="relative w-full">
                                    <label for="description" class="block mb-2 font-bold">Description:</label>

                                    @error('description')
                                        <div class="absolute text-red-500 -translate-y-1/2 top-1/2 right-4 group">
                                            <div class="flex items-center justify-center w-6 h-6 border-2 border-red-500 rounded-full cursor-pointer">
                                                i
                                            </div>
                                            <!-- Tooltip on Hover -->
                                            <div class="absolute right-0 hidden w-40 px-2 py-1 mb-2 text-sm text-white bg-gray-800 border-gray-900 rounded-lg opacity-75 border-3 bottom-full group-hover:block">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                </div>

                                <textarea wire:model.blur="description" placeholder="Property description.." name="description" rows="18" id="description" class="w-full px-3 py-2 border rounded-lg text-balance bg-gray-800 @error('description') border-red-500 @enderror">
                                </textarea>
                                @error('tempDescription')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Location Section -->
                        <div class="ml-5">
                            <div class="relative w-full">
                                <label for="location" class="block mb-2 font-bold">Location:</label>

                                @error('country')
                                    <div class="absolute text-red-500 -translate-y-1/2 top-1/2 right-4 group">
                                        <div class="flex items-center justify-center w-6 h-6 border-2 border-red-500 rounded-full cursor-pointer">
                                            i
                                        </div>
                                        <!-- Tooltip on Hover -->
                                        <div class="absolute right-0 hidden w-40 px-2 py-1 mb-2 text-sm text-white bg-gray-800 border-gray-900 rounded-lg opacity-75 border-3 bottom-full group-hover:block">
                                            {{ $message }}
                                        </div>
                                    </div>
                                @enderror
                            </div>

                            <div id="sticky" class="rounded-[10px] @error('lat') border-2 border-red-500 @enderror">
                                <!-- Leaflet Map -->
                                <div id="admin-map" wire:ignore style="height: 400px; width: 500px;" class="rounded-[10px]"></div>
                                {{-- this wire:ignore is needed that when validation happens, and livewire re-renders the form
                                    there is extra code inside admin-map div so it removes it --}}
                            </div>

                            <br>

                            <!-- City -->
                            <x-formInput type="text" title="city" label="City" model='city' />

                            <!-- Street -->
                            <x-formInput type="text" title="street" label="Street" model='street' />

                            <!-- Location little warning text -->
                            <div class="">
                                <p class="text-xs">Please make sure to double check the data entered by the map (City, Street)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Update Button -->
                <div class="pt-10 text-center">
                    <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg">
                        <div id="loader" wire:loading wire:target="storeProperty" class="mr-auto">
                            <img src="{{ asset('photos/spinner.svg') }}" wire:loading class="w-6 h-6"></img> <!-- SVG loading spinner -->
                        </div>

                        Update Property
                    </button>
                </div>
            </form>
        </div>

        <script>
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
                            var country = data.address.country

                            var fullStreet = houseNumber ? `${houseNumber} ${street}` : street;

                            document.getElementById('street').value = fullStreet;
                            document.getElementById('city').value = city;

                            Livewire.dispatch('update-location-data', [city, fullStreet, lat, lng, country]);
                        } else {

                        }
                    })
                    .catch(error => {
                        console.error('Error fetching address:', error);
                    });
            }
        </script>
    </div>
</div>
