<x-admin-layout>
    <x-slot:title>
        Admin Panel
    </x-slot:title>

    <!-- Page content -->
    <div class="flex flex-col min-h-screen bg-gray-900">
        <!-- Admin topbar -->
        <div class="fixed top-0 left-0 z-10 w-full bg-gray-800">
            @include('components.topbar-admin')
        </div>

        <div class="flex w-full pt-[100px]">
            @include('components.sidebar-admin')

            <!-- Main content-->
            <div id="main-content" class="w-full pt-[100px] bg-gray-900">
                <div class="h-[600px] w-full flex justify-center items-center z-9">
                    <p class="">welcome back to show agents {{ $agent->name }} information page, {{ Auth::user()->name }}</p>
                    <p class="">phone number {{ $agent->phone_number }} </p>
                </div>
            </div>
        </div>

        @include('admin.footer')
    </div>
</x-admin-layout>
