<div>
    <!-- Update Property Form -->
    <div class="w-full p-4 mx-auto bg-gray-800 rounded-lg shadow-lg">
        <!-- Title -->
        <h1 class="text-xl font-bold text-center">Update Property Information</h1>

        <div class="w-full h-full px-20">
            <!-- Table to display property images -->
            <div class="w-full py-8 text-xl text-center">
                <form wire:submit.prevent="uploadPhotos">
                    <div class="flex items-center justify-center pb-4">
                        <p class="mr-auto text-lg font-bold text-left">
                            Property images:
                        </p>
                        <button type="button" wire:click="resetPhotos" class="px-3 py-2 ml-auto text-base text-white bg-blue-600 rounded-lg">
                            Reset photos
                        </button>
                    </div>
                    <div class="w-full overflow-x-auto">
                        <div class="flex items-center justify-start w-full space-x-2 overflow-x-auto whitespace-nowrap">
                            @foreach($this->tempPhotos as $index => $media)
                                <div class="relative">
                                    <img src="{{ $media->getUrl() }}"
                                        alt="Property Photo"
                                        class="w-[150px] h-[90px] object-cover rounded-lg cursor-pointer">
                                    <button type="button" class="absolute flex items-center justify-center w-5 h-5 text-xs text-black bg-white rounded-full top-1 right-1"
                                            wire:click="removePhoto({{ $index }}, {{ $media->id }})"  wire:loading.attr="disabled">
                                        <div class="flex items-center justify-center pb-[2px] font-bold">
                                            <p>x</p>
                                        </div>
                                    </button>
                                </div>
                            @endforeach

                            <!-- Display new photo previews -->
                            @foreach($newPhotoPreviews as $index => $preview)
                                <div class="relative">
                                    <img src="{{ $preview }}"
                                        alt="Loading Photo"
                                        class="w-[150px] h-[90px] object-cover rounded-lg cursor-pointer">
                                    <button type="button" class="absolute flex items-center justify-center w-5 h-5 text-xs text-black bg-white rounded-full top-1 right-1"
                                            wire:click="removePhoto({{ $index }}, {{ $preview }})"  wire:loading.attr="disabled">
                                        <div class="flex items-center justify-center pb-[2px] font-bold">
                                            <p>x</p>
                                        </div>
                                    </button>
                                </div>
                            @endforeach
                            @error('newPhotos')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror

                            <!-- Add Photo Button -->
                            @if (count($this->tempPhotos) + count($newPhotoPreviews) <= 5)
                                <div class="relative" onclick="document.getElementById('file-upload').click()">
                                    <a>
                                        <div class="bg-gray-900 w-[150px] h-[90px] rounded-lg flex justify-center items-center cursor-pointer">
                                            <x-fas-plus-circle class="w-[70px] h-[50px]"/>
                                        </div>
                                    </a>
                                </div>
                                @error('newPhotos')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror

                                <!-- Hidden file input -->
                                <input type="file" multiple id="file-upload" class="hidden" wire:model="newPhotos">
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <!-- Table to display other property data-->
            <div>
                <!-- Property data -->
                <div class="flex w-full h-full gap-4">
                    <!-- General property data -->
                    <div class="w-full">
                        <!-- Property agent -->
                        <div class="mb-4 mr-auto">
                            <label for="name" class="block mb-2 font-bold">Agent:</label>
                            <select wire:model="tempAgent" class="w-full px-3 py-2 bg-gray-800 rounded-lg" >
                                @foreach ($this->agents as $agent)
                                    @if ($agent->id === $tempAgent)
                                        <option value="{{$agent->id}}" selected>{{$agent->name}}</option>
                                    @else
                                        <option value="{{$agent->id}}">{{$agent->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('tempAgent')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Property Name -->
                        <div class="mb-4 mr-auto">
                            <label for="name" class="block mb-2 font-bold">Name:</label>
                            <input wire:model="tempTitle" type="text" name="name" id="name" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('name') border-red-500 @enderror">
                            @error('tempTitle')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Property Price -->
                        <div class="mb-4 mr-auto">
                            <label for="price" class="block mb-2 font-bold">Price:</label>
                            <input wire:model="tempPrice" type="text" name="price" id="price" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('price') border-red-500 @enderror">
                            @error('tempPrice')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Offer Type -->
                        <div class="mb-4 mr-auto">
                            <label class="block mb-2 font-bold">Offer Type:</label>
                            <div class="flex gap-4">
                                <input type="radio" id="for-sale" wire:model="tempOffer" value="Sale" class="hidden" />
                                <label id="offerType" onclick="updateOfferType('Sale')" for="for-sale" class="cursor-pointer flex-1 radio-button px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('offer_type', $this->property->lease_duration === null) == 'sale' ? 'bg-blue-600 text-white' : '' }}">
                                    For Sale
                                </label>

                                <input type="radio" id="for-rent" wire:model="tempOffer" value="Rent" class="hidden" />
                                <label id="offerType" onclick="updateOfferType('Rent')" for="for-rent" class="cursor-pointer flex-1 radio-button px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('offer_type', $this->property->lease_duration !== null) == 'rent' ? 'bg-blue-600 text-white' : '' }}">
                                    For Rent
                                </label>
                            </div>
                            <input type="hidden" name="offer_type" id="offer_type_input" value="{{ old('offer_type', $this->property->lease_duration === null ? 'sale' : 'rent') }}">
                            @error('tempOffer')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4 mr-auto">
                            <label class="block mb-2 font-bold">Status:</label>
                            <div class="flex gap-4">
                                <input type="radio"  id="inputAvailable" wire:model="tempStatus" value="Available" class="hidden" />
                                <label id="Available" onclick="updateStatus('Available')" for="inputAvailable" class="cursor-pointer flex-1 radio-button px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('status', $this->property->status) == 'Available' ? 'bg-blue-600 text-white' : '' }}">
                                    Available
                                </label>

                                @if ($this->property->lease_duration === null)
                                    <input type="radio" id="inputSold" wire:model="tempStatus" value="Sold" class="hidden" />
                                    <label id="Sold" onclick="updateStatus('Sold')" for="inputSold" class="cursor-pointer flex-1 radio-button px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('status', $this->property->status) != 'Available' ? 'bg-blue-600 text-white' : '' }}">
                                        Sold
                                    </label>

                                    <input type="radio" id="inputRented" wire:model="tempStatus" value="Rented" class="hidden" />
                                    <label id="Rented" onclick="updateStatus('Rented')" for="inputRented" class="hidden cursor-pointer flex-1 radio-button px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('status', $this->property->status) != 'Available' ? 'bg-blue-600 text-white' : '' }}">
                                        Rented
                                    </label>
                                @else
                                    <input type="radio" id="inputSold" wire:model="tempStatus" value="Sold" class="hidden" />
                                    <label id="Sold" onclick="updateStatus('Sold')" for="inputSold" class="hidden cursor-pointer flex-1 radio-button px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('status', $this->property->status) != 'Available' ? 'bg-blue-600 text-white' : '' }}">
                                        Sold
                                    </label>

                                    <input type="radio" id="inputRented" wire:model="tempStatus" value="Rented" class="hidden" />
                                    <label id="Rented" onclick="updateStatus('Rented')" for="inputRented" class="cursor-pointer flex-1 radio-button px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('status', $this->property->status) != 'Available' ? 'bg-blue-600 text-white' : '' }}">
                                        Rented
                                    </label>
                                @endif
                            </div>
                            @error('tempStatus')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <input type="hidden" name="status" id="status_input" value="{{ old('status', $this->property->status) }}">

                        </div>
                    </div>

                    <!-- Property description -->
                    <div class="w-full h-full">
                        <!-- Property Price -->
                        <div class="w-full mb-4 mr-auto">
                            <label for="description" class="block mb-2 font-bold">Description:</label>
                            <textarea wire:model="tempDescription" name="description" rows="12" id="description" class="w-full px-3 py-2 border rounded-lg text-balance bg-gray-800 @error('description') border-red-500 @enderror">{{ old('description', $this->property->description) }}</textarea>
                            @error('tempDescription')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Update Button -->
                <form class="" wire:submit.prevent="saveProperty" enctype="multipart/form-data">
                    @csrf
                    <div class="pt-6 text-center">
                        <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg">
                            Update Property

                            {{-- wire:target="saveProperty --}}
                            <div wire:loading wire:target="saveProperty">
                                <svg class="w-4 h-4 text-white bg-blue-600 ">Saving your updates</svg> <!-- SVG loading spinner -->
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
