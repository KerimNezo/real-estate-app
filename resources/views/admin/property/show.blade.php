<x-admin-layout>
    <x-slot:title>
        Property: {{ $property->name }}
    </x-slot:title>

    <!-- Page content -->
    <div class="flex flex-col min-h-screen bg-gray-900">
        <!-- Admin topbar -->
        <div class="fixed top-0 left-0 z-10 w-full bg-gray-800">
            @include('components.topbar-admin')
        </div>

        <div class="flex w-full pt-[100px]">
            @include('components.sidebar-admin')

            <!-- Main content-->
            <div id="main-content" class="w-full bg-gray-900">
                <div class="flex flex-col items-center justify-center w-full z-9">
                    <!-- table to display property media -->
                    <div class="py-8 text-xl text-center px-[6%] w-full">
                        <div>
                            <p class="pb-2 text-sm text-left">
                                Property images
                            </p>
                        </div>
                        <div class="w-full overflow-x-auto">
                            <table class="min-w-full overflow-hidden bg-gray-800 rounded-xl">
                                <!-- Header of the table -->
                                <thead class="w-full bg-gray-800 border-gray-700">
                                    <tr id="table-header" style="width: 100%">
                                        <!-- Key -->
                                        <th class="px-4 py-2 text-lg border-b border-gray-700">
                                            <div class="flex items-center justify-start">
                                                <p class="text-lg">Key</p>
                                            </div>
                                        </th>

                                        <!-- Data -->
                                        <th class="w-full px-4 py-2 text-lg border-b border-gray-700">
                                            <div class="flex items-center justify-start">
                                                <p class="text-lg">Data</p>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="w-full">
                                    <!-- media section -->
                                    <tr class="w-full border-t border-gray-700">
                                        <!-- Key -->
                                        <td class="" id="table-data">
                                            <div class="flex items-center justify-start">
                                                <p class="text-left w-36">Media</p>
                                            </div>
                                        </td>
                                        <!-- Value -->
                                        <td class="w-full" id="table-data">
                                            <div class="flex items-center justify-start w-full space-x-2 overflow-x-auto whitespace-nowrap">
                                                @foreach($property->getMedia('property-photos') as $index => $media)
                                                    <img src="{{ $media->getUrl() }}"
                                                         alt="Property Photo"
                                                         class="w-[150px] h-[90px] object-cover rounded-lg cursor-pointer"
                                                         onclick="openModal('{{ $media->getUrl() }}', {{ $media->order_column }})">
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- table to display property agent data -->
                    <div class="py-8 text-xl text-center px-[6%] w-full">
                        <div>
                            <p class="pb-2 text-sm text-left">
                                Agent information
                            </p>
                        </div>
                        <div class="w-full overflow-x-auto">
                            <table class="min-w-full overflow-hidden bg-gray-800 rounded-xl">
                                <!-- Header of the table -->
                                <thead class="w-full bg-gray-800 border-gray-700">
                                    <tr id="table-header" style="width: 100%">
                                        <!-- Key -->
                                        <th class="px-4 py-2 text-lg border-b border-gray-700">
                                            <div class="flex items-center justify-start">
                                                <p class="text-lg">Key</p>
                                            </div>
                                        </th>

                                        <!-- Data -->
                                        <th class="w-full px-4 py-2 text-lg border-b border-gray-700">
                                            <div class="flex items-center justify-start">
                                                <p class="text-lg">Data</p>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="w-full">
                                    <!-- user data -->
                                    @foreach ($userData as $key => $value)
                                        @if ($key === 'id')
                                        <!-- Don't display his id -->
                                        @else
                                        <tr class="w-full border-t border-gray-700">
                                            <!-- Key -->
                                            <td class="px-4 py-4 text-base leading-6">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-left w-36">
                                                        {{ ucwords(str_replace('_', ' ', $key)) }}
                                                    </p>
                                                </div>
                                            </td>
                                            <!-- Value -->
                                            <td class="w-full px-4 py-4 text-base leading-6">
                                                <div class="flex items-center justify-start">
                                                    @if ($key === 'name')
                                                    <a href="{{ route('single-agent', $user = $property->user) }}">
                                                        <p class="text-left hover:text-white">
                                                            {{ $value }}
                                                        </p>
                                                    </a>
                                                    @else
                                                    <p class="text-left">
                                                        {{ $value }}
                                                    </p>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- table to display property data and properity location on map-->
                    <div class="py-8 text-xl text-center px-[6%] w-full flex justify-center items-center gap-2">
                        <!-- Property data -->
                        <div class="w-[50%]">
                            <div>
                                <p class="pb-2 text-sm text-left">
                                    Property information
                                </p>
                            </div>
                            <div class="w-full overflow-x-auto">
                                <table class="min-w-full overflow-hidden bg-gray-800 rounded-xl">
                                    <!-- Header of the table -->
                                    <thead class="w-full bg-gray-800 border-gray-700">
                                        <tr id="table-header" style="width: 100%">
                                            <!-- Key -->
                                            <th class="px-4 py-2 text-lg border-b border-gray-700">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-lg">Key</p>
                                                </div>
                                            </th>

                                            <!-- Data -->
                                            <th class="w-full px-4 py-2 text-lg border-b border-gray-700">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-lg">Data</p>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="w-full">
                                        <!-- property data -->
                                        @foreach ($propertyData as $key => $value)
                                        <tr class="w-full border-t border-gray-700">
                                            <!-- Key -->
                                            <td class="px-4 py-4 text-base leading-6">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-left w-36">
                                                        {{ ucwords(str_replace('_', ' ', $key)) }}
                                                    </p>
                                                </div>
                                            </td>
                                            <!-- Value -->
                                            <td class="w-full px-4 py-4 text-base leading-6">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-left line-clamp-3">
                                                        @if ($key === 'price')
                                                        {{ number_format($value, 0) }} $
                                                        @elseif ($key === 'surface')
                                                        {{ $value }} m<sup>2</sup>
                                                        @elseif ($key === 'lease_duration' && $value !== 'No')
                                                        {{ $value }} months
                                                        @else
                                                        {{ $value ?? 'No'}}
                                                        @endif
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Property location on map -->
                        <div class="w-[50%]">
                            <div class="w-full h-full flex flex-col justify-center items-center rounded-[5px] px-5 py-4 bg-gray-800 z-8">
                                <div class="pb-4 mr-auto text-2xl font-bold">
                                    <p>Location</p>
                                </div>

                                <div id="map" class="w-full rounded-[5px] border-[3px]">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.footer')
    </div>

    <!-- Full-size image modal -->
    <div id="imageModal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-75 cursor-pointer" onclick="closeModal()">
        <div class="relative max-w-4xl mx-auto cursor-auto" onclick="event.stopPropagation()">
            <span class="absolute flex items-center justify-center px-[9px] py-0 text-2xl text-white bg-gray-700 rounded-full cursor-pointer top-2 right-2" onclick="closeModal()">&times;</span>
            <img id="modalImage" src="" alt="Full View Image" class="mx-auto w-[800px] rounded-[20px]" onclick="closeModal()">

            <!-- Previous and Next buttons -->
            <button id="prevButton" class="absolute h-[52px] w-[52px] px-2 pb-1 text-3xl text-white bg-gray-700 rounded-full cursor-pointer left-2 top-1/2"
                    onclick="prevImage()">&#8249;</button>
            <button id="nextButton" class="absolute h-[52px] w-[52px] px-2 pb-1 text-3xl text-white bg-gray-700 rounded-full cursor-pointer right-2 top-1/2"
                    onclick="nextImage()">&#8250;</button>
        </div>
    </div>

    <script>
        let currentIndex = 0;
        let mediaUrls = @json($urlovi);
        let nextButton = document.getElementById('nextButton');
        let previousButton = document.getElementById('prevButton');
        const photoCount = Object.keys(mediaUrls).length;

        function openModal(imageUrl, index) {
            nextButton.classList.remove('hidden');
            previousButton.classList.remove('hidden');
            currentIndex = index;
            if (currentIndex === photoCount) {
                nextButton.classList.add('hidden');
            } else if (currentIndex === 1) {
                previousButton.classList.add('hidden');
            }
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('imageModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.getElementById('modalImage').src = ''; // Clear the image
            previousButton.classList.remove('hidden');
            previousButton.classList.remove('hidden');
        }

        function nextImage() {
            if (currentIndex === 1) {
                previousButton.classList.remove('hidden');
            }
            currentIndex = currentIndex + 1
            document.getElementById('modalImage').src = mediaUrls[currentIndex];
            if (currentIndex === photoCount) {
                nextButton.classList.add('hidden');
            }
        }

        function prevImage() {
            if (currentIndex === photoCount) {
                nextButton.classList.remove('hidden');
                console.log('makelo je hidden');
            }
            currentIndex = currentIndex - 1
            document.getElementById('modalImage').src = mediaUrls[currentIndex];
            if(currentIndex === 1) {
                previousButton.classList.add('hidden');
            }
        }
    </script>

    <!-- Map script-->
    <script>
        var map = L.map('map');

        map.setView([{{ $lat }}, {{ $lon }}], 16);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([{{ $lat }}, {{ $lon }}]).addTo(map)
            .bindPopup('Your property')
            .openPopup();
    </script>

</x-admin-layout>
