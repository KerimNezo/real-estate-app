
<div>
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

                <input type="file" id="file-upload" class="hidden" wire:model="newPhoto" />

                <button type="button" wire:click="resetPhoto" class="flex items-center justify-center gap-2 px-3 py-2 text-base text-white bg-blue-600 rounded-lg">
                    <div wire:loading wire:target="resetPhoto">
                        <img src="{{ asset('photos/spinner.svg') }}" wire:loading class="w-6 h-6"></img> <!-- SVG loading spinner -->
                    </div>

                    <p>Reset photo</p>
                </button>
            </div>
        </div>

        <div class="flex flex-col items-center justify-center w-full py-8">
            <div class="relative">
                @if ($this->newPhoto !== null && $this->newPhoto->getMimeType() !== '')
                    <img src="{{ $newPhoto->temporaryUrl() }}" name="newPhoto" alt="Agent's new profile picture" class="bg-gray-800 border-4 border-gray-900 sm:h-72 h-52">
                @else
                    <img src="{{ $this->tempPhoto->getUrl() }}" alt="Agent's profile picture" class="bg-gray-800 border-4 border-gray-900 sm:h-72 h-52">
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
