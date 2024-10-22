<div class="flex items-center justify-center w-full py-6 bg-gray-800 h-[100px] fixed">
    <div class="relative flex items-center justify-center w-full px-10">
        <div id="admin-topbar-logo" class="mr-auto">
            <a href="{{ route('home') }}">
                <img src={{ asset('photos/icons/logo1.svg')}} alt="alt" class="rounded-[5px]">
            </a>
        </div>

        <div id="admin-topbar-button" class="mr-[10%] flex justify-center items-center">
            <button type="button" id="menu" class="collapsible">
                <x-iconic-menu class="w-[35px]" />
            </button>
        </div>

        <div class="pr-4 ml-auto font-bold">
            <p>{{ Auth::user()->name }}</p>
        </div>

        <button id="dugme" class="w-12 pr-8 my-auto" type="button">
            <img src="{{ Auth::user()->getFirstMediaUrl('admin-pfp') }}" alt="Admin Photo" class="h-[50px] w-[50px] rounded-[5px]">
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


    <form id="goto-profile-form" action="{{ route('single-agent', $user = Auth::user())}}" method="GET" style="display: none;">
    </form>

    <!-- Logout form-->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf <!-- This token is necessary to prevent CSRF attacks -->
    </form>

    <!-- Display profile options button -->
    <script>
        document.getElementById('dugme').addEventListener('click', function() {
            var content = document.getElementById('desktop-admin-dropdown');
            if (content.style.display === 'none') {
                content.style.display = 'block';
                setTimeout(function() {
                    content.style.opacity = 1;
                }, 10);
            } else {
                content.style.opacity = 0;
                setTimeout(function() {
                    content.style.display = 'none';
                }, 300);
            }
        });

        // Hide the dropdown if clicking outside
        document.addEventListener('click', function(event) {
            var dropdown = document.getElementById('desktop-admin-dropdown');
            var button = document.getElementById('dugme');

            if (!dropdown.contains(event.target) && !button.contains(event.target)) {
                dropdown.style.opacity = 0;
                setTimeout(function() {
                    dropdown.style.display = 'none';
                }, 300);
            }
        });
    </script>
</div>
