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
            <div class="h-full w-[80%] rounded-[10px] flex justify-center items-center py-5">
                <!-- Property information -->
                <div class="w-[60%] h-full flex flex-col justify-center items-center bg-yellow-200 py-5 mr-4 rounded-[5px]">
                    <div class="w-[50%] h-[15%] bg-white rounded-[5px] flex justify-start items-center" >
                        <p class="ml-4">{{ $property->name }}</p>
                    </div>
                    <br>
                    Cijena: {{ $property->price }} KM <br>
                    Ostali podaci <br>
                    Mapa
                </div>

                <!-- Agents informations (podaci o "useru")-->
                <div class="w-[40%] h-full flex flex-col justify-center items-center bg-teal-300 py-5 rounded-[5px]">
                    <div>
                        Agent: {{ $property->user->name }}
                    </div>
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
