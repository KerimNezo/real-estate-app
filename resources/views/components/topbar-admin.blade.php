<div class="flex items-center justify-center w-full py-6 bg-gray-800 h-[100px] fixed">
    <div class="relative flex items-center justify-center w-full px-10">
        <div id="admin-topbar-logo" class="mr-auto">
            <a href="/">
                <img src={{ asset('photos/icons/logo1.svg')}} alt="alt" class="rounded-[5px]">
            </a>
        </div>

        <div id="admin-topbar-button" class="mr-[10%] flex justify-center items-center">
            <button type="button" id="button" class="collapsible">
                <x-iconic-menu class="w-[35px]" />
            </button>
        </div>

        <div class="ml-auto font-bold">
            <p>{{ Auth::user()->name }}</p>
        </div>

        <button id="dugme" class="w-5 pl-12 pr-8 smy-auto" type="button">
            <x-heroicon-s-user class="h-8" />
        </button>

        <!-- dropdown which waits for a click on the user icon -->
        <div id="desktop-admin-dropdown" class="mr-9 absolute right-0 top-[100%] mt-2 w-[200px] overflow-hidden bg-gray-700 rounded-lg shadow-lg transition-opacity duration-300"style="display: none; opacity: 0;">
            <!-- Logout button -->
            <div class="flex flex-col items-center justify-center w-full gap-5 px-6 py-4">
                <button type="button" onclick="event.preventDefault(); document.getElementById('goto-profile-form').submit();" class="flex items-center justify-center px-4 ml-auto">
                    <p class="text-base">
                        Profile
                    </p>
                </button>

                <button type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center justify-center px-4 ml-auto">
                    <p class="text-base">
                        Logout
                    </p>
                </button>
            </div>
        </div>
    </div>
</div>
