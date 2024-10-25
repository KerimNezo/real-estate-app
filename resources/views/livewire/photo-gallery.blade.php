<div>
    <div class="w-full">
        <!-- Primary photo -->
        <div class="w-full">
            <div class="cursor-pointer">
                <div id="dugmeLijevo" wire:click="previousPhoto()">
                    <
                </div>
            </div>

            <div wire:transition class="w-full">
                <img src="{{ $mediaItems[$id]->getUrl() }}" alt="slika" id="mainPhoto" class="w-full">
            </div>

            <div class="cursor-pointer">
                <div id="dugmeDesno" class="ml-auto" wire:click="nextPhoto()">
                    >
                </div>
            </div>
        </div>

        <!-- All photos -->
        <div class="w-full py-4">
            <div class="flex content-center justify-center gap-2">
                @for ($i = 0; $i < $photoCount; $i++)
                    <img src="{{ $mediaItems[$i]->getUrl() }}" wire:click="makeMainPhoto({{$i}})" alt="slika" id="photoList">
                @endfor
            </div>
        </div>
    </div>
</div>
