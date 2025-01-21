@props(['property'])

<ul class="flex items-center justify-start w-full gap-3 px-6">
    @if (!is_null($property->bedrooms))
        <li class="flex items-center justify-center gap-1">
            <x-ionicon-bed class="w-[30px] h-[30px] fill-white"/>
            <p class="text-sm">{{ $property->bedrooms }}</p>
        </li>
    @endif

    @if (!is_null($property->surface))
        <li class="flex items-center justify-center gap-1">
            <x-phosphor-square-half-light class="w-[36px] h-[36px] fill-white"/>
            <p class="text-sm">{{ $property->surface }} m&sup2; </p>
        </li>
    @endif

    @if (!is_null($property->toilets))
        <li class="flex items-center justify-center gap-1">
            <x-eos-shower-o class="w-[32px] h-[32px] fill-white"/>
            <p class="text-sm">{{ $property->toilets }}</p>
        </li>
    @endif

    @if (!is_null($property->garage))
        <li class="flex items-center justify-center gap-1">
            <x-bxs-car-garage class="w-[30px] h-[30px] fill-white"/>
            <p class="text-sm">{{ $property->garage }}</p>
        </li>
    @endif
</ul>

