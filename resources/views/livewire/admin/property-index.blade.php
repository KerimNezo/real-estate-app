<div>
    <!-- Query form on top of the property list -->
    <form wire:submit.prevent="submitForm">
        <div class="flex lg:flex-row flex-col sm:items-start lg:items-center justify-center w-full z-9 px-[6%]">

            <!-- new property button -->
            @if (Auth::user()->hasRole('admin'))
                <a href="{{ route('new-property') }}" class="bg-green-600 py-2 px-4 rounded-[5px] hover:bg-green-500 mb-2 lg:mb-0">
                    <p class="text-base text-center">Add new</p>
                </a>
            @else
                <a href="{{ route('agent-new-property') }}" class="bg-green-600 py-2 px-4 rounded-[5px] hover:bg-green-500 mb-2 lg:mb-0">
                    <p class="text-base text-center">Add new</p>
                </a>
            @endif

            <!-- Status (Sold - For Sale - Rent) -->
            <div class="flex-col items-center justify-center pb-2 lg:pr-3 lg:mr-0 lg:ml-auto sm:ml-0 sm:mr-auto lg:pb-0">
                <select id="" wire:model="assetOfferId" class="rounded-[5px] h-[40px] pl-[10px] pr-8 text-[#989898]-black bg-gray-800 w-full" name="asset-offer-id">
                    <option value="0" selected>Offer</option>
                    <option value="1">Sale</option>
                    <option value="2">Rent</option>
                </select>
            </div>

            <!-- cities -->
            <div class="flex-col items-center justify-center pb-2 lg:pr-3 lg:pb-0 sm:mr-auto lg:mr-0">
                <select id="" wire:model="assetLocation" class="rounded-[5px] h-[40px] pl-[10px] pr-8 text-[#989898]-black bg-gray-800 w-full" name="asset-location">
                    <option value="" selected>City</option>
                    @foreach ($cities as $city)
                        <option value="{{$city}}">{{$city}}</option>
                    @endforeach
                </select>
            </div>

            <!-- property type -->
            <div class="flex-col items-center justify-center pb-2 lg:pr-3 lg:pb-0 sm:mr-auto lg:mr-0">
                <select id="" wire:model="assetTypeId" class="w-full rounded-[5px] h-[40px] pl-[10px] pr-8 text-[#989898]-black bg-gray-800" name="type-of-asset-id">
                    <option value="0" selected>Choose property type</option>
                    <option value="1">Office</option>
                    <option value="2">House</option>
                    <option value="3">Appartement</option>
                </select>
            </div>

            <!-- price -->
            <div class="flex-col items-center justify-center pb-2 lg:pr-3 lg:pb-0 sm:mr-auto lg:mr-0">
                <div class="flex flex-col justify-center w-full gap-2 sm:items-start lg:items-center lg:flex-row">
                    <input type="text" placeholder="1200" wire:model="minPrice" class="rounded-[5px] h-[40px] text-[#989898] bg-gray-800 lg:w-[150px] " name="min-price">

                    <span>to</span>

                    <input type="text" placeholder="100000" wire:model="maxPrice" class="rounded-[5px] h-[40px] text-[#989898] bg-gray-800 lg:w-[150px] " name="max-price">
                </div>
            </div>

            <!-- submit button -->
            <button class="bg-[#ef5d60] py-2 px-4 rounded-[5px] hover:bg-red-400 flex items-center justify-center gap-2">
                <div wire:loading wire:target="submitForm" class="flex items-center justify-center">
                    <img src="{{ asset('photos/redSpinner.svg') }}" class="w-5 h-5"></img> <!-- SVG loading spinner -->
                </div>

                <p class="text-base">Submit</p>
            </button>
        </div>
    </form>

    @if($this->properties->isEmpty())
    <!-- Propreties Not Found -->
        <div class="flex-grow flex items-center justify-center px-[6%] py-24 mb-5">
            <div class="text-center">
                <img src="{{ asset('photos/icons/no-result.svg') }}" alt="No results" class="w-[100px] mx-auto">
                <p class="pt-[40px]">It seems like there are no matching results for your search...</p>
            </div>
        </div>
    @else
    <!-- Properties Found -->
        <div class="py-8 text-xl text-center px-[6%]">
            <div>
                <p class="pb-2 pl-4 text-sm text-left">
                    Properties table
                </p>
            </div>
            <div class="overflow-x-auto" wire:loading.class="opacity-30">
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
                        @foreach ($this->properties as $property)
                        <tr class="border-t border-gray-700" wire:key="{{ $property->id }}">
                            <!-- Image -->
                            <td id="table-data">
                                <div class="flex items-center justify-start" wire:loading.remove>
                                    @if(Auth::user()->hasRole('admin'))
                                        <a href=" {{ route('admin-single-property', ['property' => $property, 'user' => $property->user])}}">
                                            @if ($property->getMedia('property-photos')->isNotEmpty())
                                                <img src="{{ $property->getFirstMediaUrl('property-photos') }}" alt="Property Image" class="w-[100px] h-[75px] object-cover rounded-lg">
                                            @else
                                                <div class="flex items-center justify-center w-[100px]">
                                                    <x-ionicon-image-sharp class="h-[75px] mx-auto"/>
                                                </div>
                                            @endif
                                        </a>
                                    @else
                                        <a href=" {{ route('agent-single-property', ['property' => $property])}}">
                                            @if ($property->getMedia('property-photos')->isNotEmpty())
                                                <img src="{{ $property->getFirstMediaUrl('property-photos') }}" alt="Property Image" class="w-[100px] h-[75px] object-cover rounded-lg">
                                            @else
                                                <div class="flex items-center justify-center w-[100px]">
                                                    <x-ionicon-image-sharp class="h-[75px] mx-auto"/>
                                                </div>
                                            @endif
                                        </a>
                                    @endif
                                </div>

                                {{-- placeholder image that displays while component is loading --}}
                                <div wire:loading>
                                    <a>
                                        <div class="flex items-center justify-center w-[100px]">
                                            <x-ionicon-image-sharp class="h-[75px] mx-auto"/>
                                        </div>
                                    </a>
                                </div>
                            </td>

                            <!-- Agent name -->
                            <td id="table-data">
                                <div class="flex items-center justify-start" wire:loading.remove>
                                    @if (Auth::user()->hasRole('admin'))
                                        <a href="{{ route('single-agent', $user = $property->user) }}">
                                            <p class="text-left hover:text-white">
                                                {{ $property->user->name }}
                                            </p>
                                        </a>
                                    @else
                                        <p class="text-left">
                                            {{ $property->user->name }}
                                        </p>
                                    @endif
                                </div>

                                {{-- placeholder name that displays while component is loading --}}
                                <div wire:loading>
                                    <p class="text-left hover:text-white">
                                        Agent name
                                    </p>
                                </div>
                            </td>

                            <!-- Property price -->
                            <td id="table-data">
                                <div class="flex items-center justify-start">
                                    <p class="text-left">
                                        $ {{ number_format($property->price, 0) }}
                                    </p>
                                </div>
                            </td>

                            <!-- City -->
                            <td id="table-data">
                                <div class="flex items-center justify-start">
                                    <p class="text-left">
                                        {{ $property->city }}
                                    </p>
                                </div>
                            </td>

                            <!-- Property Offer -->
                            <td id="table-data">
                                @if ($property->lease_duration === 0 || is_null($property->lease_duration))
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
                                    <div id="type" class="mb-auto mr-auto bg-green-600 py-1 px-2 rounded-[5px] w-[90px] h-8 text-sm font-bold flex items-center justify-center">
                                        <div class="align-middle">
                                            {{ $property->status }}
                                        </div>
                                    </div>
                                @elseif ($property->status == 'Removed')
                                    <div id="type" class="mb-auto mr-auto bg-gray-600 py-1 px-2 rounded-[5px] w-[90px] h-8 text-sm font-bold flex items-center justify-center">
                                        <div class="align-middle">
                                            {{ $property->status }}
                                        </div>
                                    </div>
                                @elseif ($property->status == 'Unavailable')
                                    <div id="type" class="mb-auto mr-auto bg-blue-600 py-1 px-2 rounded-[5px] w-[90px] h-8 text-sm font-bold flex items-center justify-center">
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

                            <!-- Row options-->
                            <td id="table-data">
                                <div class="flex items-center justify-start gap-4" wire:loading.remove>
                                    @if (Auth::user()->hasRole('admin'))
                                        <a href="{{ route('admin-single-property', ['property' => $property, 'user' => $property->user]) }}" class="hover:text-red-400">
                                            <x-carbon-view class="w-[25px]"/>
                                        </a>
                                    @else
                                        <a href="{{ route('agent-single-property', ['property' => $property]) }}" class="hover:text-red-400">
                                            <x-carbon-view class="w-[25px]"/>
                                        </a>
                                    @endif

                                    @if ($property->status !== 'Removed')
                                        @if ($property->status !== 'Sold' && $property->status !== 'Rented')
                                            @if (Auth::user()->hasRole('admin'))
                                                <a href="{{ route('edit-property', $property) }}" class="hover:text-red-400">
                                                    <x-feathericon-edit class="w-[25px] h-[25px]" />
                                                </a>
                                            @elseif (Auth::user()->id === $property->user_id)
                                                <a href="{{ route('agent-edit-property', $property) }}" class="hover:text-red-400">
                                                    <x-feathericon-edit class="w-[25px] h-[25px]" />
                                                </a>
                                            @endif
                                        @endif

                                        @if (Auth::user()->hasRole('admin'))
                                            @if ($property->status === 'Unavailable' || $property->status === 'Sold' || $property->status === 'Rented')

                                            @else
                                                <a class="hover:text-red-400" onclick="openConfirmationModal({{$property}}, '{{$property->getFirstMediaUrl('property-photos')}}')">
                                                    <x-heroicon-s-trash class="w-[25px]" />
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                </div>

                                {{-- placeholder text that displays while component is loading --}}
                                <div wire:loading>
                                    <p>
                                        Property options
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
                {{ $this->properties->links() }}
            </div>
        </div>
    @endif
</div>
