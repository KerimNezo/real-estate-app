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
                    <div id="create-prop-inputs" class="flex w-full gap-5 mb-6">
                        <!-- General property data -->
                        <div class="flex flex-col lg:w-full sm:w-1/2">
                            <!-- Property Name -->
                            <x-formInput type="text" title="name" label="Name" model='name' placeholder='E.g. Two bedroom house'/>

                            <!-- Property Price -->
                            <x-formInput type="text" title="price" label="Price" model='price' placeholder='E.g. 100000'/>

                            <!-- Property Year -->
                            <x-formInput type="text" title="year_built" label="Year Built" model='year_built' placeholder='E.g. 1990'/>

                            <!-- Offer Type -->
                            <div class="w-full mb-2 mr-auto">
                                <div class="relative w-full">
                                    <label class="block mb-2 font-bold">Offer Type:</label>

                                    <x-error-message-info title="lease_duration" />
                                </div>

                                <div class="flex gap-4">
                                    <select id="offer_input" wire:model.blur="lease_duration" class="w-full rounded-lg py-2 pl-[10px] pr-8 text-[#989898]-black bg-gray-800 @error('lease_duration') border-red-500 @enderror" name="offer_type">
                                        <option value="null" disabled selected>Choose offer type</option>
                                        <option value="0">For Sale</option>
                                        <option value="1">For Rent</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Property Type -->
                            <div class="w-full mb-3 mr-auto">
                                <div class="relative w-full">
                                    <label class="block mb-2 font-bold">Property Type:</label>

                                    <x-error-message-info title="type_id" />
                                </div>

                                <div class="flex gap-4">
                                    <select id="type_input" wire:model.blur="type_id" class="w-full rounded-lg py-2 pl-[10px] pr-8 text-[#989898]-black bg-gray-800 @error('type_id') border-red-500 @enderror" name="offer_type">
                                        <option value="null" disabled selected>Choose property type</option>
                                        <option value="1">Office</option>
                                        <option value="2">House</option>
                                        <option value="3">Appartement</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Property Agent -->
                            <div class="w-full mb-2 mr-auto">
                                <div class="relative w-full">
                                    <label class="block mb-2 font-bold">Choose agent:</label>

                                    <x-error-message-info title="user_id" />
                                </div>

                                <div class="flex gap-4">
                                    <select id="agent_input" wire:model.blur="user_id" class="w-full rounded-lg py-2 pl-[10px] pr-8 text-[#989898]-black bg-gray-800 @error('user_id') border-red-500 @enderror" name="offer_type">
                                        <option value="null" disabled selected>Choose an agent</option>
                                        @foreach ($this->agents as $agent)
                                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Other property input data -->
                        <div class="flex flex-col items-center justify-center mb-auto lg:w-full sm:w-1/2">
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

                                <!-- Property surface -->
                                <x-formInput type="number" title="surface" label="Property surface" model='surface' />
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
                                    <!-- Garage -->
                                    <x-checkbox-input name="garage" label="Garage" />

                                    <!-- Elevator -->
                                    <x-checkbox-input name="elevator" label="Elevator" />
                                </div>

                                <div class="flex flex-col items-center justify-center w-1/3">
                                    <!-- Video -->
                                    <x-checkbox-input name="video_intercom" label="Intercom" />

                                    <!-- Keycard -->
                                    <x-checkbox-input name="keycard_entry" label="Keycard entry" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description and Location data input -->
                    <div id="create-prop-inputs" class="flex items-start justify-center w-full gap-5 mb-10">
                        <!-- Description Section -->
                        <div class="flex-grow lg:w-full sm:w-1/2">
                            <!-- Property Description -->
                            <div class="w-full">
                                <div class="relative w-full">
                                    <label for="description" class="block mb-2 font-bold">Description:</label>

                                    <x-error-message-info title="description" />
                                </div>

                                <!-- Property Description-->
                                <textarea wire:model.blur="description" placeholder="Property description.." name="description" rows="18" id="description" class="w-full px-3 py-2 border rounded-lg text-balance bg-gray-800 @error('description') border-red-500 @enderror">
                                </textarea>
                            </div>
                        </div>

                        <!-- Location Section -->
                        <div class="lg:w-full sm:w-1/2">
                            <!-- Property Map-->
                            <div>
                                <div class="relative w-full">
                                    <label for="location" class="block mb-2 font-bold">Location:</label>

                                    <x-error-message-info title="country" />
                                </div>

                                <div id="sticky" class="rounded-[10px] @error('lat') border-2 border-red-500 @enderror">
                                    <!-- Leaflet Map -->
                                    <div id="admin-map" wire:ignore class="z-[2] rounded-[10px]"></div>
                                    {{-- this wire:ignore is needed that when validation happens, and livewire re-renders the form
                                        there is extra code inside admin-map div so it removes it --}}
                                </div>
                            </div>

                            <br>

                            <!-- Property City -->
                            <x-formInput type="text" title="city" label="City" model='city' />

                            <!-- Property Street -->
                            <x-formInput type="text" title="street" label="Street" model='street' />

                            <!-- Location little warning text -->
                            <div class="">
                                <p class="text-xs">Please make sure to double check the data entered by the map (City, Street)</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col items-start justify-center w-full max-w-full">
                        {{-- Photo gallery header with buttons --}}
                        <div class="flex flex-col items-center justify-center w-full gap-4 pb-4 sm:flex-row">
                            <p class="w-full mr-auto text-lg font-bold text-left whitespace-normal">
                                Property images:
                            </p>

                            <div class="w-full">
                                @if (session()->has('notImage'))
                                    <div wire:poll.3s="clearFlashMessage" id="flash-message" class="flex items-center justify-center w-full py-2 mx-auto bg-red-700 rounded-lg">
                                        <span class="font-bold">{{ session('notImage') }}</span>&nbsp;is not an image.
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center justify-center w-full gap-4 mr-0">
                                <button type="button" onclick="document.getElementById('file-upload').click()" class="px-3 py-2 ml-0 mr-auto text-base text-white bg-green-600 rounded-lg sm:ml-auto sm:mr-0">
                                    <p>New photo</p>
                                </button>

                                <input type="file" multiple id="file-upload" class="hidden" wire:model="media">

                                <button type="button" wire:click="resetPhotos" class="flex items-center justify-center gap-2 px-3 py-2 text-base text-white bg-blue-600 rounded-lg">
                                    <div wire:loading wire:target="resetPhotos">
                                        <img src="{{ asset('photos/spinner.svg') }}" wire:loading class="w-6 h-6"></img> <!-- SVG loading spinner -->
                                    </div>

                                    <p>Reset photos</p>
                                </button>
                            </div>
                        </div>

                        <!-- Property photos -->
                        <div class="flex w-full">
                            <div class="flex items-center justify-start w-full max-w-full space-x-2 overflow-hidden overflow-x-scroll whitespace-nowrap">
                                <!-- Display new photo previews -->
                                @foreach($mediaArray as $key => $photo)
                                    <div class="relative" wire:key="{{ $key }}">
                                        <img src="{{ $photo->temporaryUrl() }}"
                                            alt="Loading Photo"
                                            class="w-[150px] h-[90px] object-cover rounded-lg cursor-pointer">

                                        <button type="button" class="absolute flex items-center justify-center w-5 h-5 text-xs text-black bg-white rounded-full top-1 right-1"
                                                wire:click="removeNewPhoto('{{ $key }}')" wire:loading.attr="disabled">
                                            <div class="flex items-center justify-center pb-[2px] font-bold">
                                                <p>x</p>
                                            </div>
                                        </button>

                                        <div wire:loading wire:target="removeNewPhoto('{{ $key }}')"
                                            class="absolute inset-0 z-10 flex items-center justify-center bg-gray-700 bg-opacity-75 rounded-lg">
                                            <img src="{{ asset('photos/spinner.svg') }}" alt="Loading" class="w-[150px] h-[90px] opacity-75">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @error('media')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Create Button -->
                <div class="pt-10 text-center">
                    <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg">
                        <div id="loader" wire:loading wire:target="storeProperty" class="mr-auto">
                            <img src="{{ asset('photos/spinner.svg') }}" wire:loading class="w-6 h-6"></img> <!-- SVG loading spinner -->
                        </div>

                        Create Property
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
