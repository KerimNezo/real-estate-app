<div>
    <div class="flex flex-col items-center justify-center w-full">
        <!-- Photo gallery header with buttons -->
        <div class="flex flex-col items-center justify-center w-full gap-4 pb-4 sm:flex-row">
            <p class="w-full mr-auto text-lg font-bold text-left whitespace-normal">
                Agent profile picture:
            </p>

            <div class="flex items-center justify-center w-full gap-4 mr-0">
                <button type="button" onclick="document.getElementById('file-upload').click()" class="px-3 py-2 ml-0 mr-auto text-base text-white bg-green-600 rounded-lg sm:ml-auto sm:mr-0">
                    <p>New photo</p>
                </button>

                <input type="file" id="file-upload" class="hidden" wire:model="tempPhoto">

                <button type="button" wire:click="resetPhoto" class="flex items-center justify-center gap-2 px-3 py-2 text-base text-white bg-blue-600 rounded-lg">
                    <div wire:loading wire:target="resetPhoto">
                        <img src="{{ asset('photos/spinner.svg') }}" wire:loading class="w-6 h-6"></img> <!-- SVG loading spinner -->
                    </div>

                    <p>Reset photo</p>
                </button>
            </div>
        </div>

        <div class="flex items-center justify-center w-full">
            <img src="{{ $tempPhoto->getUrl() }}" alt="Agents profile picture" class="h-80">
        </div>
    </div>
</div>
