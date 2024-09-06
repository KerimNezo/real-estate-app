@php
    $mediaItems = $property->getMedia('property-photos');
    $photoCount = count($mediaItems);
    $lon = $property->lon;
    $lat = $property->lat;
    $propertyName = $property->name;
    $similarProperties = [$property, $property, $property];
    if (is_null($property->lease_duration)) {
        $propertyOffer = "FOR SELL";
        $color = "red";
    } else {
        $propertyOffer = "FOR RENT";
        $color = "sky";
    }
    $cijena = $property->price;
    $price = number_format($cijena, 0, '.',',');
@endphp

<x-app-layout>
    <x-slot:title>
        {{$propertyName}}
    </x-slot:title>

    <main class="w-full h-full pt-32 bg-white text-black">
        <div class="h-full w-full flex flex-col justify-center items-center">
            <!-- Property photos -->
            <div class="w-[80%]">
                <livewire:photo-gallery :mediaItems='$mediaItems' :photoCount='$photoCount'/>
            </div>

            <!-- Property/agent information -->
            <div class="h-full w-[80%] rounded-[10px] flex justify-center items-stretch py-4 gap-4">
                <!-- Property information -->
                <div id="PropertyInfo" class="flex flex-col justify-center items-center w-[60%] flex-1">
                    <!-- Property information -->
                    <div class="flex flex-col justify-center items-center w-full gap-4 pb-2">
                        <div class="px-5 py-5 w-full h-full flex flex-col justify-center items-center bg-yellow-200 rounded-[5px]">
                            <!-- Property title and offer -->
                            <div class="h-[15%] rounded-[5px] flex justify-start items-center pb-2 w-full">
                                <h3 class="bg-{{$color}}-600 text-white rounded-[5px] p-2 font-bold flex justify-center items-center">
                                    {{ $propertyOffer }}
                                </h3>
                                <h6 class="ml-4 text-3xl mr-auto">
                                    {{ $property->name }}
                                </h6>
                            </div>

                            <!-- Property location -->
                            <div class="h-[15%] rounded-[5px] flex justify-start items-center pb-7 w-full">
                                <h3 class="mr-auto">
                                    {{ $property->city }}, {{ $property->country }}
                                </h3>
                            </div>

                            <!-- Description title -->
                            <div class="h-[15%] rounded-[5px] flex justify-start items-center pb-2 w-full">
                                <h3 class="text-2xl mr-auto">
                                    Description
                                </h3>
                            </div>

                            <!-- Proprerty description content-->
                            <div class="text-justify w-full">
                                <p>
                                    {{ $property->description }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Property details (sqrf, lease, price, other details..) -->
                    <div class="flex flex-col justify-center items-center w-full gap-4 pb-2">
                        <div class="px-5 py-10 w-full h-full flex flex-col justify-center items-center bg-yellow-200 rounded-[5px]">
                            Dodatni detalji o nekretnini
                        </div>
                    </div>

                    <!-- Property location on map -->
                    <div class="w-full h-full flex flex-col justify-center items-center rounded-[5px] px-5 py-10 bg-yellow-200">
                        <div class="text-2xl mr-auto pb-10">
                            <b>Location</b>
                        </div>

                        <div id="map" class="w-full rounded-[5px] border-[3px]">

                        </div>
                    </div>
                </div>

                <!-- Agents information -->
                <div id="AgentInfo" class="w-[40%] flex-1 min-h-screen relative">
                    <div class="w-full sticky top-[0] z-[100] flex flex-col justify-center items-center mb-auto">
                        <!-- Property price -->
                        <div id="" class="mb-[10px] h-[100px] w-full bg-green-300 rounded-[5px] flex flex-col py-5 px-5 justify-center items-center">
                            <!-- Property price -->
                            <div class="rounded-[5px] flex justify-start items-center pb-5 w-full">
                                <h6 class="text-2xl mr-auto">
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
                            <div class="mr-auto text-xl font-bold">
                                <p>Contact Us</p>
                            </div>

                            <div class="mr-auto pt-4">
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
            <div class="h-[400px] bg-orange-400 w-[80%] my-4 rounded-[10px] flex justify-center items-center content-stretch">
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

    map.setView([{{ $lat }}, {{ $lon }}], 17);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker([{{ $lat }}, {{ $lon }}]).addTo(map)
        .bindPopup('Your property')
        .openPopup();
</script>
