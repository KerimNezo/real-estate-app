<div>
    <div class="w-full">
        <!-- Primary photo -->
        <div class="w-full">
            <div class="cursor-pointer" id="dugme-show-page">
                <div id="dugmeLijevo" wire:click="previousPhoto()">
                    <
                </div>
            </div>

            <div wire:transition class="w-full">
                <img src="{{ $mediaItems[$id]->getUrl() }}" alt="slika" id="mainPhoto" class="w-full">
            </div>

            <div class="cursor-pointer" id="dugme-show-page">
                <div id="dugmeDesno" class="ml-auto" wire:click="nextPhoto()">
                    >
                </div>
            </div>
        </div>

        <!-- All photos -->
        <div class="w-full max-w-full py-4 overflow-x-scroll">
            <div class="flex items-center gap-2 whitespace-nowrap">
                @for ($i = 0; $i < $photoCount; $i++)
                    <img src="{{ $mediaItems[$i]->getUrl() }}" wire:click="makeMainPhoto({{ $i }})" alt="Photo" class="w-[230px] h-[140px] object-cover rounded-lg cursor-pointer">
                @endfor
            </div>
        </div>
    </div>
</div>
