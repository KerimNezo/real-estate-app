@php
    $order = 'Most recent';
@endphp

<x-app-layout>
    <x-slot:title>
        All properties
    </x-slot>

    <main>
        <div class="pt-32 bg-white">
            <div id="property-index-content" class="justify-center bg-white h-full flex-grow mx-auto relative pb-24 pt-9">
                <!-- Property query filter form -->
                <div id="property-index-filters" class="h-[500px] flex flex-col justify-center items-start">
                    <!-- Filter clear & text-->
                    <div id="form-heading" class="flex justify-start items-center pt-3">
                        <p class="text-lg text-black w-[150px]">Find you home</p>

                        <!-- Filter button-->
                        <div class="ml-auto w-fit">
                            <button id="filter-button" class="!bg-[#ef5d60] h-[48px] rounded-[5px] text-base px-4" type="button">Clear filters</button>
                        </div>
                    </div>

                    <!-- Query form -->
                    <div id="query-form-all-properties" class="bg-[#5eb1f0] h-full rounded-[5px] flex justify-center items-center mt-5">
                        <table class="w-full pb-auto h-full">
                            <form action="/search" method="GET">
                                <!-- Property location input-->
                                <x-form-select-input heading="Property location" selectId="asset-location">
                                    <option value="" disabled selected>Select a location</option>
                                    @foreach ($cities as $city)
                                        <option value="{{$city}}">{{$city}}</option>
                                    @endforeach
                                </x-form-select-input>

                                <!-- Property type input-->
                                <x-form-select-input heading="Offer type" selectId="asset-offer-id">
                                    <option value="" disabled selected>Select an offer</option>
                                    <option value="0">Sale</option>
                                    <option value="1">Rent</option>
                                </x-form-select-input>

                                <!-- Property type input-->
                                <x-form-select-input heading="Property type" selectId="type-of-asset-id">
                                    <option value="" disabled selected>Choose property type</option>
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
                                                <input type="text" placeholder="1200" class="rounded-[5px] border-2 border-[#989898] border-solid w-[45%] h-[35px] text-black" name="min-price">

                                                <div class="w-[10%] flex ">
                                                    <span class="ml-auto mr-auto">to</span>
                                                </div>

                                                <input type="text" placeholder="100000" class="rounded-[5px] border-2 border-[#989898] border-solid w-[45%] h-[35px] text-black" name="max-price">
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
                        <p class="mr-auto text-black text-lg">We found {{$property_count}} properties you</p>

                        <div id="property-list-button" class="relative">
                            <button class="w-full !bg-[#ef5d60] h-[48px] rounded-[5px] px-2 text-base" id="dropdown-button" type="button">Order By: {{$order}}</button>

                            <div id="dropdown" class="w-full bg-teal-800 h-[140px] px-4  py-4 gap-3 rounded-[5px] flex-col justify-start items-start" style="display: none; z-index: 90; position: absolute;">
                                <div>Most recent</div>
                                <div>Price: Low - High</div>
                                <div>Price: High - Low</div>
                            </div>
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
    </main>
</x-app-layout>

<script>
    // Function that opens/closes dropdown div whenever the button is clicked
    document.getElementById('dropdown-button').addEventListener('click', function() {
        var dropdown = document.getElementById('dropdown');
        console.log('Hello');

        if (dropdown.style.display === 'none') {
            dropdown.style.display = 'flex';
        } else {
            dropdown.style.display = 'none';
        }
    });

    // Function that closes the dropdown div whenever part of the page is pressed
    document.addEventListener('click', function(event) {
        var dropdown = document.getElementById('dropdown');
        var button = document.getElementById('dropdown-button');

        // Check if the click is outside the dropdown or button
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });
</script>
