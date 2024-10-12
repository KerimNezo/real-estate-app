<x-admin-layout>
    <x-slot:title>
        All properties
    </x-slot:title>

    <!-- Page content -->
    <div class="flex flex-col min-h-screen bg-gray-900">
        <!-- Admin topbar -->
        <div class="fixed top-0 left-0 z-10 w-full bg-gray-800">
            @include('components.topbar-admin')
        </div>

        <div class="flex w-full pt-[100px] flex-grow">
            @include('components.sidebar-admin')

            <!-- Main content -->
            <div id="main-content" class="flex flex-col flex-grow w-full pt-10 bg-gray-900">
                <!-- SearchForm/Table -->
                <livewire:admin.property-index :$minPrice :$maxPrice :$assetLocation :$assetTypeId :$cities/>

                <!-- Footer -->
                <footer class="flex items-center justify-center py-4 mt-auto lg:mr-[200px]">
                    <p>
                        Powered by <a href="https://github.com/KerimNezo" target="_blank" class="text-[#EF5D60]">Kerim Nezo</a>
                    </p>
                </footer>
            </div>
        </div>
    </div>
</x-admin-layout>
