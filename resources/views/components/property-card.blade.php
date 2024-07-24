@props(['property'])

<div class="w-full h-[350px] text-white rounded-[15px] flex flex-col justify-end bg-cover" style="background-image:linear-gradient(to bottom, transparent, rgba(31, 31, 31, 0.73)), url('{{ $property->getFirstMediaUrl("property-photos")}}')">
    <x-property-offer :lease="$property->lease_duration" />

    <div id="price" class="m-0 p-0">
        <span>{{ $property->name}} - {{ $property->price ?? 'cijene nema' }}</span>
    </div>
    <div class="px-4 py-2">
        <hr class="w-[100%] ">
    </div>
    <div id="attributes" class="pb-4 text-base w-full flex item-start ml-4">
        ovdje idu ikone i info o njima
    </div>
</div>
