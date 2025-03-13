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
                            <button type="button" wire:click="resetPhotos" class="flex items-center justify-center px-3 py-2 ml-auto mr-0 text-base text-white bg-blue-600 rounded-lg sm:ml-auto sm:mr-0">
                                <div wire:loading wire:target="resetPhotos">
                                    <img src="{{ asset('photos/spinner.svg') }}" wire:loading class="w-5 h-5 mr-1"></img> <!-- SVG loading spinner -->
                                </div>

                                <p>Reset photos</p>
                            </button>
                            
                            <button type="button" onclick="document.getElementById('file-upload').click()" class="gap-2 px-3 py-2 text-base text-white bg-green-600 rounded-lg">
                                <p>New photo</p>
                            </button>

                            <input type="file" multiple id="file-upload" class="hidden" wire:model="newPhotos">
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
                                        alt="loading..."
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
                        @if (Auth::user()->hasRole('admin'))
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
                        @endif

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

                <div class="flex items-center justify-center gap-4 pt-6 text-center">
                    <form class="flex w-full" wire:submit.prevent="saveProperty" enctype="multipart/form-data">
                        @csrf
                        <button type="submit" wire:loading.class="opacity-75" class="flex px-6 py-2 gap-2 text-white bg-blue-600 rounded-lg
                                @if(Auth::user()->hasRole('admin') && $this->property->transaction_at === null) ml-auto @else mx-auto @endif">
                            <p>Update Property</p>

                            {{-- wire:target="saveProperty --}}
                            <div wire:loading wire:target="saveProperty" class="flex items-center justify-center">
                                <img src="{{ asset('photos/spinner.svg') }}" wire:loading class="w-5 h-5"></img> <!-- SVG loading spinner -->
                            </div>
                        </button>
                    </form>

                    @if (Auth::user()->hasRole('admin') && $this->property->transaction_at === null)
                        <div class="w-full">
                            <button type="submit" wire:loading.class="opacity-75" class="flex gap-2 px-6 py-2 mr-auto text-white bg-yellow-600 rounded-lg" onclick="openConfirmationModal({{$property}}, '{{$property->getFirstMediaUrl('property-photos')}}')">
                                @if ($this->property->lease_duration > 0)
                                    <p>Rent property</p>
                                @else
                                    <p>Sell property</p>
                                @endif
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if (Auth::user()->hasRole('admin') && $this->property->transaction_at === null)
        <!-- Confirmation form modal -->
        <div id="confirmationButtonModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-95" onclick="closeConfirmationModal(event)">
            <div class="bg-gray-900 bg-opacity-95 rounded-[20px] w-[450px] h-[350px] relative mx-auto my-auto" onclick="event.stopPropagation()">
                <div class="flex flex-col items-center justify-center h-full p-2">
                    {{-- x button --}}
                    <span class="absolute flex items-center justify-center px-[10px] py-0 text-2xl text-white bg-gray-700 rounded-full cursor-pointer top-3 right-3 text-center" onclick="closeConfirmationModal()">&times;</span>

                    {{-- Header text --}}
                    <div class="flex items-center justify-center w-full px-5 mx-auto mt-10">
                        @if ($this->property->lease_duration > 0)
                            <p class="text-2xl text-center">Are you sure you want rent to this property?</p>
                        @else
                            <p class="text-2xl text-center">Are you sure you want sell to this property?</p>
                        @endif
                    </div>

                    {{-- Action explanation text --}}
                    <div class="mb-auto">
                        <p class="text-xs">(Confirming this will permanently edit the selected property)</p>
                    </div>

                    {{-- Property details --}}
                    <div class="flex w-full px-5 py-3">
                        {{-- Property image --}}
                        <div class="px-5 bg-gray-800 rounded-[20px] w-full py-3 flex justify-center items-center">
                            <img id="propertyPhoto" src="" alt="Property image" class="w-24 rounded-[10px] mr-auto">
                            <p id="propertyName" class="text-base text-center"></p>
                        </div>
                    </div>

                    {{-- Form footer containing two buttons --}}
                    <div class="flex w-full px-5 py-5">
                        <button class="px-4 py-2 mr-auto bg-green-600 rounded-[10px]" onclick="closeConfirmationModal()">
                            Cancel
                        </button>

                        <!-- Hidden form for deletion -->
                        <form class="flex" wire:submit.prevent="makeTransaction" enctype="multipart/form-data">
                            @csrf
                            <button type="submit" wire:loading.class="opacity-75" class="flex gap-2 px-6 py-2 mr-auto text-white bg-yellow-600 rounded-lg">
                                @if ($this->property->lease_duration > 0)
                                    <p>Rent property</p>
                                @else
                                    <p>Sell property</p>
                                @endif

                                {{-- wire:target="saveProperty --}}
                                <div wire:loading wire:target="makeTransaction" class="flex items-center justify-center">
                                    <img src="{{ asset('photos/spinner.svg') }}" wire:loading class="w-5 h-5"></img> <!-- SVG loading spinner -->
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
    function openConfirmationModal(property, imageUrl) {
        document.getElementById('confirmationButtonModal').classList.remove('hidden');
        document.getElementById('confirmationButtonModal').classList.add('flex');
        document.getElementById('propertyPhoto').src = imageUrl;
        document.getElementById('propertyName').textContent = property.name;
    }

    function closeConfirmationModal(event) {
        if (event) {
            event.stopPropagation(); // Prevents the event from bubbling if the click was on the modal content
        }
        document.getElementById('confirmationButtonModal').classList.add('hidden');
    }
    </script>
</div>
