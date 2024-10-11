<x-admin-layout>
    <x-slot:title>
        All properties
    </x-slot:title>

    <!-- Page content -->
    <div class="flex flex-col min-h-screen bg-gray-900">
        <!-- Admin topbar -->
        <div class="fixed top-0 left-0 z-10 w-full bg-gray-800">
            @include('components.topbar-admin')
        </div>

        <div class="flex w-full pt-[100px] flex-grow">
            @include('components.sidebar-admin')

            <!-- Main content -->
            <div id="main-content" class="flex flex-col flex-grow w-full pt-10 bg-gray-900">
                <!-- Index query form -->
                <form id="submit-form" action="{{ route('admin-properties')}}" method="GET">
                    <div class="flex lg:flex-row flex-col sm:items-start lg:items-center justify-center w-full z-9 px-[6%]">
                        <p class="pb-2 mr-auto text-base lg:pb-0">All properties</p>

                        <!-- Status (Sold - For Sale - Rent) -->
                        {{-- <div class="flex-col items-center justify-center pr-3 ml-auto">
                            <select id="" class="rounded-[5px] h-[35px] pl-[10px] pr-8 text-[#989898]-black bg-gray-800" name="asset-offer-id">
                                <option value="0" disabled selected>Offer</option>
                                <option value="1">Sale</option>
                                <option value="2">Remt</option>
                                <option value="3">Sold</option>
                            </select>
                        </div> --}}

                        <!-- cities -->
                        <div class="flex-col items-center justify-center pb-2 lg:pr-3 lg:mr-0 lg:ml-auto sm:ml-0 sm:mr-auto lg:pb-0">
                            <select id="" class="rounded-[5px] h-[40px] pl-[10px] pr-8 text-[#989898]-black bg-gray-800 w-full" name="asset-location">
                                <option value="0" disabled selected>City</option>
                                @foreach ($cities as $city)
                                    <option value="{{$city}}">{{$city}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- property type -->
                        <div class="flex-col items-center justify-center pb-2 lg:pr-3 lg:pb-0 sm:mr-auto lg:mr-0">
                            <select id="" class="w-full rounded-[5px] h-[40px] pl-[10px] pr-8 text-[#989898]-black bg-gray-800" name="type-of-asset-id">
                                <option value="0" disabled selected>Choose property type</option>
                                <option value="1">Office</option>
                                <option value="2">House</option>
                                <option value="3">Appartement</option>
                            </select>
                        </div>

                        <!-- price -->
                        <div class="flex-col items-center justify-center pb-2 lg:pr-3 lg:pb-0 sm:mr-auto lg:mr-0">
                            <div class="flex flex-col justify-center w-full gap-2 sm:items-start lg:items-center lg:flex-row">
                                <input type="text" placeholder="1200" class="rounded-[5px] h-[40px] text-[#989898] bg-gray-800 lg:w-[150px] " name="min-price">

                                <span>to</span>

                                <input type="text" placeholder="100000" class="rounded-[5px] h-[40px] text-[#989898] bg-gray-800 lg:w-[150px] " name="max-price">
                            </div>
                        </div>

                        <!-- submit button -->
                        <button id="submit-form-button" type="button" onclick="event.preventDefault(); document.getElementById('submit-form').submit();" class="bg-[#ef5d60] py-2 px-4 rounded-[5px]">
                            <p class="text-base">Submit</p>
                        </button>
                    </div>
                </form>

                <!-- Table -->
                <livewire:admin.property-index :$minPrice :$maxPrice :$assetLocation :$assetTypeId/>

                <!-- Footer -->
                <footer class="flex items-center justify-center py-4 mt-auto lg:mr-[200px]">
                    <p>
                        Powered by <a href="https://github.com/KerimNezo" target="_blank" class="text-[#EF5D60]">Kerim Nezo</a>
                    </p>
                </footer>
            </div>
        </div>
    </div>
</x-admin-layout>
