<x-admin-layout>
    <x-slot:title>
        Profile
    </x-slot:title>

    <!-- Page content -->
    <div class="flex flex-col items-center justify-center w-full h-full bg-gray-900">
        <!-- Admin topbar -->
        @include('components.topbar-admin')

        <div class="h-[800px] w-full flex justify-center items-center z-9 pt-[100px]">
            <p class="mb-auto">welcome back to profile page, {{ Auth::user()->name }}</p>
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

    <script>
        document.getElementById('dugme').addEventListener('click', function() {
            var content = document.getElementById('desktop-admin-dropdown');
            if (content.style.display === 'none') {
                content.style.display = 'block';
                setTimeout(function() {
                    content.style.opacity = 1;
                }, 10); // Small delay to ensure the transition works
            } else {
                content.style.opacity = 0;
                setTimeout(function() {
                    content.style.display = 'none';
                }, 300); // Match this duration with the CSS transition duration
            }
        });

        // Hide the dropdown if clicking outside
        document.addEventListener('click', function(event) {
            var dropdown = document.getElementById('desktop-admin-dropdown');
            var button = document.getElementById('dugme');

            // Check if the click is outside the dropdown and the button
            if (!dropdown.contains(event.target) && !button.contains(event.target)) {
                dropdown.style.opacity = 0;
                setTimeout(function() {
                    dropdown.style.display = 'none';
                }, 300); // Match the duration with the opacity transition
            }
        });
    </script>
</x-admin-layout>
