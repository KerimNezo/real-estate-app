<x-admin-layout>
    <x-slot:title>
        Dashboard
    </x-slot:title>

    <!-- Page content -->
    <div class="flex flex-col min-h-screen bg-gray-900">
        <!-- Admin topbar -->
        <div class="fixed top-0 left-0 z-10 w-full bg-gray-800">
            @include('components.topbar-admin')
        </div>

        <div class="flex w-full pt-[100px] flex-grow">
            @include('components.sidebar-agent')

            <!-- Main content -->
            <div id="main-content" class="w-full py-6 bg-gray-900">
                <!-- Admin dashboard page content -->
                <div class="flex flex-col items-center justify-center mx-auto bg-gray-900 rounded-lg w-[90%] gap-4">
                    <!-- Charts -->
                    <div class="flex flex-col w-full gap-8 lg:gap-4 lg:flex-row">
                        <!-- Property Type Pie Chart -->
                        <div class="flex flex-col w-full lg:w-1/2">
                            <livewire:admin.properties-chart />
                        </div>

                        <!-- Profit Line Chart -->
                        <div class="flex flex-col w-full lg:w-1/2">
                            <livewire:admin.profit-chart />
                        </div>
                    </div>

                    <div class="w-full pt-4 text-xl text-center">
                        <livewire:admin.agent-property-table :agent="Auth::user()" />
                    </div>
                </div>
            </div>
        </div>

        @include('admin.footer')
    </div>
</x-admin-layout>
