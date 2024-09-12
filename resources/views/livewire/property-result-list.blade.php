<div class="flex-grow w-full">
    <!-- Property query result -->
    <div id="properites-list" class="flex flex-col items-center justify-center w-full h-full">
        <!-- Header of query result section-->
        <div id="properites-list-header" class="flex flex-col items-center justify-center w-full h-full pt-3">
            <p class="mr-auto text-lg text-black">We found {{$propertyCount}} properties you</p>

            <div id="property-list-button" class="relative">
                <select wire:model.defer="order" name="" id="dropdown-button" class="w-full !bg-[#ef5d60] h-[48px] rounded-[5px] px-2 text-base">
                    <option wire:click="sortProperties('recent')" value="recent">Most recent</option>
                    <option wire:click="sortProperties('lowestfirst')" value="lowestfirst">Price: Low - High ↓</option>
                    <option wire:click="sortProperties('highestfirst')" value="highestfirst">Price: High - Low ↑</option>
                </select>
            </div>
        </div>

        <!-- Content of query result section-->
        <div class="w-full h-full py-5 text-black bg-white " id="featured-properties">
            <!-- Grid display of property cards -->
            <div class="text-xl text-center">
                @if ($properties->isEmpty())
                    <div class="flex-col items-center justify-center mx-auto">
                        <div class="pt-[100px]">
                            <img src="./photos/icons/no-result.svg" alt="" class="w-[100px] mx-auto">
                        </div>

                        <div class="pt-[40px]">
                            <p>It seems like there are no matching results <br> for your search...</p>
                        </div>
                    </div>
                @else
                    <div class="grid w-full grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-2"> <!-- ovdje sad treba editovati kako se pozicioniraju -->
                        @foreach ($properties as $property )
                            <a href="{{ route('single-property', ['id' => $property->id]) }}">
                                <x-property-card :$property/>
                            </a>
                        @endforeach
                    </div>
                @endif

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
