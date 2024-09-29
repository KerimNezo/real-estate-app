<div class="flex-grow w-full">
    <!-- Property query result -->
    <div id="properites-list" class="flex flex-col items-center justify-center w-full h-full">
        <!-- Header of query result section-->
        <div id="properites-list-header" class="flex flex-col items-center justify-center w-full h-full pt-3">
            <p class="mr-auto text-lg text-black">We found {{ $properties->count() }} properties you</p>

            <div id="property-list-button" class="relative">
                <select wire:model.defer="order" name="" id="dropdown-button" class="w-full !bg-[#ef5d60] h-[48px] rounded-[5px] px-2 text-base">
                    <option wire:click="sortProperties('recent')">Most recent</option>
                    <option wire:click="sortProperties('lowestfirst')">Price: Low - High ↓</option>
                    <option wire:click="sortProperties('highestfirst')">Price: High - Low ↑</option>
                </select>
            </div>
        </div>

        <!--When I reorder properties, it loads all of their photos, it makes 2 queries, one that queries the "snapped data"
            other one that queries their photos from media table, i don't really know why does this happen or if it even should
            happen in the first place. Will need to look this up tommorow. All you need to do is keep on working. You're back
            form the vacation, time to work.


            29.09. dodatak, read this again
            https://livewire.laravel.com/docs/properties#eloquent-constraints-arent-preserved-between-requests
            vidjet ćeš da ćeš morati eventualno preraditi logiku da pređeš na computed propertije. Jer kao što vidiš
            nakon što livewire hydrira json snapshot u php na request, gubi se select constraint.

            Ali opet ne znam kako će i hoće li se ovo moći uraditi, jer forma određuje constrint i neće uvijek biti isti
            tako da se mora nekako skontati taj sistem da forma šalje sve isto, i vamo da se provjerava za null i constrainta
            samo ono što nije null. Da bude computed, ali se onda mijenjaju sve rute koje si do sada radio.
            Tako da ima posla.
            Good luck, Kerim -->

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
                            <div wire:key="{{ $property->id }}">
                                <a href="{{ route('single-property', ['id' => $property->id]) }}">
                                    <x-property-card :$property/>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Ovdje treba negdje i paginaciju dodati -->

                {{-- <div class="mt-8">
                    {{ $properties->links() }}
                </div> --}}
            </div>
        </div>
    </div>
</div>
