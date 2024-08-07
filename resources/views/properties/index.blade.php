<x-property>
    <x-slot:title>
        All properties
    </x-slot>

    <main>
        <div class="pt-32 bg-white">
            <div id="content" class="flex justify-center items center bg-white w-[80%] h-full flex-grow mx-auto">
                <!-- Property query filter form -->
                <div id="filters" class="w-[40%] h-[500px] bg-stone-500">
                    <span class="">pongors</span>
                </div>

                <!-- Property query result -->
                <div id="properites-list" class="flex-col justify-center items-center w-[60%] h-full">
                    <div class="flex justify-center items-center h-full py-3">
                        <p class="mr-auto text-black">We found {{$property_count}} properties you</p>

                        <button class="w-[20%] bg-[#ef5d60] h-12 rounded-[5px]" id="button">Order By</button>

                        <div></div>
                    </div>

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
    <footer class="py-3 text-center text-sm text-white bg-[#0047AB] mt-auto" id="contact-section">
        <div class="flex justify-center items-center">
            <div class="" id="left-footer">
                <div class="sm:w-[50%] w-[100%] h-[90%] flex flex-col justify-center items-left">
                    <a href="/">
                        <img src={{ ('photos/logo1.svg')}} alt="alt" class="py-6 rounded-[5px] mb-auto" id="footer-slika">
                    </a>

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

<script>
    document.getElementById('button').addEventListener('click', function() {
        var content = document.getElementById('mobile-guest-collapse-content');
        if (content.style.display === 'none' || content.classList.contains('show') === false) {
            content.classList.add('show');
            content.style.display = 'block';
            setTimeout(function() {
                content.style.opacity = 1;
            }, 10); // Small delay to ensure the transition works
        } else {
            content.style.opacity = 0;
            setTimeout(function() {
                content.style.display = 'none';
                content.classList.remove('show');
            }, 500); // Match this duration with the CSS transition duration
        }
    });
</script>
