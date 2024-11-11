<div>
    <div class="flex flex-col items-center justify-center w-full">
        <!-- Photo gallery header with buttons -->
        <div class="flex flex-col items-center justify-center w-full gap-4 pb-4 sm:flex-row">
            <p class="w-full mr-auto text-lg font-bold text-left">
                Profile picture:
            </p>

            <div class="flex items-center justify-center w-full gap-4 mr-0">
                <button type="button" onclick="document.getElementById('file-upload').click()" class="px-3 py-2 ml-0 mr-auto text-base text-white bg-green-600 rounded-lg sm:ml-auto sm:mr-0">
                    <p>New photo</p>
                </button>

                <input type="file" id="file-upload" class="hidden" wire:model="newPhoto">

                <button type="button" wire:click="resetPhoto" class="flex items-center justify-center gap-2 px-3 py-2 text-base text-white bg-blue-600 rounded-lg">
                    <div wire:loading wire:target="resetPhoto">
                        <img src="{{ asset('photos/spinner.svg') }}" wire:loading class="w-6 h-6"></img> <!-- SVG loading spinner -->
                    </div>

                    <p>Reset photo</p>
                </button>
            </div>
        </div>

        <div class="flex items-center justify-center w-full pt-10">
            <div class="relative" x-data="{ isLoading: true }" x-init="
                $watch('isLoading', (value) => {
                    if (!value && newPhoto) {
                        isLoading = true;
                        const img = new Image();
                        img.src = '{{ $newPhoto ? $newPhoto->temporaryUrl() : '' }}';
                        img.onload = () => { isLoading = false; }
                    }
                });
            ">
                @if ($newPhoto === '')
                    <img src="{{ $tempPhoto->getUrl() }}" alt="Agent's profile picture" class="bg-gray-800 border-4 border-gray-900 h-60">
                @else
                    <img src="{{ $newPhoto->temporaryUrl() }}" alt="Agent's profile picture"
                        x-on:load="isLoading = false"
                        class="bg-gray-800 border-4 border-gray-900 h-60">
                @endif

                <!-- Loader Overlay, shown while newPhoto is being updated or loading -->
                <div x-show="isLoading" wire:loading wire:target="newPhoto"
                    class="absolute inset-0 z-10 flex items-center justify-center bg-gray-700 bg-opacity-75">
                    <img src="{{ asset('photos/spinner.svg') }}" alt="Loading" class="h-60 opacity-80">
                </div>
            </div>
        </div>
    </div>
</div>
