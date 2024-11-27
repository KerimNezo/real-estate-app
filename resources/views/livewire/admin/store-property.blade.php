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
                            <!-- Property Name -->
                            <div class="w-full mb-4 mr-auto">
                                <label for="name" class="block mb-2 font-bold">Name:</label>
                                <input wire:model="propertyData.name" type="text" name="name" id="name" placeholder="E.g. Two bedroom house" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('propertyData.name') border-red-500 @enderror">
                                @error('propertyData.name')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Property Price -->
                            <div class="w-full mb-4 mr-auto">
                                <label for="price" class="block mb-2 font-bold">Price:</label>
                                <input wire:model="propertyData.price" type="text" name="price" id="price" placeholder="E.g. 100000" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('propertyData.price') border-red-500 @enderror">
                                @error('propertyData.price')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Year Built -->
                            <div class="w-full mb-4 mr-auto">
                                <label for="year_built" class="block mb-2 font-bold">Year Built:</label>
                                <input type="text" name="year_built" id="year_built" placeholder="E.g. 1990" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('propertyData.year_built') border-red-500 @enderror">
                                @error('propertyData.year_built')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Offer Type -->
                            <div class="w-full mb-4 mr-auto">
                                <label class="block mb-2 font-bold">Offer Type:</label>
                                <div class="flex gap-4">
                                    <button type="button" id="offerType"
                                            class="flex-1 px-4 py-2 text-center bg-gray-800 border rounded-lg"
                                            onclick="updateOfferType('sale')">
                                        For Sale
                                    </button>
                                    <button type="button" id="offerType"
                                            class="flex-1 px-4 py-2 text-center bg-gray-800 border rounded-lg"
                                            onclick="updateOfferType('rent')">
                                        For Rent
                                    </button>
                                </div>
                                <input type="hidden" wire:model="propertyData.offer_type" name="offer_type" id="offer_type_input" value="">
                            </div>

                            <!-- Property Type -->
                            <div class="w-full mb-4 mr-auto">
                                <label class="block mb-2 font-bold">Property Type:</label>
                                <div class="flex gap-4">
                                    <button type="button" id="propertyType"
                                            class="flex-1 px-4 py-2 text-center bg-gray-800 border rounded-lg"
                                            onclick="updatePropertyType(1)">
                                        Office
                                    </button>
                                    <button type="button" id="propertyType"
                                            class="flex-1 px-4 py-2 text-center bg-gray-800 border rounded-lg"
                                            onclick="updatePropertyType(2)">
                                        House
                                    </button>
                                    <button type="button" id="propertyType"
                                            class="flex-1 px-4 py-2 text-center bg-gray-800 border rounded-lg"
                                            onclick="updatePropertyType(3)">
                                        Apartment
                                    </button>
                                </div>
                                <input wire:model="propertyData.type_id" type="hidden" name="type_id" id="type_id_input">
                            </div>
                        </div>

                        <!-- Other property input data -->
                        <div class="!w-[500px] ml-auto flex justify-center items-center gap-5 mb-auto">
                            <!-- Number inputs -->
                            <div class="w-1/2 mb-auto">
                                <!-- Number of Bedrooms -->
                                <div class="w-full mb-4 mr-auto">
                                    <label for="bedrooms" class="block mb-2 font-bold">Number of Bedrooms:</label>
                                    <input type="number" name="bedrooms" id="bedrooms" min="0" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('bedrooms') border-red-500 @enderror">
                                    @error('bedrooms')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Number of Toilets -->
                                <div class="w-full mb-4 mr-auto">
                                    <label for="toilets" class="block mb-2 font-bold">Number of Toilets:</label>
                                    <input type="number" name="toilets" id="toilets" min="0" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('toilets') border-red-500 @enderror">
                                    @error('toilets')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Number of Floors -->
                                <div class="w-full mb-4 mr-auto">
                                    <label for="floors" class="block mb-2 font-bold">Number of Floors:</label>
                                    <input type="number" name="floors" id="floors" min="0" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('floors') border-red-500 @enderror">
                                    @error('floors')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Number of Rooms -->
                                <div class="w-full mb-6 mr-auto">
                                    <label for="rooms" class="block mb-2 font-bold">Number of Rooms:</label>
                                    <input type="number" name="rooms" id="rooms" min="0" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('rooms') border-red-500 @enderror">
                                    @error('rooms')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Radio buttons input -->
                            <div class="w-1/2 mb-auto">
                                <!-- Garden -->
                                <x-checkbox-input name="garden" label="Garden" />

                                <!-- Furnished -->
                                <x-checkbox-input name="furnished" label="Furnished" />

                                <!-- Video -->
                                <x-checkbox-input name="video_intercom" label="Intercom" />

                                <!-- Garage -->
                                <x-checkbox-input name="garage" label="Garage" />

                                <!-- Keycard -->
                                <x-checkbox-input name="keycard_entry" label="Keycard entry" />

                                <!-- Elevator -->
                                <x-checkbox-input name="elevator" label="Elevator" />
                            </div>
                        </div>
                    </div>

                    <!-- Description and Location data input -->
                    <div class="flex items-start justify-center w-full mb-4">
                        <!-- Description Section -->
                        <div class="flex-grow mr-auto">
                            <!-- Property Description -->
                            <div class="w-full">
                                <label for="description" class="block mb-2 font-bold">Description:</label>
                                <textarea wire:model="propertyData.description" placeholder="Property description.." wire:model="tempDescription" name="description" rows="18" id="description" class="w-full px-3 py-2 border rounded-lg text-balance bg-gray-800 @error('description') border-red-500 @enderror">
                                </textarea>
                                @error('tempDescription')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Location Section -->
                        <div class="ml-5">
                            <label for="location" class="block mb-2 font-bold">Location:</label>

                            <div id="sticky">
                                <!-- Leaflet Map -->
                                <div id="admin-map" style="height: 400px; width: 500px;" class="rounded-[10px] mb-2"></div>
                            </div>

                            <!-- City -->
                            <div class="mb-4">
                                <label for="city" class="block mb-2 font-bold">City:</label>
                                <input type="text" name="city" id="city" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('city') border-red-500 @enderror">
                                @error('city')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Street -->
                            <div class="">
                                <label for="street" class="block mb-2 font-bold">Street:</label>
                                <input type="text" name="street" id="street" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('street') border-red-500 @enderror">
                                @error('street')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

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

    </div>
</div>
