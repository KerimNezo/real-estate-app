<x-admin-layout>
    <x-slot:title>
        Update {{ $agent->name }}
    </x-slot:title>

    <!-- Page content -->
    <div id="page-content" class="flex flex-col min-h-screen bg-gray-900">
        <!-- Admin topbar -->
        <div class="fixed top-0 left-0 z-10 w-full bg-gray-800">
            @include('components.topbar-admin')
        </div>

        <div class="flex w-full pt-[100px] flex-grow">
            @include('components.sidebar-admin')

            <!-- Main content -->
            <div id="main-content" class="w-full py-6 bg-gray-900">
                <!-- Update Property Form -->
                <div class="flex flex-col items-center justify-center p-4 mx-auto bg-gray-800 rounded-lg shadow-lg w-[80%]">
                    <!-- Title -->
                    <h1 class="py-4 text-xl font-bold text-center">
                        Update Agent Information
                    </h1>

                    <div class="w-full h-full px-4">
                        <livewire:admin.edit-agent :$agent />
                    </div>
                </div>
            </div>
        </div>
        @include('admin.footer')
    </div>
</x-admin-layout>
