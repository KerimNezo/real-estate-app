@props(['property'])

<div id="pozadina" class="group w-full h-[300px] text-white rounded-[15px] flex flex-col justify-end bg-cover" style="background-image:linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.73)), url('{{ $property->getFirstMediaUrl("property-photos")}}')">
    <!-- section about properties offer -->
    <x-property-offer :lease="$property->lease_duration" />

    <!-- section about price and property name -->
    <div id="price" class="m-0 p-0 flex flex-col justify-start w-full ">
        <span class="mr-auto px-6 text-lg font-bold">$ {{ $property->price}}</span>
        <span class="mr-auto px-6 text-lg ">{{$property->name}} - {{$property->city}}</span>
    </div>

    <!-- breakpoint -->
    <div id="breakpoint" class="px-4 py-2">
        <hr class="w-[100%] ">
    </div>

    <!-- section about property attributes -->
    <div id="attributes" class="pb-4 text-base w-full flex item-start">
        @switch($property->type_id)
            @case(1)    <!-- office -->
                <x-card-footer-office :$property/>
                @break

            @case(2)    <!-- kuca -->
                <x-card-footer-house :$property/>
                @break

            @default    <!-- stan -->
                <x-card-footer-appartement :$property/>
        @endswitch
    </div>
</div>
