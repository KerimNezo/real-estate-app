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
            <div id="query-form" class="bg-[#5eb1f0] w-[80%] h-[120px] rounded-[5px]">
                <table class="w-full mb-auto h-full">
                    <tr class="w-full h-full mt-auto">
                        <form action="/search" method="GET">
                            <td class="pb-[20px] pl-[30px] w-[220px] align-bottom">
                                <div class="flex flex-col justify-end h-full">
                                    <span class="mb-[5px] w-[220px] text-left">Property type</span>

                                    <select id="" class="rounded-[5px] border-2 border-[#989898] border-solid h-[35px] w-[220px] pl-[10px]" name="type-of-asset-id">
                                        <option value="0">Choose property type</option>
                                        <option value="1">Office</option>
                                        <option value="2">House</option>
                                        <option value="3">Appartement</option>
                                    </select>
                                </div>
                            </td>

                            <td class="pl-[26px] pb-5 w-[200px] align-bottom">
                                <div class="flex justify-end flex-col h-full">
                                    <span class="text-left mb-[5px] w-[200px]">Price</span>

                                    <input type="text" placeholder="1200" class="rounded-[5px] border-2 border-[#989898] border-solid h-[35px] w-[200px]" name="min-price">
                                </div>
                            </td>

                            <td class="mt-auto pb-[26px] h-[51px] w-[26px]">
                                <div class="flex flex-col justify-end h-full">
                                    <span>
                                        to
                                    </span>
                                </div>
                            </td>

                            <td class="pb-5 mt-auto mr-auto w-[200px]">
                                <div class="flex flex-col justify-end h-full">
                                    <input type="text" placeholder="100000" class="rounded-[5px] border-2 border-[#989898] border-solid h-[35px] w-[200px]" name="max-price">
                                </div>
                            </td>

                            <td class="pr-[30px] pb-5 mb-auto w-auto">
                                <div class="flex flex-col justify-end h-full">
                                    <button class="w-[220px] rounded-[5px] h-16 bg-[#ef5d60] align-bottom ml-auto">Submit</button>
                                </div>
                            </td>
                        </form>
                    </tr>
                </table>
            </div>
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
                    <x-property-query-card logo="./photos/icons/Hotel.svg" text="Appartement" link="/search?type-of-asset-id=3" />
                    <hr class="h-[100px] w-[2px] border-[0px] bg-black mb-[30px]">
                    <x-property-query-card logo="./photos/icons/floor.svg" text="Office" link="/search?type-of-asset-id=1" />
                </div>
            </div>
        </div>
    </div>

    <!-- Our team section, contains some agents and their data-->
    <div class="pt-16 text-center text-sm text-black bg-white"  id="team-section">
        <x-title text="Or you want to sell an existing one?" position="center"/>

        <div class="flex justify-center items-center">
            <div class="py-16 w-[80%] ">
                <div class="flex flex-row justify-center items-center gap-10">
                    <span>Needs to be done</span>
                </div>
            </div>
        </div>
    </div>

    <!-- About us section -->
    <div class="pt-16 pb-16 text-center text-sm text-black bg-white"  id="about-section">
        <x-title position="center" text="About Us"></x-title>

        <div class="flex justify-center items-center">
            <div class="py-16 w-[80%] ">
                <div class="flex flex-row justify-between items-center w-full ">
                    <div class="w-[50%] flex flex-row justify-start items-center">
                        <img src="./photos/estate.jpg" alt="photo" class="border-[5px] w-[600px] rounded-lg border-[#6369D1]">
                    </div>

                    <div class="w-[50%] items-start pb-[130px]">
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
            <div class="pb-8 w-[80%] flex justify-between items-center h-[350px]">
                <div class="w-[50%] h-[90%] flex flex-col justify-center items-left">
                    <img src={{ ('photos/logo1.svg')}} alt="alt" class="py-6 rounded-[5px] w-[330px] mb-auto">

                    <div class="pl-5 mb-auto">
                        <span class="block text-left text-base">
                            At our real estate agency, we're committed to turning your property dreams into reality. With a team of dedicated experts and a deep understanding of the market, we strive to provide personalized solutions that exceed your expectations.
                        </span>
                    </div>

                    <div class="pl-5 pt-4">
                        <span class="block text-left text-base">
                            Powered by <a href="https://github.com/KerimNezo" target="_blank" class="text-[#EF5D60]">Kerim Nezo</a>
                        </span>
                    </div>
                </div>
                <div class="flex flex-col justify-center items-center w-[50%] h-[90%]">
                    <div class="w-full h-full flex justify-center items-center">
                        <div class="w-[50%] pt-6 mb-auto flex flex-col justify-between items-start pl-[150px] gap-2">
                            <span class="text-lg font-bold pb-2">Links</span>

                            <a rel="noopener" href="all-properties" >
                                <span class="text-base">All Properties</span>
                            </a>

                            <a rel="noopener" href="/#team-section" >
                                <span class="text-base">Our Team</span>
                            </a>

                            <a rel="noopener" href="/#about-section" >
                                <span class="text-base">About Us</span>
                            </a>
                        </div>
                        <div class="w-[50%] pt-6 mb-auto flex flex-col justify-between items-start pl-[100px] gap-2">
                            <span class="text-lg font-bold pb-2">Contacts</span>
                            <span class="text-base">+387 61 034 357</span>
                            <span class="text-base">kerim.nezo@gmail.com</span>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="w-full flex justify-end items-center gap-[70px] pl-auto">
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
