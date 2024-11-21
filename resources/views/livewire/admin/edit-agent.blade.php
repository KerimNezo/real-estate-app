<div>
    <form id="updateForm" enctype="multipart/form-data"  wire:submit.prevent="saveAgent">
        @csrf
        <!-- Table to display agent data-->
        <div class="flex flex-col w-full gap-4 lg:flex-row">
            <!-- General property data -->
            <div class="w-full sm:w-[40%] pt-[10px]">
                <!-- Agent Name -->
                <x-formInput type="text" title="name" label="Name & Surname" model='name'/>

                <!-- Agent email -->
                <x-formInput type="text" title="email" label="Email" model='email'/>

                <!-- Agent phone number -->
                <x-formInput type="text" title="phoneNumber" label="Phone number" model='phoneNumber'/>

                <!-- Agent password -->
                <x-formInput type="password" title="password" label="New password" model='password' />
                <p class="pb-2 text-xs">
                    Make sure your password is a combination of letters and numbers
                </p>

                <!-- Confirm agent password -->
                <x-formInput type="password" title="password_confirmation" label="Confirm new password" model='password_confirmation' />
            </div>

            <!-- Agent profile picture section (will be a livewire component) -->
            <div class="w-full sm:w-[60%]">
                <livewire:admin.agent-picture wire:model="novaSlika" :$agent />
            </div>
        </div>

        <!-- Update Button -->
        <div class="py-6 text-center">
            <button type="submit" class="px-3 py-2 text-white bg-blue-600 rounded-lg">
                <div class="flex items-center justify-center gap-2">
                    <div id="loader" wire:loading wire:target="saveAgent" class="mr-auto">
                        <img src="{{ asset('photos/spinner.svg') }}" wire:loading class="w-5 h-5"></img> <!-- SVG loading spinner -->
                    </div>

                    Update Agent
                </div>
            </button>
        </div>
    </form>
</div>
