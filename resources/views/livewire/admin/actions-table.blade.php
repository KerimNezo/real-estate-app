<div>
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
                            <button wire:click="refreshActions()" class="p-1 ml-auto bg-gray-700 rounded-xl">
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
                                <a href="{{ route('dashboard') }}">
                                    <p class="text-sm text-left hover:text-white">
                                        2 Bedroom House
                                    </p>
                                </a>
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
                                <a href="" class="mx-auto cursor-pointer">
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
