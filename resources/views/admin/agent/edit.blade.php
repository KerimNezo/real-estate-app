<x-admin-layout>
    <x-slot:title>
        All properties
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
            <div id="main-content" class="w-full pt-6 bg-gray-900">
                <!-- Update Property Form -->
                <div>
                    <!-- Update Property Form -->
                    <div class="flex flex-col items-center justify-center w-full p-4 mx-auto bg-gray-800 rounded-lg shadow-lg">
                        <!-- Title -->
                        <h1 class="text-xl font-bold text-center">Update Property Information</h1>

                        <div class="w-full h-full">
                            <!-- Table to display property images -->
                            {{-- <div class="w-full py-8 text-xl text-center">
                                <form wire:submit.prevent="uploadPhotos">
                                    <!-- Photo gallery header with buttons -->
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
                            </div> --}}

                            <!-- Table to display other property data-->
                            <div>
                                <!-- Property data -->
                                <div class="flex flex-col w-full h-full gap-4 sm:flex-row">
                                    <!-- General property data -->
                                    <div class="w-full">
                                        <!-- Agent Name -->
                                        <x-formInput type="text" title="name" label="Name" :value='$agent->name'/>

                                        <!-- Agent email -->
                                        <x-formInput type="text" title="agentEmail" label="Email" :value='$agent->email'/>

                                        <!-- Agent phone number -->
                                        <x-formInput type="text" title="phoneNumber" label="Phone number" :value='$agent->phone_number'/>

                                        <!-- Agent password -->
                                        <x-formInput type="password" title="agentPassword" label="New password" />

                                        <!-- Confirm agent password -->
                                        <x-formInput type="password" title="confirmAgentPassword" label="Confirm new password" />
                                    </div>

                                    <!-- Agent profile picture section (will be a livewire component) -->
                                    {{-- <div class="w-full h-full">
                                        <!-- Property Price -->
                                        <div class="w-full mb-4 mr-auto">
                                            <label for="description" class="block mb-2 font-bold">Description:</label>
                                            <textarea wire:model="tempPicture" name="description" rows="12" id="description" class="w-full px-3 py-2 bg-gray-800 border rounded-lg text-balance"></textarea>
                                            @error('tempPicture')
                                                <p class="text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div> --}}
                                </div>

                                <!-- Update Button -->
                                <form class="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="pt-6 text-center">
                                        <button type="submit"  class="px-6 py-2 text-white bg-blue-600 rounded-lg">
                                            Update Agent
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @include('admin.footer')
    </div>


    <!-- Modal script -->
    <script>

    </script>
</x-admin-layout>
