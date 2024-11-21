<div>
    <form id="storeForm" enctype="multipart/form-data"  wire:submit.prevent="storeAgent">
        @csrf
        <!-- Table to display agent data-->
        <div class="flex flex-col w-full gap-4 lg:flex-row">
            <!-- General property data -->
            <div class="w-full sm:w-[40%] pt-[10px] flex flex-col items-center justify-center">
                <div class="mb-auto mr-auto">
                    <p class="text-lg font-bold">
                        Agents data
                    </p>
                </div>

                <div class="w-full">
                    <!-- Agent Name -->
                    <x-formInput type="text" title="name" label="Name & Surname" model='name' placeholder="John Doe" />

                    <!-- Agent email -->
                    <x-formInput type="text" title="email" label="Email" model='email' placeholder="johndoe@mail.com" />

                    <!-- Agent phone number -->
                    <x-formInput type="text" title="phoneNumber" label="Phone number" model='phoneNumber' placeholder="(xxx) xxx xxxx" />

                    <!-- Agent password -->
                    <x-formInput type="password" title="password" label="New password" model='password' placeholder="" />
                    <p class="pb-2 text-xs">
                        Make sure your password is a combination of letters and numbers
                    </p>
                </div>
            </div>

            <!-- Agent profile picture section (will be a livewire component) -->
            <div class="w-full sm:w-[60%]">
                <div class="flex flex-col items-center justify-center w-full">
                    <!-- Photo gallery header with buttons -->
                    <div class="flex flex-col items-center justify-center w-full pb-4 sm:flex-row">
                        <p class="mr-auto text-lg font-bold text-left whitespace-nowrap">
                            Profile picture:
                        </p>

                        <div class="flex items-center justify-center w-full gap-4 pt-4 mr-0 sm:pt-0">
                            <button type="button" onclick="document.getElementById('file-upload').click()" class="px-3 py-2 ml-0 mr-auto text-base text-white bg-green-600 rounded-lg sm:ml-auto sm:mr-0">
                                <p>New photo</p>
                            </button>

                            <input type="file" id="file-upload" class="hidden" wire:model.blur="newPhoto" />
                        </div>
                    </div>

                    <div class="flex flex-col items-center justify-center w-full py-8">
                        <div class="relative">
                            @if ($this->newPhoto !== null && $this->newPhoto->getMimeType() !== '')
                                <img src="{{ $newPhoto->temporaryUrl() }}" name="newPhoto" alt="Agent's new profile picture" class="bg-gray-800 border-4 border-gray-900 sm:h-72 h-52">
                            @else
                                <img src="{{ asset('photos/icons/realestateagent.png') }}" alt="Agent's profile picture" class="bg-gray-800 border-4 border-gray-900 sm:h-72 h-52 opacity-30">
                            @endif

                            <!-- Loader Overlay, shown while newPhoto is being updated or loading -->
                            <div wire:loading wire:target="newPhoto" class="absolute inset-0 z-10 flex items-center justify-center bg-gray-700 bg-opacity-75 px-auto">
                                <img src="{{ asset('photos/spinner.svg') }}" alt="Loading" class="w-full sm:h-72 h-52 opacity-80 pl-auto pr-auto">
                            </div>
                        </div>

                        @error('newPhoto')
                            <p id="error-message" class="pt-4 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Button -->
        <div class="py-6 text-center">
            <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg">
                <div id="loader" wire:loading wire:target="storeAgent" class="mr-auto">
                    <img src="{{ asset('photos/spinner.svg') }}" wire:loading class="w-6 h-6"></img> <!-- SVG loading spinner -->
                </div>

                Create Agent
            </button>
        </div>
    </form>
</div>
