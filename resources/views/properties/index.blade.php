@php
    $order = 'Most recent';
@endphp

<x-property>
    <x-slot:title>
        All properties
    </x-slot>

    <main>
        <div class="pt-32 bg-white">
            <div id="content" class="flex justify-center items center bg-white w-[80%] h-full flex-grow mx-auto relative">
                <!-- Property query filter form -->
                <div id="filters" class="w-[40%] h-[500px] bg-stone-500">
                    <span class="">pongors</span>
                </div>

                <!-- Property query result -->
                <div id="properites-list" class="flex-col justify-center items-center w-[60%] h-full">
                    <!-- Header of query result section-->
                    <div class="flex justify-center items-center h-full py-3">
                        <p class="mr-auto text-black">We found {{$property_count}} properties you</p>

                        <div class="w-[25%] relative">
                            <button class="w-full !bg-[#ef5d60] h-[48px] rounded-[5px]" id="dropdown-button" type="button">Order By: {{$order}}</button>

                            <div id="dropdown" class="w-full bg-teal-800 h-[140px] px-5 py-4 gap-3 rounded-[5px] flex-col justify-start items-start" style="display: none; z-index: 90; position: absolute;">
                                <div>Most recent</div>
                                <div>Price: Low - High</div>
                                <div>Price: High - Low</div>
                            </div>
                        </div>
                    </div>

                    <!-- Content of query result section-->
                    <div class=" text-black bg-white h-full w-full py-6" id="featured-properties">
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

    <!-- Footer of our page, contains basic link, socials and contact info-->
    <x-property-page-footer />
</x-property>

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
