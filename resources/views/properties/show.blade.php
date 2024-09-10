@php
    $mediaItems = $property->getMedia('property-photos');
    $photoCount = count($mediaItems);
    $similarProperties = [$property, $property, $property];
    $price = number_format($property->price, 0, '.',',');
    if (is_null($property->lease_duration)) {
        $propertyOffer = "FOR SELL";
        $color = "red";
    } else {
        $propertyOffer = "FOR RENT";
        $color = "sky";
    }
    if (is_null($property->furnished)) {
        $furnished = "No";
    } else {
        $furnished = "Yes";
    }
    if (is_null($property->video_intercom)) {
        $video = "No";
    } else {
        $video = "Yes";
    }
@endphp

<x-app-layout>
    <x-slot:title>
        {{ $property->name }}
    </x-slot:title>

    <main class="w-full h-full pt-32 text-black bg-white">
        <div class="flex flex-col items-center justify-center w-full h-full">
            <!-- Property photos -->
            <div class="w-[80%]">
                <livewire:photo-gallery :mediaItems='$mediaItems' :photoCount='$photoCount'/>
            </div>

            <!-- Property/agent information -->
            <div class="h-full w-[80%] rounded-[10px] flex justify-center items-stretch py-4 gap-4">
                <!-- Property information -->
                <div id="PropertyInfo" class="flex flex-col justify-center items-center w-[65%] flex-1">
                    <!-- Property information -->
                    <div class="flex flex-col items-center justify-center w-full gap-4 pb-2">
                        <div class="px-5 py-5 w-full h-full flex flex-col justify-center items-center bg-[#ededed] rounded-[5px]">
                            <!-- Property title and offer -->
                            <div class="rounded-[5px] flex justify-start items-center pb-2 w-full">
                                <h3 class="bg-{{$color}}-600 text-white rounded-[5px] p-2 font-bold                             flex justify-center items-center">
                                    {{ $propertyOffer }}
                                </h3>
                                <h6 class="ml-4 mr-auto text-3xl">
                                    {{ $property->name }}
                                </h6>
                            </div>

                            <!-- Property location -->
                            <div class="rounded-[5px] flex justify-start items-center pb-7 w-full">
                                <h3 class="mr-auto">
                                    {{ $property->city }}, {{ $property->country }}
                                </h3>
                            </div>

                            <!-- Description title -->
                            <div class="rounded-[5px] flex justify-start items-center pb-2 w-full">
                                <h3 class="mr-auto text-2xl">
                                    Description
                                </h3>
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
                                <h3 class="pb-2 mr-auto text-2xl">
                                    Basic details
                                </h3>
                            </div>

                            <!-- Proprerty details content -->
                            <div class="flex flex-col items-center justify-center w-full gap-7">
                                <!-- First row -->
                                <div class="flex items-center justify-center w-full">
                                    <x-property-detail icon='phosphor-square-half-light' title="SQM" :text="$property->surface" unit="m&sup2" css='w-[48px] h-[48px]' />

                                    <x-property-detail icon='ionicon-calendar' title="Lease" :text="$property->lease_duration" unit="months" css='w-[40px] h-[40px]' />

                                    <x-property-detail icon='bxs-car-garage' title="Garage" :text="$property->garage" unit="" css='w-[40px] h-[40px]' />
                                </div>

                                <!-- Second row -->
                                <div class="flex items-center justify-center w-full">
                                    <x-property-detail icon='maki-furniture' title="Furnished" :text="$furnished" unit="" css='w-[40px] h-[40px] fill-[#EF5D60]' />

                                    <x-property-detail icon='phosphor-security-camera-duotone' title="Video interface" :text="$video" unit="" css='w-[40px] h-[40px] fill-[#EF5D60]' />

                                    <x-property-detail icon='govicon-construction' title="Year built" :text="$property->year_built" unit="" css='w-[48px] h-[48px] fill-[#EF5D60]' />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Property location on map -->
                    <div class="w-full h-full flex flex-col justify-center items-center rounded-[5px] px-5 py-4 bg-[#ededed]">
                        <div class="mr-auto text-2xl pb-7">
                            <b>Location</b>
                        </div>

                        <div id="map" class="w-full rounded-[5px] border-[3px]">

                        </div>
                    </div>
                </div>

                <!-- Agents information -->
                <div id="AgentInfo" class="!w-[35%]  min-h-screen relative">
                    <div class="sticky top-[0] z-[100] flex flex-col justify-center items-center mb-auto">
                        <!-- Property price -->
                        <div id="" class="mb-[10px] h-[100px] w-full bg-green-300 rounded-[5px] flex flex-col py-5 px-5 justify-center items-center">
                            <!-- Property price -->
                            <div class="rounded-[5px] flex justify-start items-center pb-4 w-full">
                                <h6 class="mr-auto text-2xl">
                                    Price: ${{$price}}
                                </h6>
                            </div>

                            <!-- Lease duration -->
                            <div class="h-[15%] rounded-[5px] flex justify-start items-center w-full">
                                <h3 class="mr-auto">
                                    {{ $property->city }}, {{ $property->country }}
                                </h3>
                            </div>
                        </div>

                        <!-- Agent data -->
                        <div id="" class="w-full flex mb-auto flex-col justify-center items-center bg-teal-300 py-5 px-5 rounded-[5px]">
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
            <div class="h-[400px] bg-[#5eb1f0] w-[80%] my-4 gap-8 rounded-[10px] flex justify-center items-center content-stretch">
                <!-- Ovdje ćemo dobiti samo listu propertya koji su bliski sa otvorenim propertyem koje ćemo izlistati -->
                @foreach ($similarProperties as $property )
                    <a href="{{ route('single-property', ['id' => $property->id]) }}">
                        <x-property-card :$property/>
                    </a>
                @endforeach
            </div>
        </div>
    </main>
</x-app-layout>


<script>
    var map = L.map('map');

    map.setView([{{ $property->lat }}, {{ $property->lon }}], 17);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker([{{ $property->lat }}, {{ $property->lon }}]).addTo(map)
        .bindPopup('Your property')
        .openPopup();
</script>
