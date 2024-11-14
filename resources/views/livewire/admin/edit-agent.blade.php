<div>
    <form id="updateForm" enctype="multipart/form-data"  wire:submit="saveAgent">
        @method('PUT')
        @csrf
        <!-- Table to display agent data-->
        <div class="flex flex-col w-full gap-4 lg:flex-row">
            <!-- General property data -->
            <div class="w-full sm:w-[40%] pt-[10px]">
                <!-- Agent Name -->
                <x-formInput type="text" title="name" label="Name & Surname" model='name'/>
                @error('name')
                    <p id="error-message" class="py-2 text-sm text-red-500">{{ $message }}</p>
                @enderror

                <!-- Agent email -->
                <x-formInput type="text" title="email" label="Email" model='email'/>
                @error('email')
                    <p id="error-message" class="py-2 text-sm text-red-500">{{ $message }}</p>
                @enderror

                <!-- Agent phone number -->
                <x-formInput type="text" title="phoneNumber" label="Phone number" model='phoneNumber'/>
                @error('phoneNumber')
                    <p id="error-message" class="py-2 text-sm text-red-500">{{ $message }}</p>
                @enderror

                <!-- Agent password -->
                <x-formInput type="password" title="password" label="New password" model='password' />
                <p class="pb-2 text-xs">
                    Make sure your password is a combination of letters and numbers
                </p>

                <!-- Confirm agent password -->
                <x-formInput type="password" title="confirmPassword" label="Confirm new password" model='confirmPass' />
                @error('confirmPass')
                    <p id="error-message" class="py-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Agent profile picture section (will be a livewire component) -->
            <div class="w-full sm:w-[60%]">
                <livewire:admin.agent-picture :$agentPicture />
            </div>
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
