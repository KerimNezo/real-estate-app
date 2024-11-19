<x-admin-layout>
    <x-slot:title>
        Create agent
    </x-slot:title>

    <!-- Page content -->
    <div class="flex flex-col min-h-screen bg-gray-900">
        <!-- Admin topbar -->
        <div class="fixed top-0 left-0 z-10 w-full bg-gray-800">
            @include('components.topbar-admin')
        </div>

        <div class="flex w-full pt-[100px] flex-grow">
            @include('components.sidebar-admin')

            <!-- Main content -->
            <div id="main-content" class="w-full py-6 bg-gray-900">
                <!-- Update Property Form -->
                <div class="flex flex-col items-center justify-center p-4 mx-auto bg-gray-800 rounded-lg shadow-lg w-[80%]">
                    <!-- Title -->
                    <h1 class="py-4 text-xl font-bold text-center">
                        Create New Agent
                    </h1>

                    <div class="w-full h-full px-4">
                        <form id="updateForm" enctype="multipart/form-data"  wire:submit.prevent="saveAgent">
                            @csrf
                            <!-- Table to display agent data-->
                            <div class="flex flex-col w-full gap-4 lg:flex-row">
                                <!-- General property data -->
                                <div class="w-full sm:w-[40%] pt-[10px]">
                                    <!-- Agent Name -->
                                    <x-formInput type="text" title="name" label="Name & Surname" />
                                    @error('name')
                                        <p id="error-message" class="py-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror

                                    <!-- Agent email -->
                                    <x-formInput type="text" title="email" label="Email" />
                                    @error('email')
                                        <p id="error-message" class="py-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror

                                    <!-- Agent phone number -->
                                    <x-formInput type="text" title="phoneNumber" label="Phone number" />
                                    @error('phoneNumber')
                                        <p id="error-message" class="py-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror

                                    <!-- Agent password -->
                                    <x-formInput type="password" title="password" label="New password" />
                                    <p class="pb-2 text-xs">
                                        Make sure your password is a combination of letters and numbers
                                    </p>

                                    <!-- Confirm agent password -->
                                    <x-formInput type="password" title="password_confirmation" label="Confirm new password"  />
                                    @error('password')
                                        <p id="error-message" class="py-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Agent profile picture section (will be a livewire component) -->
                                {{-- <div class="w-full sm:w-[60%]">
                                    <livewire:admin.agent-picture wire:model="novaSlika" :$agent />
                                </div> --}}
                            </div>

                            <!-- Update Button -->
                            <div class="py-6 text-center">
                                <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg">
                                    <div id="loader" wire:loading wire:target="saveAgent" class="mr-auto">
                                        <img src="{{ asset('photos/spinner.svg') }}" wire:loading class="w-6 h-6"></img> <!-- SVG loading spinner -->
                                    </div>

                                    Update Agent
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.footer')
    </div>
</x-admin-layout>
