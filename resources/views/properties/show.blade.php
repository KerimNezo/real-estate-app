@php
    $mediaItems = $property->getMedia('property-photos');
    $photoCount = count($mediaItems);

    $similarProperties = [$property, $property, $property];

    $price = number_format($property->price, 0, '.',',');

    $propertyOffer = is_null($property->lease_duration) ? "FOR SELL" : "FOR RENT";
    $color = is_null($property->lease_duration) ? "red" : "sky";
    $property->furnsihed === null ? $furnished = "No" : $furnished = "Yes";
    $property->video_intercom === null ? $video = "No" : $video = "Yes";
    $property->garage === null ? $garage = "No" : $garage = $property->garage;

    $elevator = $property->elevator;
    $keycard = $property->keycard_entry;

    $floor = $property->floors;
    $garden = $property->garden;

    // 1 - office, 2 - house, 3 - appartement
    $propertyType = $property->type->id;
@endphp

<x-app-layout>
    <x-slot:title>
        {{ $property->name }}
    </x-slot:title>

    <main class="w-full h-full pt-32 text-black bg-white">
        <div class="flex flex-col items-center justify-center w-full h-full">
            <!-- Property photos -->
            @if ($photoCount === 0)
                <div class="w-[80%] flex">
                    <div class="flex items-center justify-center w-[50%] h-[300px] mx-auto">
                        <x-ionicon-image-sharp class="h-[300px] mx-auto "/>
                    </div>
                </div>
            @else
                <div class="w-[80%]">
                    <livewire:photo-gallery :mediaItems='$mediaItems' :photoCount='$photoCount' class="w-full mx-auto"/>
                </div>
            @endif

            <!-- Property/agent information -->
            <div id="show-information-section" class="h-full rounded-[10px] flex justify-center items-stretch py-4 gap-4">
                <!-- Property information -->
                <div id="property-info" class="flex flex-col items-center justify-center flex-1">
                    <!-- Property information -->
                    <div class="flex flex-col items-center justify-center w-full gap-4 pb-2">
                        <div class="px-5 py-5 w-full h-full flex flex-col justify-center items-center bg-[#ededed] rounded-[5px]">
                            <!-- Property title and offer -->
                            <div id="offer-header" class="rounded-[5px] justify-start items-center pb-2 w-full">
                                <h3 class="bg-{{$color}}-600 text-white rounded-[5px] p-2 font-bold flex justify-center items-center">
                                    {{ $propertyOffer }}
                                </h3>
                                <h6 class="ml-4 mr-auto text-3xl">
                                    {{ $property->name }}
                                </h6>
                            </div>

                            <!-- Property location -->
                            <div class="rounded-[5px] flex justify-start items-center pb-7 w-full">
                                <div class="pr-1">
                                    <x-ionicon-location-sharp class="w-[20px]"/>
                                </div>

                                <h3 class="mr-auto">
                                    {{ $property->city }}, {{ $property->country }}
                                </h3>
                            </div>

                            <!-- Description title -->
                            <div class="rounded-[5px] flex justify-start items-center pb-4 w-full">
                                <div class="mr-auto text-2xl font-bold">
                                    <p>Description</p>
                                </div>
                            </div>

                            <!-- Proprerty description content-->
                            <div class="w-full text-justify">
                                <p>
                                    {{ $property->description }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Property details (sqrf, lease, price, other details..) -->
                    <div class="flex flex-col items-center justify-center w-full gap-4 pb-2">
                        <div class="px-5 py-4 w-full h-full flex flex-col justify-center items-center bg-[#ededed] rounded-[5px]">
                            <!-- Section title -->
                            <div class="rounded-[5px] flex justify-start items-center pb-2 w-full">
                                <div class="pb-4 mr-auto text-xl font-bold">
                                    <p>Basic Details</p>
                                </div>
                            </div>

                            <!-- Property details content -->
                            <div id="basic-property-details">
                                <!-- First row -->
                                <div id="basic-details-first-row">
                                    <div class="w-[33%] justify-start items-center">
                                        <x-property-detail icon='phosphor-square-half-light' title="SQM" :text="$property->surface" unit="m&sup2" css='w-[48px] h-[48px] fill-[#EF5D60]' />
                                    </div>

                                    <div class="w-[33%] justify-start items-center">
                                        <x-property-detail icon='govicon-construction' title="Year&nbsp;built" :text="$property->year_built" unit="" css='w-[48px] h-[48px] fill-[#EF5D60]' />
                                    </div>

                                    <div class="w-[33%] justify-center items-center">
                                        <x-property-detail icon='bxs-car-garage' title="Garage" :text="$garage" unit="" css='w-[48px] h-[48px]' />
                                    </div>
                                </div>

                                <!-- Second row -->
                                <div id="basic-details-second-row">
                                    <div class="w-[33%] justify-start items-center">
                                        <x-property-detail icon='maki-furniture' title="Furnished" :text="$furnished" unit="" css='w-[48px] h-[48px] fill-[#EF5D60]' />
                                    </div>

                                    <div class="w-[33%] justify-start items-center">
                                        <x-property-detail icon='phosphor-security-camera-duotone' title="Intercom" :text="$video" unit="" css='w-[46px] h-[48px] fill-[#EF5D60]' />
                                    </div>

                                    <div class="w-[33%] justify-center items-center">
                                        @if (!is_null($property->lease_duration) && $property->lease_duration !== 0 )
                                            <x-property-detail icon='ionicon-calendar' title="Lease" text="Yes" unit="" css='w-[46px] h-[48px] fill-[#EF5D60]' />
                                        @else
                                            <x-property-detail icon='ionicon-calendar' title="Lease" text="No" unit="" css='w-[46px] h-[48px] fill-[#EF5D60]' />
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <!-- Other features title -->
                            <div class="rounded-[5px] flex justify-start items-center pb-2 pt-10 w-full">
                                <div class="mr-auto text-xl font-bold">
                                    <p>Other Features</p>
                                </div>
                            </div>

                            <!-- Other features content -->
                            <div class="flex flex-col items-center justify-center w-full">
                                <!-- First row -->
                                <div class="w-full">
                                    @switch($propertyType)
                                        @case(3)
                                            <x-other-features-appartement :$elevator :$keycard />
                                            @break

                                        @case(2)
                                            <x-other-features-house :$floor :$garden />
                                            @break

                                        @default
                                            <x-other-features-office :$elevator :$keycard />
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Property location on map -->
                    <div class="w-full h-full flex flex-col justify-center items-center rounded-[5px] px-5 py-4 bg-[#ededed]">
                        <div class="pb-4 mr-auto text-2xl font-bold">
                            <p>Location</p>
                        </div>

                        <div id="map" class="w-full rounded-[5px] border-[3px]">

                        </div>
                    </div>
                </div>

                <!-- Agents information -->
                <div id="agent-info" class="w-[35%]">
                    <div id="sticky" class="flex flex-col items-center justify-center mb-auto">
                        <!-- Other property data -->
                        <div class="mb-[10px] h-[100px] w-full bg-[#ededed] rounded-[5px] flex flex-col py-5 px-5 justify-center items-center">
                            <!-- Property price -->
                            <div class="rounded-[5px] flex justify-start items-center pb-4 w-full">
                                <h6 class="mr-auto text-2xl">
                                    Price: ${{ number_format($property->price, 0, '.',',') }}
                                </h6>
                            </div>

                            <!-- Property location -->
                            <div class="h-[15%] rounded-[5px] flex justify-start items-center w-full">
                                <h3 class="mr-auto">
                                    {{ $property->city }}, {{ $property->country }}
                                </h3>
                            </div>
                        </div>

                        <!-- Agent data -->
                        <div id="" class="w-full flex mb-auto flex-col justify-center items-center bg-[#ededed] py-5 px-5 rounded-[5px]">
                            <!-- Section header -->
                            <div class="mr-auto text-xl font-bold">
                                <p>Contact Us</p>
                            </div>

                            <!-- Agent information -->
                            <div class="pt-4 mr-auto">
                                <p>
                                    Agent: {{ $property->user->name }}
                                </p>

                                <p>
                                    Contact us: {{ $property->user->phone_number }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Similar properties -->
            <div id="similar-properties" class="h-full bg-[#ededed] w-[80%] mb-8 rounded-[10px] p-5 flex flex-col justify-center items-center">
                <div class="pb-4 mr-auto text-2xl font-bold">
                    <p>Similar Properties You May Like</p>
                </div>

                <!-- Ovdje ćemo dobiti samo listu propertya ($similatProprties) koji su bliski sa otvorenim propertyem koje ćemo izlistati -->
                <div id="similar-properties-list" class="flex items-center justify-center w-full gap-[35px]">
                    @foreach ($similarProperties as $property )
                    <div wire:key="{{ $property['id'] }}" class="w-full">
                        <a href="{{ route('single-property', ['id' => $property->id]) }}" class="w-full">
                            @if (count($property->getMedia('property-photos')) === 0)
                                <x-property-card :h='260' :$property/>
                            @else
                                <x-property-card :h='260' :imageUrl='$property->getFirstMediaUrl("property-photos")' :$property />
                            @endif
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</x-app-layout>


<script>
    var map = L.map('map');

    map.setView([{{ $property->lat }}, {{ $property->lon }}], 16);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker([{{ $property->lat }}, {{ $property->lon }}]).addTo(map)
        .bindPopup('{{$property->name}}')
        .openPopup();
</script>
