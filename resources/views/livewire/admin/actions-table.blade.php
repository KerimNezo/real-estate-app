<div>
    <div class="text-xl text-center">
        <!-- Table Header-->
        <div>
            <p class="pb-2 pl-4 text-sm text-left">
                Actions table
            </p>
        </div>

        <!-- Actions Table Content-->
        <div wire:loading.class="opacity-30">

            <div class="overflow-x-auto" >
                <table class="min-w-full overflow-hidden bg-gray-800 rounded-t-xl">
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
                                <button wire:loading.attr="disabled" wire:click="refreshActions()" class="p-1 ml-auto bg-gray-700 rounded-xl">
                                    <x-ionicon-refresh-outline class="w-5" />
                                </button>
                            </th>
                        </tr>
                    </thead>

                    <!-- Action Tables Content-->
                    <tbody>
                        @foreach ($this->actions as $action)
                            <tr class="border-t border-gray-700" wire:key="1">
                                <!-- Action Id -->
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-start" wire:loading.remove>
                                        <a href="{{ route('dashboard') }}">
                                            <p class="text-sm text-left hover:text-white">
                                                {{ $action->id }}
                                            </p>
                                        </a>
                                    </div>
                                </td>

                                <!-- Agent name -->
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-start" wire:loading.remove>
                                        <a href="{{ route('single-agent', ['user' => $action->user])}}">
                                            <p class="text-sm text-left hover:text-white">
                                                {{ $action->user->name }}
                                            </p>
                                        </a>
                                    </div>
                                </td>

                                <!-- Action -->
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-start">
                                        <x-action-name :name="$action->name" />
                                    </div>
                                </td>

                                <!-- Property Name -->
                                <td class="px-4 py-3">
                                    <div class="flex items-center sjustify-start">
                                        <a href="{{ route('admin-single-property', [ 'user' => $action->property->user_id, 'property' => $action->property])}}">
                                            <p class="text-sm text-left hover:text-white">
                                                {{ $action->property->name }}
                                            </p>
                                        </a>
                                    </div>
                                </td>

                                <!-- Time -->
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-start">
                                        <p class="text-sm text-left">
                                            {{ $action->created_at->diffForHumans()}}
                                        </p>
                                    </div>
                                </td>

                                <!-- Options-->
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-start">
                                        <a wire:loading.remove href="{{ route('admin-single-action', ['id' => $action->id]) }}" class="hover:text-red-400">
                                            <x-carbon-view class="w-[25px]"/>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- All actions link --}}
            <div class="flex items-center justify-center w-full p-2 bg-gray-800 border-t border-gray-700 rounded-b-xl">
                <a href="{{ route('admin-actions') }}" class="mx-auto cursor-pointer">
                    <p class="text-sm font-bold cursor-pointer hover:text-white">
                        See all Actions
                    </p>
                </a>
            </div>
        </div>

    </div>
</div>
