@props(['property', 'imageUrl' => asset('./photos/house-placeholder.jpg'), 'h'])

<div id="pozadina" class="group w-full text-white rounded-[15px] flex flex-col justify-end bg-cover" style="background-image:linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.73)), url({{ $imageUrl }}); height: {{ $h }}px;">
    <!-- section about properties offer -->
    <x-property-offer :lease="$property->lease_duration" />

    <!-- section about price and property name -->
    <div id="price" class="flex flex-col justify-start w-full p-0 m-0 ">
        <div class="px-6 mr-auto">
            <p class="font-bold backdrop-blur-sm bg-white/10 rounded-[5px] px-1">$ {{ $property->price }}</p>
        </div>
        <div class="px-6 mt-1 mr-auto">
            <p class="font-bold backdrop-blur-sm bg-white/10 rounded-[5px] px-1">{{ $property->name }} - {{ $property->city }}</p>
        </div>
    </div>

    <!-- breakpoint -->
    <div id="breakpoint" class="px-4 py-2">
        <hr class="w-full">
    </div>

    <!-- section about property attributes -->
    <div id="attributes" class="flex w-full pb-4 text-base item-start">
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
