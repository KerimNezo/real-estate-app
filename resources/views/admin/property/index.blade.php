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
                <!-- No Properties Found -->
                @if($properties->isEmpty())
                    <div class="flex-grow flex items-center justify-center px-[6%] mb-5">
                        <div class="text-center">
                            <img src="./photos/icons/no-result.svg" alt="No results" class="w-[100px] mx-auto">
                            <p class="pt-[40px]">It seems like there are no matching results for your search...</p>
                        </div>
                    </div>
                @else
                <!-- Properties Found -->
                    <div class="h-full py-12 text-xl text-center px-[6%]">
                        <div class="overflow-x-auto">
                            <table class="min-w-full overflow-hidden bg-gray-800 rounded-xl">
                                <thead class="bg-gray-800 border-gray-700">
                                    <tr id="table-header">
                                        <!-- Image -->
                                        <x-table.table-header title="Image" />
                                        <!-- Agent -->
                                        <x-table.table-header title="Agent" />
                                        <!-- Price-->
                                        <x-table.table-header title="Price" />
                                        <!-- City -->
                                        <x-table.table-header title="City" />
                                        <!-- Offer type -->
                                        <x-table.table-header title="Offer Type" />
                                        <!-- Property type -->
                                        <x-table.table-header title="Property Type" />
                                        <!-- Year built -->
                                        <x-table.table-header title="Year Built" />
                                        <!-- Status -->
                                        <x-table.table-header title="Status" />
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($properties as $property)
                                    <tr class="border-t border-gray-700">
                                        <!-- Image -->
                                        <td id="table-data">
                                            <div class="flex items-center justify-start">
                                                <p>
                                                    <img src="{{ $property->getFirstMediaUrl('property-photos') }}" alt="Property Image" class="w-[100px] h-[75px] object-cover rounded-lg">
                                                </p>
                                            </div>
                                        </td>
                                        <!-- Agent name -->
                                        <td id="table-data">
                                            <div class="flex items-center justify-start">
                                                <a href="/agent/{{ $property->user->id }}">
                                                    <p class="hover:text-white">
                                                        {{ $property->user->name }}
                                                    </p>
                                                </a>
                                            </div>
                                        </td>
                                        <!-- Property price -->
                                        <td id="table-data">
                                            <div class="flex items-center justify-start">
                                                <p>
                                                    {{ number_format($property->price, 0) }} $
                                                </p>
                                            </div>
                                        </td>
                                        <!-- City -->
                                        <td id="table-data">
                                            <div class="flex items-center justify-start">
                                                <p>
                                                    {{ $property->city }}
                                                </p>
                                            </div>
                                        </td>
                                        <!-- Property Offer -->
                                        <td id="table-data">
                                            @if (is_null($property->lease_duration))
                                                <div id="type" class="mb-auto mr-auto bg-red-600 rounded-[5px] w-[80px] h-7 text-sm font-bold flex items-center justify-center">
                                                    <div class="align-middle">FOR SALE</div>
                                                </div>
                                            @else
                                                <div id="type" class="mb-auto mr-auto bg-sky-600 rounded-[5px] w-[80px] h-7 text-sm font-bold flex items-center justify-center">
                                                    <div class="align-middle">FOR RENT</div>
                                                </div>
                                            @endif
                                        </td>
                                        <!-- Property Type-->
                                        <td id="table-data">
                                            @if ($property->type_id == 1)
                                                <div class="flex items-center justify-start">
                                                    <p>
                                                        Office
                                                    </p>
                                                </div>
                                            @elseif ($property->type_id == 2)
                                                <div class="flex items-center justify-start">
                                                    <p>
                                                        House
                                                    </p>
                                                </div>
                                            @elseif ($property->type_id == 3)
                                                <div class="flex items-center justify-start">
                                                    <p>
                                                        Appartement
                                                    </p>
                                                </div>
                                            @else
                                                Unknown
                                            @endif
                                        </td>
                                        <!-- Year Built -->
                                        <td id="table-data">
                                            <div class="flex items-center justify-start">
                                                <p>
                                                    {{ $property->year_built }}
                                                </p>
                                            </div>
                                        </td>
                                        <!-- Status -->
                                        <td id="table-data">
                                            <div class="flex items-center justify-start">
                                                <p>
                                                    TO DO
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="static flex items-center justify-between w-full py-2">
                            {{ $properties->links() }}
                        </div>
                    </div>
                @endif

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
