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
            <div id="main-content" class="w-full bg-gray-900 !max-w-[100vw] overflow-scroll flex">
                <div class="flex flex-col items-center justify-center w-[80%] mx-auto gap-8">
                    <!-- table to display property media -->
                    <div class="w-full pt-8 text-xl text-center">
                        {{-- Section Title --}}
                        <div>
                            <p class="pb-2 pl-4 text-sm text-left">
                                Property images
                            </p>
                        </div>

                        {{-- Section Content --}}
                        <div class="px-2 py-2 bg-gray-800 rounded-xl">
                            <div class="flex items-center justify-start w-full max-w-full space-x-2 overflow-scroll rounded-xl">
                                <!-- Display photos from database -->
                                @if ($media->isEmpty())
                                    <x-ionicon-image-sharp class="h-[75px] mr-auto" />
                                @else
                                    @foreach($media as $index => $slika)
                                        <img src="{{ $slika->getUrl() }}"
                                                alt="Property Photo"
                                                class="w-[150px] h-[90px] rounded-lg cursor-pointer flex-shrink-0"
                                                onclick="openModal('{{ $slika->getUrl() }}', {{ $slika->order_column }})">
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- table to display property agent data -->
                    <div class="w-full text-xl text-center">
                        <div>
                            <p class="pb-2 pl-4 text-sm text-left">
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
                    <div class="items-stretch justify-center w-full gap-2 pb-8 text-xl text-center lg:flex sm:flex">
                        <!-- Property data -->
                        <div class="lg:w-[50%] sm:w-full pb-2">
                            <div>
                                <p class="pb-2 pl-4 text-sm text-left">
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
                                                        @if ($key === 'lease_duration')
                                                            For Lease
                                                        @else
                                                            {{ ucwords(str_replace('_', ' ', $key)) }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </td>
                                            <!-- Value -->
                                            <td class="w-full px-4 py-4 text-base leading-6">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-left line-clamp-3">
                                                        @if ($key === 'price')
                                                            $ {{ number_format($value, 0) }}
                                                        @elseif ($key === 'surface')
                                                            {{ $value }} m<sup>2</sup>
                                                        @elseif ($key === 'lease_duration')
                                                            @if ($value === null || $value === 0)
                                                                No
                                                            @else
                                                                Yes
                                                            @endif
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
                        <div class="lg:w-[50%] sm:w-full">
                            <div class="w-full">
                                <p class="pb-2 pl-4 text-sm text-left">
                                    Properity location
                                </p>
                            </div>
                            <div id="sticky" class="w-full flex flex-col justify-center items-center rounded-[5px] px-2 py-2 bg-gray-800">
                                <div id="admin-map" class="w-full rounded-[5px] border-[3px] h-[480px]">

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
        <div class="relative max-w-4xl mx-auto my-auto cursor-auto" onclick="event.stopPropagation()">
            <span class="absolute flex items-center justify-center px-[9px] py-0 text-2xl text-white bg-gray-700 rounded-full cursor-pointer top-2 right-2" onclick="closeModal()">&times;</span>
            <img id="modalImage" src="" alt="Full View Image" class="mx-auto w-[700px] rounded-[20px]" onclick="closeModal()">

            <!-- Previous and Next buttons -->
            <button id="prevButton" class="absolute h-[52px] w-[52px] px-2 pb-1 text-3xl text-white bg-gray-700 rounded-full cursor-pointer left-2 top-1/2"
                    onclick="prevImage()">&#8249;</button>
            <button id="nextButton" class="absolute h-[52px] w-[52px] px-2 pb-1 text-3xl text-white bg-gray-700 rounded-full cursor-pointer right-2 top-1/2"
                    onclick="nextImage()">&#8250;</button>
        </div>
    </div>

    <!-- Image modal script -->
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

        document.addEventListener('keydown', function(event) {
            // Check if the right arrow key is pressed
            if (event.key === "ArrowRight") {
                nextImage(); // Trigger the function
            }
            else if (event.key === "ArrowLeft") {
                prevImage();
            }
        });

        function prevImage() {
            if (currentIndex === photoCount) {
                nextButton.classList.remove('hidden');
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
        var map = L.map('admin-map');

        map.setView([{{ $lat }}, {{ $lon }}], 16);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([{{ $lat }}, {{ $lon }}]).addTo(map)
            .bindPopup('{{ $propertyData['name']}}')
            .openPopup();
    </script>

</x-admin-layout>
