<div class="mr-auto">
    <!-- Property query filter form -->
    <div id="property-index-filters" class="h-[500px] flex flex-col justify-center items-start w-full">
        <!-- Filter clear & text-->
        <div id="form-heading" class="flex items-center justify-start w-full pt-3">
            <p class="text-lg text-black w-[150px]">Find your home</p>

            <!-- Filter button-->
            <div class="ml-auto w-fit">
                <button wire:click="clearForm" id="filter-button" class="!bg-[#ef5d60] h-[48px] rounded-[5px] text-base px-4 flex justify-center items-center gap-2" type="button">
                    <div wire:loading wire:target="clearForm" class="flex items-center justify-center">
                        <img src="{{ asset('photos/redSpinner.svg') }}" class="w-5 h-5"></img> <!-- SVG loading spinner -->
                    </div>

                    <p class="text-base">Clear filters</p>
                </button>
            </div>
        </div>

        <!-- Query form -->
        <div id="query-form-all-properties" class="bg-[#5eb1f0] h-full rounded-[5px] w-full flex justify-center items-center mt-5">
            <table class="w-full h-full pb-auto">
                <form wire:submit="submitForm">
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
                                    <input wire:model.defer="filters.min_price" type="text" placeholder="1200" class="rounded-[5px] border-2 border-[#989898] border-solid w-[45%] h-[35px] text-black" name="min-price">

                                    <div class="w-[10%] flex ">
                                        <span class="ml-auto mr-auto">to</span>
                                    </div>

                                    <input wire:model.defer="filters.max_price" type="text" placeholder="100000" class="rounded-[5px] border-2 border-[#989898] border-solid w-[45%] h-[35px] text-black" name="max-price">
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Confirm button -->
                    <tr>
                        <td class="px-[10%] py-[20px] pb-5 mb-auto w-auto">
                            <div class="flex flex-col justify-end h-full">
                                <button class="w-full rounded-[5px] h-16 bg-[#ef5d60] align-bottom flex items-center justify-center gap-3">
                                    <div wire:loading wire:target="submitForm" class="flex items-center justify-center">
                                        <img src="{{ asset('photos/redSpinner.svg') }}" class="w-5 h-5"></img> <!-- SVG loading spinner -->
                                    </div>

                                    <p class="text-base">Submit</p>
                                </button>
                            </div>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
    </div>
</div>
