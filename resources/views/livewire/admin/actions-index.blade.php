<div>
    {{-- Actions filter form --}}
    <div class="w-full pb-2">
        <form wire:submit.prevent="submitForm">
            <div class="flex flex-col justify-center w-full lg:flex-row sm:items-start lg:items-center z-9 ">
                <!-- Status (Sold - For Sale - Rent) -->
                <div class="flex-col items-center justify-center pb-2 lg:pr-3 lg:mr-0 lg:ml-auto sm:ml-0 sm:mr-auto lg:pb-0">
                    <select id="" wire:model="actionName" class="rounded-[5px] h-[40px] pl-[10px] pr-8 text-[#989898]-black bg-gray-800 w-full" name="asset-offer-id">
                        <option value="0" selected>Action</option>
                        <option value="Sold">Sold</option>
                        <option value="Created">Created</option>
                        <option value="Deleted">Deleted</option>
                        <option value="Rented">Rented</option>
                        <option value="Edited">Edited</option>
                        <option value="Removed">Removed</option>
                    </select>
                </div>

                <!-- cities -->
                <div class="flex-col items-center justify-center pb-2 lg:pr-3 lg:pb-0 sm:mr-auto lg:mr-0">
                    <select id="" wire:model="agentId" class="rounded-[5px] h-[40px] pl-[10px] pr-8 text-[#989898]-black bg-gray-800 w-full" name="asset-location">
                        <option value="" selected>Agent</option>
                        @foreach ($this->agents as $agent)
                            <option value="{{$agent->id}}">{{$agent->name}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- submit button -->
                <button class="bg-[#ef5d60] py-2 px-4 rounded-[5px] hover:bg-red-400 flex items-center justify-center gap-2">
                    <div wire:loading wire:target="submitForm" class="flex items-center justify-center">
                        <img src="{{ asset('photos/redSpinner.svg') }}" class="w-5 h-5"></img> <!-- SVG loading spinner -->
                    </div>

                    <p class="text-base">Submit</p>
                </button>
            </div>
        </form>
    </div>

    @if($this->actions->isEmpty())
        <!-- Propreties Not Found -->
        <div class="flex-grow flex items-center justify-center px-[6%] py-24 mb-5">
            <div class="text-center">
                <img src="{{ asset('photos/icons/no-result.svg') }}" alt="No results" class="w-[100px] mx-auto">
                <p class="pt-[40px]">It seems like there are no matching results for your search...</p>
            </div>
        </div>
    @else
        {{-- Action table --}}
        <div class="text-xl text-center">
            <!-- Table Header-->
            <div>
                <p class="pb-2 pl-4 text-sm text-left">
                    Actions table
                </p>
            </div>

            <!-- Actions Table Content-->
            <div wire:loading.class="opacity-30">

                {{-- Table  --}}
                <div class="overflow-x-auto">
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
                            </tr>
                        </thead>

                        <!-- Action Tables Content-->
                        <tbody>
                            @foreach ($this->actions as $action)
                                <tr class="border-t border-gray-700" wire:key="1">
                                    <!-- Action Id -->
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-start">
                                            <a wire:loading.class="hidden" href="{{ route('admin-single-action', ['id' => $action->id]) }}"">
                                                <p class="text-sm text-left hover:text-white">
                                                    {{ $action->id }}
                                                </p>
                                            </a>
                                        </div>
                                    </td>

                                    <!-- Agent name -->
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-start">
                                            <a wire:loading.class="hidden" href="{{ route('single-agent', ['user' => $action->user])}}">
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
                                            <a wire:loading.class="hidden" href="{{ route('admin-single-property', [ 'user' => $action->property->user_id, 'property' => $action->property])}}">
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
                                            <a wire:loading.class="hidden" href="{{ route('admin-single-action', ['id' => $action->id]) }}" class="hover:text-red-400">
                                                <x-carbon-view class="w-[25px]"/>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="flex items-center justify-center w-full py-1 bg-gray-800 border-t border-gray-700 rounded-b-xl">
                    <div class="static flex items-center justify-between w-full px-4 mb-2">
                        {{ $this->actions->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
