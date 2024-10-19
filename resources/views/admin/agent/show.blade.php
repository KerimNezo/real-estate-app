<x-admin-layout>
    <x-slot:title>
        Agent: {{ $agent->name }}
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
                    <!-- table to display property agent data -->
                    <div class="py-8 text-xl text-center px-[6%] w-full">
                        <div class="w-full overflow-x-auto">
                            <!-- Agent data -->
                            <div class="pb-6">
                                <div>
                                    <p class="pb-2 text-sm text-left">
                                        Agent information
                                    </p>
                                </div>
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

                                    <!-- Table data -->
                                    <tbody class="w-full">
                                        <!-- user data -->
                                        <tr class="w-full border-t border-gray-700">
                                            <!-- Id -->
                                            <td class="px-4 py-4 text-base leading-6">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-left w-36">
                                                        Avatar
                                                    </p>
                                                </div>
                                            </td>

                                            <!-- Name -->
                                            <td class="w-full px-4 py-4 text-base leading-6">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-left">
                                                        <img src="{{ $agent->getFirstMediaUrl('agent-pfps') }}" alt="" class="rounded-[5px] h-[100px] w-[100px]">
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>

                                        @foreach ($agentData as $key=>$value)
                                            <tr class="w-full border-t border-gray-700">
                                                <!-- Id -->
                                                <td class="px-4 py-4 text-base leading-6">
                                                    <div class="flex items-center justify-start">
                                                        <p class="text-left w-36">
                                                            {{ ucwords(str_replace('_', ' ', $key)) }}
                                                        </p>
                                                    </div>
                                                </td>

                                                <!-- Name -->
                                                <td class="w-full px-4 py-4 text-base leading-6">
                                                    <div class="flex items-center justify-start">
                                                        <p class="text-left">
                                                            {{ $value }}
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                        <!-- PROVJERI DA LI TI KAD PASSAS OVDJE USERA KUPI I NJEGOVE PROPERTYE COKI ARAZ RIJEŠTI TO SVE DANAS POŠAMARAJ -->
                                    </tbody>
                                </table>
                            </div>

                            <!-- Property data -->
                            <div id="#agent-properties">
                                @if($propertyData->isEmpty())
                                <!-- Propreties Not Found -->
                                    <div class="flex-grow flex items-center justify-center px-[6%] py-4 mb-5">
                                        <div class="text-center">
                                            <img src="{{ asset('photos/icons/no-result.svg') }}" alt="No results" class="w-[100px] mx-auto">
                                            <p class="pt-[40px]">It seems like this agent has no properties under their name....</p>
                                        </div>
                                    </div>
                                @else
                                <!-- Agent Properties -->
                                    <div>
                                        <p class="pb-2 text-sm text-left">
                                            Agent's properties
                                        </p>
                                    </div>
                                    <table class="min-w-full overflow-hidden bg-gray-800 rounded-xl">
                                        <thead class="bg-gray-800 border-gray-700">
                                            <tr id="table-header">
                                                <!-- Image -->
                                                <x-table.table-header title="Image" />
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
                                            @foreach ($propertyData as $property)
                                            <tr class="border-t border-gray-700" wire:key="{{ $property->id }}">
                                                <!-- Image -->
                                                <td id="table-data">
                                                    <div class="flex items-center justify-start">
                                                        <p>
                                                            <a href=" {{ route('admin-single-property', ['property' => $property, 'user' => $agent])}}">
                                                                <img src="{{ $property->getFirstMediaUrl('property-photos') }}" alt="Property Image" class="w-[100px] h-[75px] object-cover rounded-lg">
                                                            </a>
                                                        </p>
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
                                                    @if ($property->status == 'Sold')
                                                        <div id="type" class="mb-auto mr-auto bg-red-600 rounded-[5px] w-[80px] h-7 text-sm font-bold flex items-center justify-center">
                                                            <div class="align-middle">
                                                                {{ $property->status }}
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div id="type" class="mb-auto mr-auto bg-green-600 rounded-[5px] w-[80px] h-7 text-sm font-bold flex items-center justify-center">
                                                            <div class="align-middle">
                                                                {{ $property->status }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- <!-- Pagination -->
                                    <div class="static flex items-center justify-between w-full py-2">
                                        {{ $properties->links() }}
                                    </div> --}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.footer')
    </div>
</x-admin-layout>
