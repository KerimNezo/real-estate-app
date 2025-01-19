<footer class="py-3 mt-auto text-sm text-center text-white bg-neutral-800" id="contact-section">
    <div class="flex items-center justify-center">
        <div class="" id="left-footer">
            <div class="sm:w-[50%] w-[100%] h-[90%] flex flex-col justify-center items-left">
                <a href="/">
                    <img src={{ asset('photos/icons/logo1.svg')}} alt="alt" class="py-6 rounded-[5px] mb-auto" id="footer-slika">
                </a>

                <div class="py-6 mb-auto">
                    <span class="block text-sm text-left sm:text-base">
                        At our real estate agency, we're committed to turning your property dreams into reality. With a team of dedicated experts and a deep understanding of the market, we strive to provide personalized solutions that exceed your expectations.
                    </span>
                </div>

                <div class="pt-4">
                    <span class="block text-base text-left">
                        Powered by <a href="https://github.com/KerimNezo" target="_blank" class="text-[#EF5D60]">Kerim Nezo</a>
                    </span>
                </div>
            </div>
            <div class="flex flex-col justify-center items-center sm:w-[50%] w-[100%] h-[100%]">
                <div class="flex items-center justify-center w-full h-full">
                    <div class="w-full sm:w-[50%] pt-6 mb-auto flex flex-col justify-start items-start sm:pl-[150px]  gap-2">
                        <span class="pb-2 text-lg font-bold">Links</span>

                        <a rel="noopener" href="{{ route('all-properties') }}" >
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
                        <span class="pb-2 text-lg font-bold">Contacts</span>
                        <span class="text-base font-extrabold">+387 61 034 357</span>
                        <span class="text-base">kerim.nezo@gmail.com</span>
                    </div>
                </div>
                <div class="w-full">
                    <div class="" id="footer-icons">
                        <a href="https://github.com/KerimNezo" target="_blank">
                            <img src="{{ asset('photos/icons/socials/github-icon.svg')}}" alt="gh" class="w-6">
                        </a>

                        <a href="https://x.com/neyolino" target="_blank">
                            <img src="{{ asset('photos/icons/socials/x-icon.svg')}}" alt="x" class="w-6">
                        </a>

                        <a href="https://www.instagram.com/knezo_01/" target="_blank">
                            <img src="{{ asset('photos/icons/socials/instagram-icon.svg')}}" alt="ig" class="w-6">
                        </a>

                        <a href="https://www.linkedin.com/in/kerim-nezo/" target="_blank">
                            <img src="{{ asset('photos/icons/socials/linkedin-icon.svg')}}" alt="in" class="w-6">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
