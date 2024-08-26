@php
    $mediaItems = $property->getMedia('property-photos');
    $photoCount = count($mediaItems);
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
            <div class="h-[200px] bg-green-400 w-[80%] rounded-[10px] flex justify-center items-center">
                <!-- Property information -->
                <div class="w-[50%] flex flex-col justify-center items-center">
                    {{ $property->name }} <br>
                    Cijena: {{ $property->price }} KM <br>
                    Ostali podaci <br>
                    Mapa
                </div>

                <!-- Agents informations (podaci o "useru")-->
                <div class="w-[50%] flex flex-col justify-center items-center">
                    Agent: {{ $property->user->name }}
                </div>
            </div>

            <!-- Similar properties -->
            <div class="h-[200px] bg-orange-400 w-[80%] my-4 rounded-[10px]">
                <!-- Ovdje ćemo dobiti samo listu propertya koji su bliski sa otvorenim propertyem koje ćemo izlistati -->
                <div class="mt-4 ml-4">
                    Similar properties
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
