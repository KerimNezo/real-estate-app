<x-admin-layout>
    <x-slot:title>
        Admin Panel
    </x-slot:title>

    <!-- Page content -->
    <div class="flex flex-col w-full h-screen bg-gray-900">
        <!-- Admin topbar -->
        <div class="fixed top-0 left-0 z-10 w-full bg-gray-800">
            @include('components.topbar-admin')
        </div>

        <div class="flex w-full pt-[100px]">
            @include('components.sidebar-admin')

            <!-- Main content-->
            <div class="ml-[200px] w-full pt-[100px] bg-gray-900">
                <div class="h-[800px] w-full flex justify-center items-center z-9">
                    <p class="mb-auto">welcome back to profile page, {{ Auth::user()->name }}</p>
                </div>

                <!--footer -->
                <div class="flex items-center justify-center mb-4">
                    <p>
                        Powered by <a href="https://github.com/KerimNezo" target="_blank" class="text-[#EF5D60]">Kerim Nezo</a>
                    </p>
                </div>
            </div>
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
</x-admin-layout>
