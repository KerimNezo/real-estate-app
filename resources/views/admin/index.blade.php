<x-admin-layout>
    <x-slot:title>
        Admin Panel
    </x-slot:title>

    <!-- Page content -->
    <div class="pl-[200px] h-full bg-gray-900 flex flex-col justify-center items-center w-full">
        <!-- Admin topbar -->
        <div class="flex items-center justify-center w-full py-6 bg-gray-800">

            <div class="flex items-center justify-center px-10 ml-auto">
                <button class="w-5">
                    <x-heroicon-s-user class="h-8" />
                </button>
                <div class="pl-8 my-auto">
                    <p>{{ Auth::user()->name }}</p>
                </div>
            </div>

        </div>
        <div id="desktop-admin-dropdown" class="ml-auto w-[200px] pr-5">
            <!-- Logout button -->
            <div class="flex flex-col items-center justify-center w-full gap-5 px-6 py-4 bg-gray-700">
                <button type="button" onclick="event.preventDefault(); document.getElementById('goto-profile-form').submit();" class="flex items-center justify-center px-4 ml-auto">
                    <p class="navbar-text">
                        Profile
                    </p>
                </button>

                <button type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center justify-center px-4 ml-auto">
                    <p class="navbar-text">
                        Logout
                    </p>
                </button>
            </div>
        </div>

        <div class="h-[1200px] w-full flex justify-center items-center">
            <p class="mb-[60%]">welcome back, {{ Auth::user()->name }}</p>
        </div>

        <!--footer -->
        <div class="flex items-center justify-center mb-4">
            <p>
                Powered by <a href="https://github.com/KerimNezo" target="_blank" class="text-[#EF5D60]">Kerim Nezo</a>
            </p>
        </div>
    </div>

    <form id="goto-profile-form" action="{{ route('user.show', ['id' => Auth::user()->id])}}" method="GET" style="display: none;">
    </form>

    <!-- Logout form-->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf <!-- This token is necessary to prevent CSRF attacks -->
    </form>
</x-admin-layout>
