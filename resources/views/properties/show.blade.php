@php
    $mediaItems = $property->getMedia('property-photos');
    $photoCount = count($mediaItems);
    $lon = $property->lon;
    $lat = $property->lat;
    $propertyName = $property->name;
    $similarProperties = [$property, $property, $property];
@endphp

<x-app-layout>
    <x-slot:title>
        Property name
    </x-slot:title>

    <main class="w-full h-full pt-32 bg-white text-black">
        <div class="h-full w-full flex flex-col justify-center items-center">
            <!-- Property photos -->
            <div class="w-[80%]">
                <livewire:photo-gallery :mediaItems='$mediaItems' :photoCount='$photoCount'/>
            </div>

            <!-- Property/agent information -->
            <div class="h-full w-[80%] rounded-[10px] flex justify-center items-center py-5 gap-4">
                <!-- Property information -->
                <div class="flex flex-col justify-center items-center w-[60%] gap-4">
                    <div class="w-full h-full flex flex-col justify-center items-center bg-yellow-200 py-5 rounded-[5px]">
                        <div class="w-[50%] h-[15%] bg-white rounded-[5px] flex justify-start items-center" >
                            <h6 class="ml-4 text-3xl">{{ $property->name }}</h6>
                        </div>
                        <br>
                        Cijena: {{ $property->price }} KM <br>
                        Ostali podaci <br>
                        Mapa
                    </div>

                    <div class="w-full h-full flex flex-col justify-center items-center rounded-[5px]">
                        <div id="map" class="w-full rounded-[5px] border-[3px]">

                        </div>
                    </div>
                </div>


                <!-- Agents informations (podaci o "useru")-->
                <div class="w-[40%] h-full flex flex-col justify-center items-center bg-teal-300 mb-auto py-5 rounded-[5px]">
                    <div>
                        <p>
                            Agent: {{ $property->user->name }}
                        </p>

                        <p>
                            Contant us: {{ $property->user->phone_number }}
                        </p>
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
        .bindPopup('Vaša nekretnina')
        .openPopup();
</script>
