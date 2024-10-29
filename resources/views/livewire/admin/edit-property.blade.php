<div>
    <!-- Update Property Form -->
    <form action="{{ route('update-property', ['property' => $this->property->id]) }}" method="POST" enctype="multipart/form-data" class="w-full p-4 mx-auto bg-gray-800 rounded-lg shadow-lg">
        @csrf
        @method('PUT')

        <!-- Title -->
        <h1 class="text-xl font-bold text-center">Update Property Information</h1>

        <div class="w-full h-full px-20">
            <!-- Table to display property images -->
            <div class="w-full py-8 text-xl text-center">
                <form wire:submit.prevent="uploadPhotos">
                    <div class="flex items-center justify-center pb-2">
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
                                        alt="New Photo Preview"
                                        class="w-[150px] h-[90px] object-cover rounded-lg cursor-pointer">
                                    <button type="button" class="absolute flex items-center justify-center w-5 h-5 text-xs text-black bg-white rounded-full top-1 right-1"
                                            wire:click="removePhoto({{ $index }}, {{ $preview }})"  wire:loading.attr="disabled">
                                        <div class="flex items-center justify-center pb-[2px] font-bold">
                                            <p>x</p>
                                        </div>
                                    </button>
                                </div>
                            @endforeach

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

            <!-- Property data -->
            <div class="flex w-full h-full gap-4">
                <!-- General property data -->
                <div class="w-full">
                    <!-- Property agent -->
                    <div class="mb-4 mr-auto">
                        <label for="name" class="block mb-2 font-bold">Agent:</label>
                        <select wire:model="tempAgent" class="w-full px-3 py-2 bg-gray-800 rounded-lg" >
                            @foreach ($this->agents as $agent)
                                <option value="{{$agent->id}}">{{$agent->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Property Name -->
                    <div class="mb-4 mr-auto">
                        <label for="name" class="block mb-2 font-bold">Name:</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $this->property->name) }}" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Property Price -->
                    <div class="mb-4 mr-auto">
                        <label for="price" class="block mb-2 font-bold">Price:</label>
                        <input type="text" name="price" id="price" value="{{ old('price', $this->property->price) }}" class="w-full px-3 py-2 border rounded-lg bg-gray-800 @error('price') border-red-500 @enderror">
                        @error('price')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Offer Type -->
                    <div class="mb-4 mr-auto">
                        <label class="block mb-2 font-bold">Offer Type:</label>
                        <div class="flex gap-4">
                            <button type="button" id="offerType"
                                    class="flex-1 px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('offer_type', $this->property->lease_duration === null) == 'sale' ? 'bg-blue-600 text-white' : '' }}"
                                    onclick="updateOfferType('sale')">
                                For Sale
                            </button>
                            <button type="button" id="offerType"
                                    class="flex-1 px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('offer_type', $this->property->lease_duration !== null) == 'rent' ? 'bg-blue-600 text-white' : '' }}"
                                    onclick="updateOfferType('rent')">
                                For Rent
                            </button>
                        </div>
                        <input type="hidden" name="offer_type" id="offer_type_input" value="{{ old('offer_type', $this->property->lease_duration === null ? 'sale' : 'rent') }}">
                    </div>

                    <!-- Status -->
                    <div class="mb-4 mr-auto">
                        <label class="block mb-2 font-bold">Status:</label>
                        <div class="flex gap-4">
                            <button type="button" id="Available"
                                    class="flex-1 px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('status', $this->property->status) == 'Available' ? 'bg-blue-600 text-white' : '' }}"
                                    onclick="updateStatus('Available')">
                                Available
                            </button>
                            @if ($this->property->lease_duration === null)
                                <button type="button" id="Sold"
                                        class="flex-1 px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('status', $this->property->status) == 'Sold' ? 'bg-blue-600 text-white' : '' }}"
                                        onclick="updateStatus('Sold')">
                                    Sold
                                </button>
                            @else
                                <button type="button" id="Sold"
                                        class="flex-1 px-4 py-2 text-center rounded-lg bg-gray-800 border {{ old('status', $this->property->status) == 'Rented' ? 'bg-blue-600 text-white' : '' }}"
                                        onclick="updateStatus('Rented')">
                                    Rented
                                </button>
                            @endif
                        </div>
                        <input type="hidden" name="status" id="status_input" value="{{ old('status', $this->property->status) }}">
                    </div>
                </div>

                <!-- Property description -->
                <div class="w-full h-full">
                    <!-- Property Price -->
                    <div class="w-full mb-4 mr-auto">
                        <label for="description" class="block mb-2 font-bold">Description:</label>
                        <textarea name="description" rows="12" id="description" class="w-full px-3 py-2 border rounded-lg text-balance bg-gray-800 @error('description') border-red-500 @enderror">{{ old('description', $this->property->description) }}</textarea>
                        @error('description')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Button -->
        <div class="pt-6 text-center">
            <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg">
                Update Property
            </button>
        </div>
    </form>
</div>
