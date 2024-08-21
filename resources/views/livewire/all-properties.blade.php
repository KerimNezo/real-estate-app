<div>
    <div class="pt-32 bg-white">
        <div id="property-index-content" class="justify-center bg-white h-full flex-grow mx-auto relative pb-24 pt-9">
            <!-- Property query filter form -->
            <div id="property-index-filters" class="h-[500px] flex flex-col justify-center items-start">
                <!-- Filter clear & text-->
                <div id="form-heading" class="flex justify-start items-center pt-3">
                    <p class="text-lg text-black w-[150px]">Find your home</p>

                    <!-- Filter button-->
                    <div class="ml-auto w-fit">
                        <button wire:click="clearForm()" id="filter-button" class="!bg-[#ef5d60] h-[48px] rounded-[5px] text-base px-4" type="button">Clear filters</button>
                    </div>
                </div>

                <!-- Query form -->
                <div id="query-form-all-properties" class="bg-[#5eb1f0] h-full rounded-[5px] flex justify-center items-center mt-5">
                    <table class="w-full pb-auto h-full">
                        <form wire:submit="searchProperties">
                            <!-- Property location input-->
                            <x-form-select-input modelName="filters.location" heading="Property location" selectId="asset-location">
                                <option value="" selected>Select a location</option>
                                @foreach ($cities as $city)
                                    <option value="{{$city}}">{{$city}}</option>
                                @endforeach
                            </x-form-select-input>

                            <!-- Property type input-->
                            <x-form-select-input modelName="filters.offer_type" heading="Offer type" selectId="asset-offer-id">
                                <option value="" selected>Select an offer</option>
                                <option value="1">Sale</option>
                                <option value="2">Rent</option>
                            </x-form-select-input>

                            <!-- Property type input-->
                            <x-form-select-input modelName="filters.property_type" heading="Property type" selectId="type-of-asset-id">
                                <option value="" selected>Choose property type</option>
                                <option value="1">Office</option>
                                <option value="2">House</option>
                                <option value="3">Appartement</option>
                            </x-form-select-input>

                            <!-- Property price input-->
                            <tr class="w-full h-full mt-auto">
                                <td class="py-[10px] w-full align-bottom">
                                    <div class="flex-col items-center justify-center w-full">
                                        <div class="text-left mb-[5px] w-[80%] pl-[10%]">
                                            <span>
                                                Price
                                            </span>
                                        </div>

                                        <div class="flex flex-row justify-center items-center w-[90%] pl-[10%]">
                                            <input wire:model="filters.min_price" type="text" placeholder="1200" class="rounded-[5px] border-2 border-[#989898] border-solid w-[45%] h-[35px] text-black" name="min-price">

                                            <div class="w-[10%] flex ">
                                                <span class="ml-auto mr-auto">to</span>
                                            </div>

                                            <input wire:model="filters.max_price" type="text" placeholder="100000" class="rounded-[5px] border-2 border-[#989898] border-solid w-[45%] h-[35px] text-black" name="max-price">
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Confirm button -->
                            <tr>
                                <td class="px-[10%] py-[20px] pb-5 mb-auto w-auto">
                                    <div class="flex flex-col justify-end h-full">
                                        <button class="w-full rounded-[5px] h-16 bg-[#ef5d60] align-bottom">Submit</button>
                                    </div>
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>

            <!-- Property query result -->
            <div id="properites-list" class="flex-col justify-center items-center h-full">
                <!-- Header of query result section-->
                <div id="properites-list-header" class="flex flex-col justify-center items-center h-full pt-3">
                    <p class="mr-auto text-black text-lg">We found {{$propertyCount}} properties you</p>

                    <div id="property-list-button" class="relative">
                        <select wire:model="order" name="" id="dropdown-button" class="w-full !bg-[#ef5d60] h-[48px] rounded-[5px] px-2 text-base">
                            <option wire:click="sortProperties('recent')" value="recent">Most recent</option>
                            <option wire:click="sortProperties('lowestfirst')" value="lowestfirst">Price: Low - High ↓</option>
                            <option wire:click="sortProperties('highestfirst')" value="highestfirst">Price: High - Low ↑</option>
                        </select>
                    </div>
                </div>

                <!-- Content of query result section-->
                <div class=" text-black bg-white h-full w-full py-5" id="featured-properties">
                    <!-- Grid display of property cards -->
                    <div class="text-center text-xl">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8 w-full"> <!-- ovdje sad treba editovati kako se pozicioniraju -->
                            @foreach ($properties as $property )
                                <a href="{{ route('single-property', ['id' => $property->id]) }}">
                                    <x-property-card :$property/>
                                </a>
                            @endforeach
                        </div>

                        <!-- Ovdje treba negdje i paginaciju dodati -->
                        <!--
                            <div class="mt-8">
                                {/{ $properties->links() }/}
                            </div>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
