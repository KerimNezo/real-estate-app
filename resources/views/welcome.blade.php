<x-property>
    <x-slot:title>
        Realestate
    </x-slot>

    <!-- Hero section of the page -->
    <div class="py-32 text-center text-black bg-white h-fit bg-hero-image bg-cover bg-[center 900px]" id="property-query" style="background-image: url('photos/pozadina.jpg')">
        <!-- Hero heading #1 -->
        <div class="text-lg pb-[20px] pt-[40px] sm:text-2xl sm:pb-[54px] sm:pt-[103px]" id="query-title">
            <h1 class="text-color">WELCOME TO OUR PAGE</h1>
        </div>

        <!-- Hero heading #2 -->
        <div class="text-2xl pb-[60px] sm:text-5xl sm:pb-[160px]" id="query-sub-title">
            <h1 class="text-color">One step closer to your dream home...</h1>
        </div>

        <!-- Form for property query -->
        <div id="query-form-div" class="w-full flex justify-center h-full">
            <x-property-query-form />
        </div>
    </div>

    <!-- Display of featured properties -->
    <main>
        <div class="py-16 text-black bg-white h-fit w-full" id="featured-properties">
            <!-- Title -->
            <x-title position="left" text="Featured Properties"/> <!-- Ovo ako je left, ide lijevo, ako nije left, ide u centar -->

            <!-- Grid display of property cards -->
            <div class="text-center text-xl py-12">
                <div class="px-[10%] grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 w-full"> <!-- ovdje sad treba editovati kako se pozicioniraju -->
                    @foreach ($properties as $property )
                        <a href="{{ route('single-property', ['id' => $property->id]) }}">
                            <x-property-card :$property/>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- All properties button -->
            <div class="text-center text-xl">
                <a href="/all-properties">
                    <span>See all properties →</span>
                </a>
            </div>
        </div>
    </main>

    <!-- Type of properties we have to offer -->
    <div class="pt-16 text-center text-sm text-black bg-[#5eb1f0]"  id="property-types">
        <!-- Title -->
        <x-title text="Looking to buy or rent a property..." position="center"/>

        <!-- Content -->
        <div class="flex justify-center items-center">
            <div class="py-16 w-full sm:w-[80%] ">
                <div class="flex flex-row justify-center items-center ">
                    <x-property-query-card logo="./photos/icons/House.svg" text="House" link="/search?type-of-asset-id=2" />
                    <hr class="h-[100px] w-[2px] border-[0px] bg-black mb-[30px]">
                    <x-property-query-card logo="./photos/icons/Appartement.svg" text="Appartement" link="/search?type-of-asset-id=3" />
                    <hr class="h-[100px] w-[2px] border-[0px] bg-black mb-[30px]">
                    <x-property-query-card logo="./photos/icons/Office.svg" text="Office" link="/search?type-of-asset-id=1" />
                </div>
            </div>
        </div>
    </div>

    <!-- About us section -->
    <div class="py-8 text-center text-sm text-black bg-white"  id="about-section">
        <x-title position="center" text="About Us"></x-title>

        <div class="flex justify-center items-center">
            <div class="py-16 w-[80%] ">
                <div class="" id="about-us-section">
                    <div class="" id="about-us-photo">
                        <img src="./photos/estate.jpg" alt="photo" class="border-[5px] w-[600px] rounded-lg border-[#6369D1]">
                    </div>

                    <div class="" id="about-us-text">
                        <span class="pl-5 pb-5 flex items-left text-2xl">
                            We are the best agency... <br>
                        </span>

                        <div class="pl-5">
                            <span class="block text-left text-base">
                                At our real estate agency, we're committed to turning your property dreams into reality. With a team of dedicated experts and a deep understanding of the market, we strive to provide personalized solutions that exceed your expectations. Whether you're buying, selling, or investing, trust us to guide you every step of the way with integrity and professionalism. Welcome to a world of seamless real estate experiences.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer of our page, contains basic link, socials and contact info-->
    <footer class="py-3 text-center text-sm text-white bg-[#0047AB]" id="contact-section">
        <div class="flex justify-center items-center">
            <div class="" id="left-footer">
                <div class="sm:w-[50%] w-[100%] h-[90%] flex flex-col justify-center items-left">
                    <img src={{ ('photos/logo1.svg')}} alt="alt" class="py-6 rounded-[5px] w-[330px] mb-auto">

                    <div class="pl-5 mb-auto py-6">
                        <span class="block text-left text-sm sm:text-base">
                            At our real estate agency, we're committed to turning your property dreams into reality. With a team of dedicated experts and a deep understanding of the market, we strive to provide personalized solutions that exceed your expectations.
                        </span>
                    </div>

                    <div class="pl-5 pt-4">
                        <span class="block text-left text-base">
                            Powered by <a href="https://github.com/KerimNezo" target="_blank" class="text-[#EF5D60]">Kerim Nezo</a>
                        </span>
                    </div>
                </div>
                <div class="flex flex-col justify-center items-center sm:w-[50%] w-[100%] h-[100%]">
                    <div class="w-full h-full flex justify-center items-center">
                        <div class="w-full sm:w-[50%] pt-6 mb-auto flex flex-col justify-start items-start sm:pl-[150px] pl-[20px] gap-2">
                            <span class="text-lg font-bold pb-2">Links</span>

                            <a rel="noopener" href="all-properties" >
                                <span class="text-base">All Properties</span>
                            </a>

                            <a rel="noopener" href="/#property-types" >
                                <span class="text-base">Our offer</span>
                            </a>

                            <a rel="noopener" href="/#about-section" >
                                <span class="text-base">About Us</span>
                            </a>
                        </div>
                        <div class="w-[50%] pt-6 mb-auto flex flex-col justify-between items-start gap-2">
                            <span class="text-lg font-bold pb-2">Contacts</span>
                            <span class="text-base font-extrabold">+387 61 034 357</span>
                            <span class="text-base">kerim.nezo@gmail.com</span>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="" id="footer-icons">
                            <a href="https://github.com/KerimNezo" target="_blank">
                                <img src="{{ ('photos/icons/socials/github-icon.svg')}}" alt="gh" class="w-6">
                            </a>

                            <a href="https://x.com/neyolino" target="_blank">
                                <img src="{{ ('photos/icons/socials/x-icon.svg')}}" alt="x" class="w-6">
                            </a>

                            <a href="https://www.instagram.com/knezo_01/" target="_blank">
                                <img src="{{ ('photos/icons/socials/instagram-icon.svg')}}" alt="ig" class="w-6">
                            </a>

                            <a href="https://www.linkedin.com/in/kerim-nezo/" target="_blank">
                                <img src="{{ ('photos/icons/socials/linkedin-icon.svg')}}" alt="in" class="w-6">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</x-property>
