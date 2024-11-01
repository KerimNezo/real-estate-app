<div>
    <!-- Property data -->
    <div id="#agent-properties">
        @if($this->properties->isEmpty())
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

        <div class="w-full overflow-x-auto">
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
                    @foreach ($this->properties as $property)
                    <tr class="border-t border-gray-700" wire:key="{{ $property->id }}">
                        <!-- Image -->
                        <td id="table-data">
                            <div class="flex items-center justify-start">
                                <p>
                                    <a href=" {{ route('admin-single-property', ['property' => $property, 'user' => $agent])}}">
                                        @if ($property->getMedia('property-photos')->isNotEmpty())
                                            <img src="{{ $property->getFirstMediaUrl('property-photos') }}" alt="Property Image" class="w-[100px] h-[75px] object-cover rounded-lg">
                                        @else
                                            <div class="flex items-center justify-center w-[100px]">
                                                <x-ionicon-image-sharp class="h-[75px] mx-auto"/>
                                            </div>
                                        @endif                                    </a>
                                </p>
                            </div>
                        </td>

                        <!-- Property price -->
                        <td id="table-data">
                            <div class="flex items-center justify-start">
                                <p>
                                    $ {{ number_format($property->price, 0) }}
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
                                <div id="type" class="mb-auto mr-auto bg-red-600 rounded-[5px] w-[90px] h-8 text-sm font-bold flex items-center justify-center">
                                    <div class="align-middle">FOR SALE</div>
                                </div>
                            @else
                                <div id="type" class="mb-auto mr-auto bg-sky-600 rounded-[5px] w-[90px] h-8 text-sm font-bold flex items-center justify-center">
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
                            @if ($property->status == 'Available')
                                    <div id="type" class="mb-auto mr-auto bg-green-600 rounded-[5px] w-[90px] h-8 text-sm font-bold flex items-center justify-center">
                                        <div class="align-middle">
                                            {{ $property->status }}
                                        </div>
                                    </div>
                                @else
                                    <div id="type" class="mb-auto mr-auto bg-red-600 rounded-[5px] w-[90px] h-8 text-sm font-bold flex items-center justify-center">
                                        <div class="align-middle">
                                            {{ $property->status }}
                                        </div>
                                    </div>
                                @endif
                        </td>

                        <!-- Row options -->
                        <td id="table-data">
                            <div class="flex items-center justify-start gap-4">
                                <a href="{{ route('admin-single-property', ['property' => $property, 'user' => $property->user]) }}" class="hover:text-red-400">
                                    <x-carbon-view class="w-[25px]"/>
                                </a>
                                <a href="{{ route('edit-property', $property) }}" class="hover:text-red-400">
                                    <x-feathericon-edit class="w-[25px] h-[25px]" />
                                </a>
                                <a class="hover:text-red-400" onclick="openConfirmationModal({{$property}}, '{{$property->getFirstMediaUrl('property-photos')}}')">
                                    <x-heroicon-s-trash class="w-[25px]" />
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="static flex items-center justify-between w-full py-2">
                {{ $this->properties->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
