<div>
    <!-- Update Property Form -->
    <div class="flex flex-col items-center justify-center w-full p-4 mx-auto bg-gray-800 rounded-lg shadow-lg">
        <!-- Title -->
        <h1 class="text-xl font-bold text-center">Update Property Information</h1>

        <div class="w-full h-full">
            <!-- Table to display property images -->
            <div class="w-full py-8 text-xl text-center">
                <form wire:submit.prevent="uploadPhotos">
                    {{-- Photo gallery header with buttons --}}
                    <div class="flex flex-col items-center justify-center gap-4 pb-4 sm:flex-row">
                        <p class="w-full mr-auto text-lg font-bold text-left whitespace-normal">
                            Property images:
                        </p>

                        <div class="flex items-center justify-center w-full gap-4 mr-0">
                            <button type="button" onclick="document.getElementById('file-upload').click()" class="px-3 py-2 ml-0 mr-auto text-base text-white bg-green-600 rounded-lg sm:ml-auto sm:mr-0">
                                <p>New photo</p>
                            </button>

                            <input type="file" multiple id="file-upload" class="hidden" wire:model="newPhotos">

                            <button type="button" wire:click="resetPhotos" class="flex items-center justify-center gap-2 px-3 py-2 text-base text-white bg-blue-600 rounded-lg">
                                <div wire:loading wire:target="resetPhotos">
                                    <img src="{{ asset('photos/spinner.svg') }}" wire:loading class="w-6 h-6"></img> <!-- SVG loading spinner -->
                                </div>

                                <p>Reset photos</p>
                            </button>
                        </div>
                    </div>

                    <!-- Property photos -->
                    <div class="max-w-full overflow-x-scroll">
                        <div class="flex items-center justify-start w-full max-w-full space-x-2 overflow-x-scroll whitespace-nowrap">
                            <!-- Display photos from database -->
                            @foreach($tempPhotos as $media)
                                <div class="relative" wire:key="{{ $media->id }}">
                                    <img src="{{ $media->getUrl() }}"
                                        alt="Property Photo"
                                        class="w-[150px] h-[90px] object-cover rounded-lg cursor-pointer">

                                    <button type="button" class="absolute flex items-center justify-center w-5 h-5 text-xs text-black bg-white rounded-full top-1 right-1"
                                            wire:click="removePhoto({{ $media->order_column }}, {{ $media->id }})"  wire:loading.attr="disabled">
                                        <div class="flex items-center justify-center pb-[2px] font-bold">
                                            <p>x</p>
                                        </div>
                                    </button>

                                    <div wire:loading wire:target="removePhoto({{ $media->order_column }}, {{ $media->id }})"
                                        class="absolute inset-0 z-10 flex items-center justify-center bg-gray-700 bg-opacity-75 rounded-lg">
                                        <img src="{{ asset('photos/spinner.svg') }}" alt="Loading" class="w-[150px] h-[90px] opacity-75">
                                    </div>
                                </div>
                            @endforeach

                            <!-- Display new photo previews -->
                            @foreach($newPhotoArray as $key => $photo)
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

                                    {{-- OVDJE IMAMO ERRORE na removeNewPhoto() kad passamo key --}}

                                    <div wire:loading wire:target="removeNewPhoto('{{ $key }}')"
                                        class="absolute inset-0 z-10 flex items-center justify-center bg-gray-700 bg-opacity-75 rounded-lg">
                                        <img src="{{ asset('photos/spinner.svg') }}" alt="Loading" class="w-[150px] h-[90px] opacity-75">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @error('newPhotos')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror

                    @error('newPhotoPreviews')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </form>
            </div>

            <!-- Table to display other property data-->
            <div>
                <!-- Property data -->
                <div class="flex flex-col w-full h-full gap-4 sm:flex-row">
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
                                <label id="offerType" onclick="updateOfferType('Sale')" for="for-sale" class="cursor-pointer flex-1 radio-button px-4 py-2 text-center rounded-lg bg-gray-800 border {{ $tempOffer === 'Sale' ? 'bg-blue-600 text-white' : '' }}">
                                    For Sale
                                </label>

                                <input type="radio" id="for-rent" wire:model="tempOffer" value="Rent" class="hidden" />
                                <label id="offerType" onclick="updateOfferType('Rent')" for="for-rent" class="cursor-pointer flex-1 radio-button px-4 py-2 text-center rounded-lg bg-gray-800 border {{ $tempOffer === 'Rent' ? 'bg-blue-600 text-white' : '' }}">
                                    For Rent
                                </label>
                            </div>
                            <input type="hidden" name="offer_type" id="offer_type_input" value="{{ $tempOffer }}">
                            @error('tempOffer')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4 mr-auto">
                            <label class="block mb-2 font-bold">Status:</label>
                            <div class="flex gap-4">
                                <input type="radio"  id="inputAvailable" wire:model="tempStatus" value="Available" class="hidden" />
                                <label id="Available" onclick="updateStatus('Available')" for="inputAvailable" class="cursor-pointer flex-1 radio-button px-4 py-2 text-center rounded-lg bg-gray-800 border {{ $tempStatus === 'Available' ? 'bg-blue-600 text-white' : '' }}">
                                    Available
                                </label>

                                <input type="radio" id="inputUnavailable" wire:model="tempStatus" value="Unavailable" class="hidden" />
                                <label id="Unavailable" onclick="updateStatus('Unavailable')" for="inputUnavailable" class="cursor-pointer flex-1 radio-button px-4 py-2 text-center rounded-lg bg-gray-800 border {{ $tempStatus === 'Unavailable' ? 'bg-blue-600 text-white' : '' }}">
                                    Unavailable
                                </label>
                            </div>
                            @error('tempStatus')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <input type="hidden" name="status" id="status_input" value="{{ $tempStatus }}">
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
                        <button type="submit" wire:loading.class="opacity-75" class="px-6 py-2 text-white bg-blue-600 rounded-lg">
                            Update Property

                            {{-- wire:target="saveProperty --}}
                            <div wire:loading>
                                <img src="{{ asset('photos/spinner.svg') }}" wire:loading class="w-6 h-6"></img> <!-- SVG loading spinner -->
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
