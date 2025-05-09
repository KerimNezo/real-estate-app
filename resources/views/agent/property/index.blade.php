<x-admin-layout>
    <x-slot:title>
        All properties
    </x-slot:title>

    <!-- Page content -->
    <div id="page-content" class="flex flex-col min-h-screen bg-gray-900">
        <!-- Admin topbar -->
        <div class="fixed top-0 left-0 z-10 w-full bg-gray-800">
            @include('components.topbar-admin')
        </div>

        <div class="flex w-full pt-[100px] flex-grow">
            @include('components.sidebar-agent')

            <!-- Main content -->
            <div id="main-content" class="flex flex-col flex-grow w-full pt-6 bg-gray-900">
                @include('components.admin-session-messages')

                <!-- SearchForm/Table -->
                <livewire:admin.property-index :$minPrice :$maxPrice :$assetLocation :$assetTypeId :$cities/>
            </div>
        </div>

        @include('admin.footer')
    </div>
</x-admin-layout>
