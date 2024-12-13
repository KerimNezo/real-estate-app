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
            @include('components.sidebar-admin')

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

                    <!-- Table display of most recent actions -->
                    <div class="w-full">
                        <div class="text-xl text-center">
                            <!-- Table Header-->
                            <div>
                                <p class="pb-2 pl-4 text-sm text-left">
                                    Actions table
                                </p>
                            </div>

                            <!-- Actions Table Content-->
                            <div class="overflow-x-auto">
                                <table class="min-w-full overflow-hidden bg-gray-800 rounded-xl">
                                    <!-- Action Tables Header-->
                                    <thead class="bg-gray-800 border-gray-700">
                                        <tr id="table-header" class="border-b border-gray-700">
                                            <!-- Id -->
                                            <x-table.table-header title="Id" />

                                            <!-- Agent -->
                                            <x-table.table-header title="Agent" />

                                            <!-- Action -->
                                            <x-table.table-header title="Action" />

                                            <!-- Property-->
                                            <x-table.table-header title="Property" />

                                            <!-- Created -->
                                            <x-table.table-header title="Created" />

                                            <!-- Options -->
                                            <x-table.table-header title="Options" />

                                            <!-- Refresh Table Button-->
                                            <th class="pr-2">
                                                <button class="p-1 ml-auto bg-gray-700 rounded-xl">
                                                    <x-ionicon-refresh-outline class="w-5" />
                                                </button>
                                            </th>
                                        </tr>
                                    </thead>

                                    <!-- Action Tables Content-->
                                    <tbody>
                                        {{-- @foreach ($this->actions as $action) --}}
                                        <tr class="border-t border-gray-700" wire:key="1">
                                            <!-- Action Id -->
                                            <td class="px-4 py-3">
                                                <div class="flex items-center justify-start">
                                                    <a href="{{ route('dashboard') }}">
                                                        <p class="text-sm text-left hover:text-white">
                                                            1
                                                        </p>
                                                    </a>
                                                </div>
                                            </td>

                                            <!-- Agent name -->
                                            <td class="px-4 py-3">
                                                <div class="flex items-center justify-start">
                                                    <a href="{{ route('dashboard') }}">
                                                        <p class="text-sm text-left hover:text-white">
                                                            Kerim Nezo
                                                        </p>
                                                    </a>
                                                </div>
                                            </td>

                                            <!-- Action -->
                                            <td class="px-4 py-3">
                                                <div class="flex items-center justify-start">
                                                    <p class="px-3 py-2 text-sm font-bold text-left bg-red-600 rounded-xl">
                                                        ADDED
                                                    </p>
                                                </div>
                                            </td>

                                            <!-- Property Name -->
                                            <td class="px-4 py-3">
                                                <div class="flex items-center sjustify-start">
                                                    <p class="text-sm text-left">
                                                        2 Bedroom House
                                                    </p>
                                                </div>
                                            </td>

                                            <!-- Time -->
                                            <td class="px-4 py-3">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-sm text-left">
                                                        13 minutes ago
                                                    </p>
                                                </div>
                                            </td>

                                            <!-- Options-->
                                            <td class="px-4 py-3">
                                                <div class="flex items-center justify-start gap-4">
                                                    <a href="{{ route('dashboard') }}" class="hover:text-red-400">
                                                        <x-carbon-view class="w-[20px]"/>
                                                    </a>

                                                    <a class="hover:text-red-400">
                                                        <x-heroicon-s-trash class="w-[20px]" />
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- @endforeach --}}
                                        <tr class="border-t border-gray-700">
                                            <td colspan="7">
                                                <div class="flex items-center justify-center w-full p-2">
                                                    <a href="{{ route('admin-properties') }}" class="mx-auto cursor-pointer">
                                                        <p class="text-sm font-bold cursor-pointer hover:text-gray-900">
                                                            See all Actions
                                                        </p>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.footer')
    </div>
</x-admin-layout>
