<div>
    <div class="px-[6%]">
        @if($this->agents->isEmpty())
    <!-- Agents Not Found -->
        <div class="flex-grow flex items-center justify-center px-[6%] py-24 mb-5">
            <div class="text-center">
                <img src="{{ asset('photos/icons/no-result.svg') }}" alt="No results" class="w-[100px] mx-auto">
                <p class="pt-[40px]">It seems like there are no matching results for your search...</p>
            </div>
        </div>
    @else
    <!-- Agents Found -->
        <div class="py-8 text-xl text-center px-[6%]">
            <div>
                <p class="pb-2 text-sm text-left">
                    Agents table
                </p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full overflow-hidden bg-gray-800 rounded-xl">
                    <thead class="bg-gray-800 border-gray-700">
                        <tr id="table-header">
                            <!-- Profile photo -->
                            <x-table.table-header title="Avatar" />
                            <!-- Agent name -->
                            <x-table.table-header title="Name" />
                            <!-- Email-->
                            <x-table.table-header title="Email" />
                            <!-- Phone Number -->
                            <x-table.table-header title="Phone Number" />
                            <!-- One property display -->
                            <x-table.table-header title="Agent properties" />
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->agents as $agent)
                        <tr class="border-t border-gray-700" wire:key="{{ $agent->id }}">
                            <!-- Image -->
                            <td id="table-data">
                                <div class="flex items-center justify-start">
                                    <p>
                                        <img src="{{ $agent->getFirstMediaUrl('agent-pfps') }}" alt="Agent Profile Photo" class="w-[65px] h-[65px] object-cover rounded-[5px]">
                                    </p>
                                </div>
                            </td>

                            <!-- Agent Name -->
                            <td id="table-data">
                                <div class="flex items-center justify-start">
                                    <a href="{{ route('single-agent', ['user' => $agent])}}">
                                        <p class="hover:text-white">
                                            {{ $agent->name }}
                                        </p>
                                    </a>
                                </div>
                            </td>

                            <!-- Agent Email -->
                            <td id="table-data">
                                <div class="flex items-center justify-start">
                                    <p>
                                        {{ $agent->email }}
                                    </p>
                                </div>
                            </td>

                            <!-- Agent Phone Number -->
                            <td id="table-data">
                                <div class="flex items-center justify-start">
                                    <p>
                                        {{ $agent->phone_number }}
                                    </p>
                                </div>
                            </td>

                            <!-- Agent Property section -->
                            <td id="table-data">
                                <div class="flex items-center justify-start">
                                    @if ($agent->properties->isNotEmpty()) <!-- Check if agent has properties -->
                                        <a href="/admin/agent/{{ $agent->id }}/#agent-properties">
                                            <p>
                                                <img src="{{ $agent->properties[0]->getFirstMediaUrl('property-photos') }}" alt="Agent Property Photo" class="w-[100px] h-[75px] object-cover rounded-[5px]">
                                            </p>
                                        </a>
                                    @else
                                        <div class="flex items-center justify-center w-[100px]">
                                            <x-ionicon-image-sharp class="h-[75px] mx-auto"/>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <td id="table-data">
                                <div class="flex items-center justify-start gap-4">
                                    <a href="{{ route('single-agent', $user = $agent) }}" class="hover:text-red-400">
                                        <x-carbon-view class="w-[25px]"/>
                                    </a>
                                    <a href="{{ route('edit-agent', $user = $agent) }}" class="hover:text-red-400">
                                        <x-feathericon-edit class="w-[25px] h-[25px]" />
                                    </a>
                                    <a onclick="openConfirmationModal({{$agent}}, '{{$agent->getFirstMediaUrl('agent-pfps')}}')" class="hover:text-red-400">
                                        <x-heroicon-s-trash class="w-[25px]" />
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="static flex items-center justify-between w-full py-2">
                {{ $this->agents->links() }}
            </div>
        </div>
    @endif
    </div>
</div>
