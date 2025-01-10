<div class="flex-grow w-full">
    <!-- Property query result -->
    <div id="properites-list" class="flex flex-col items-center justify-center w-full h-full">
        <!-- Header of query result section-->
        <div id="properites-list-header" class="flex flex-col items-center justify-center w-full h-full pt-3">
            <p class="mr-auto text-lg text-black">We found {{ count($this->properties) }} properties you</p>

            <div id="property-list-button" class="relative">
                <select wire:loading.attr="disabled" wire:model.live="filters.sort" id="dropdown-button" class="w-full !bg-[#ef5d60] h-[48px] rounded-[5px] px-2 text-base">
                    <option value="created_at">Most recent</option>
                    <option value="lowestfirst">Price: Low - High ↓</option>
                    <option value="highestfirst">Price: High - Low ↑</option>
                </select>
            </div>
        </div>

        <!-- Content of query result section-->
        <div class="w-full h-full py-5 text-black bg-white " id="featured-properties" >
            <!-- Grid display of property cards -->
            <div class="relative text-xl text-center">
                @if ($this->properties->isEmpty())
                    <div class="flex-col items-center justify-center mx-auto">
                        <div class="pt-[100px]">
                            <img src="./photos/icons/no-result.svg" alt="" class="w-[100px] mx-auto">
                        </div>
            
                        <div class="pt-[40px]">
                            <p>It seems like there are no matching results <br> for your search...</p>
                        </div>
                    </div>
                @else
                    <!-- Wrapper for grid and loading overlay -->
                    <!-- Property Grid -->
                    <div class="grid w-full grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-2">
                        @foreach ($this->properties as $property)
                            <!-- Loading Overlay -->
                            <div wire:key="{{ $property['id'] }}" class="relative">
                                <div wire:loading.delay class="absolute inset-0 z-10 flex items-center justify-center w-full bg-opacity-75">
                                    <div class="flex items-center justify-center w-full h-full">
                                    </div>
                                </div>

                                <a href="{{ route('single-property', ['id' => $property['id']]) }}" wire:loading.class="opacity-50">
                                    @if (count($property->getMedia('property-photos')) === 0)
                                        <x-property-card :h='300' :$property/>
                                    @else
                                        <x-property-card :h='300' :imageUrl='$property->getFirstMediaUrl("property-photos")' :$property/>
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="static flex items-center justify-between w-full py-2">
                        {{ $this->properties->links() }}
                    </div>
                @endif
            </div>
    </div>
</div>
