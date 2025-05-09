<x-app-layout>
    <x-slot:title>
        Realestate App
    </x-slot>

    <!-- Hero section of the page -->
    <div class="py-32 text-center text-black bg-white h-fit bg-hero-image bg-cover bg-[center 900px]" id="property-query" style="background-image: url('photos/pozadina.webp')">
        <!-- Hero heading #1 -->
        <div class="text-lg pb-[20px] pt-[40px] sm:text-2xl sm:pb-[54px] sm:pt-[103px]" id="query-title">
            <h1 class="text-teal-900">WELCOME TO OUR PAGE</h1>
        </div>

        <!-- Hero heading #2 -->
        <div class="text-2xl pb-[60px] sm:text-5xl sm:pb-[160px]" id="query-sub-title">
            <h1 class="text-teal-900">One step closer to your dream home...</h1>
        </div>

        <!-- Form for property query -->
        <div id="query-form-div" class="flex justify-center w-full h-full">
            <x-property-query-form />
        </div>
    </div>

    <!-- Display of featured properties -->
    <main>
        <div class="w-full py-16 text-black bg-gray-300 h-fit" id="featured-properties">
            <!-- Title -->
            <x-title position="left" text="Featured Properties"/> <!-- Ovo ako je left, ide lijevo, ako nije left, ide u centar -->

            <!-- Grid display of property cards -->
            <div class="py-12 text-xl text-center">
                <div class="px-[10%] grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 w-full"> <!-- ovdje sad treba editovati kako se pozicioniraju -->
                    @foreach ($properties as $property)
                        <a href="{{ route('single-property', ['id' => $property->id]) }}">
                            @if (count($property->getMedia('property-photos')) === 0)
                                <x-property-card :h='300' :$property/>
                            @else
                                <x-property-card :h='300' :imageUrl='$property->getFirstMediaUrl("property-photos")' :$property/>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- All properties button -->
            <div class="text-xl text-center">
                <a href="all-properties">
                    <span class="text-teal-900">See all properties →</span>
                </a>
            </div>
        </div>
    </main>

    <!-- Type of properties we have to offer -->
    <div class="pt-16 text-sm text-center text-black bg-teal-900"  id="property-types">
        <!-- Title -->
        <h1 class="py-3 text-3xl text-center text-gray-300">Looking to buy or rent a property...</h1>
        <hr class="mx-auto w-[100px] h-1 border-[0px] bg-gray-300 rounded-[5px]" >

        <!-- Content -->
        <div class="flex items-center justify-center">
            <div class="py-16 w-full sm:w-[80%] ">
                <div class="flex flex-row items-center justify-center ">
                    <x-property-query-card logo="./photos/icons/property_types/House.svg" text="House" link="/search?type-of-asset-id=2" />
                    <hr class="h-[100px] w-[2px] border-[0px] bg-gray-300 mb-[30px]">
                    <x-property-query-card logo="./photos/icons/property_types/Appartement.svg" text="Appartement" link="/search?type-of-asset-id=3" />
                    <hr class="h-[100px] w-[2px] border-[0px] bg-gray-300 mb-[30px]">
                    <x-property-query-card logo="./photos/icons/property_types/Office.svg" text="Office" link="/search?type-of-asset-id=1" />
                </div>
            </div>
        </div>
    </div>

    <!-- About us section -->
    <div class="py-8 text-sm text-center text-black bg-gray-300"  id="about-section">
        <x-title position="center" text="About Us"></x-title>

        <div class="flex items-center justify-center">
            <div class="py-16 w-[80%] ">
                <div class="" id="about-us-section">
                    <div class="" id="about-us-photo">
                        <img src="./photos/estate.jpg" alt="photo" class="border-[5px] w-[100%] rounded-lg border-teal-800">
                    </div>

                    <div class="" id="about-us-text">
                        <span class="flex pb-5 pl-5 text-2xl items-left">
                            We are the best agency... <br>
                        </span>

                        <div class="pl-5">
                            <span class="block text-base text-left">
                                At our real estate agency, we're committed to turning your property dreams into reality. With a team of dedicated experts and a deep understanding of the market, we strive to provide personalized solutions that exceed your expectations. Whether you're buying, selling, or investing, trust us to guide you every step of the way with integrity and professionalism. Welcome to a world of seamless real estate experiences.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
