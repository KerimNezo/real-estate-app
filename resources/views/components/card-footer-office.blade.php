@props(['property'])

<ul class="flex justify-start items-center gap-3 w-full px-6">
    @if (!is_null($property->surface))
        <li class="flex justify-center items-center gap-1">
            <x-phosphor-square-half-light class="w-[36px] h-[36px] fill-[#EF5D60]"/>
            <p class="text-sm">{{ $property->surface }} m&sup2; </p>
        </li>
    @endif

    @if (!is_null($property->garage))
        <li class="flex justify-center items-center gap-1">
            <x-bxs-car-garage class="w-[30px] h-[30px] fill-[#EF5D60]"/>
            <p class="text-sm">{{ $property->garage }}</p>
        </li>
    @endif

    @if (!is_null($property->floors))
        <li class="flex justify-center items-center gap-1">
            <x-bi-building class="w-[25px] h-[25px] text-[#EF5D60]"/>
            <p class="text-sm">{{ $property->floors }}</p>
        </li>
    @endif

    @if (!is_null($property->keycard_entry))
        <li class="flex justify-center items-center gap-1">
            <x-heroicon-s-credit-card class="w-[30px] h-[30px] text-[#EF5D60]"/>
            <p class="text-sm"></p>
        </li>
    @endif
</ul>
