@props(['property'])

<div id="pozadina" class="group w-full h-[300px] text-white rounded-[15px] flex flex-col justify-end bg-cover " style="background-image:linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.73)), url('{{ $property->getFirstMediaUrl("property-photos")}}')">
    <x-property-offer :lease="$property->lease_duration" />

    <div id="price" class="m-0 p-0 flex flex-col justify-start w-full ">
        <span class="mr-auto px-6 text-lg font-bold">$ {{ $property->price}}</span>
        <span class="mr-auto px-6 text-lg ">{{ $property->name}}</span>
    </div>
    <div class="px-4 py-2">
        <hr class="w-[100%] ">
    </div>
    <div id="attributes" class="pb-4 text-base w-full flex item-start ml-6">
        ovdje idu ikone i info o njima
    </div>
</div>
