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
            <div class="text-xl text-center">
                <div>
                    <p class="pb-2 pl-4 text-sm text-left">
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
                                            <img src="{{ $agent->getFirstMediaUrl('agent-pfps') }}" id="agentPhoto" alt="Agent Profile Photo" class="w-[65px] h-[65px] object-cover rounded-[5px]">
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

                                <!-- Form modal -->
                                @if($agent->properties->count() === 0)
                                    <div id="confirmation{{$agent->id}}" class="fixed inset-0 z-50 hidden bg-black bg-opacity-95" onclick="closeConfirmationModal(event)">
                                        <div class="bg-gray-900 bg-opacity-95 rounded-[20px] w-[450px] h-[350px] relative mx-auto my-auto" onclick="event.stopPropagation()">
                                            {{-- Modal that will display if agent has no properties and is okay if he is deleted --}}
                                            <div id="{{ $agent->id }}" class="flex flex-col items-center justify-center h-full p-2">
                                                {{-- x button --}}
                                                <span class="absolute flex items-center justify-center px-[10px] py-0 text-2xl text-white bg-gray-700 rounded-full cursor-pointer top-3 right-3 text-center" onclick="closeModal('confirmation{{$agent->id}}')">
                                                    <div class="flex items-center justify-center">&times</div>
                                                </span>

                                                {{-- Header text --}}
                                                <div class="flex items-center justify-center w-full px-5 mx-auto mt-10">
                                                    <p class="text-xl text-center">Are you sure you want to delete this agent?</p>
                                                </div>

                                                {{-- Action explanation text --}}
                                                <div class="mb-auto">
                                                    <p class="text-xs">(Confirming this will permanently delete the selected agent)</p>
                                                </div>

                                                {{-- Property details --}}
                                                <div class="flex w-full px-5 py-3">
                                                    {{-- Property image --}}
                                                    <div class="px-5 bg-gray-800 rounded-[20px] w-full py-3 flex justify-center items-center">
                                                        <img id="agentPhoto" src="" alt="Agent image" class="w-24 rounded-[10px] mr-auto">
                                                        <p id="agentName" class="text-base text-center"></p>
                                                    </div>
                                                </div>

                                                {{-- Form footer containing two buttons --}}
                                                <div class="flex w-full px-5 py-5">
                                                    <button class="px-4 py-2 mr-auto bg-green-600 rounded-[10px]" onclick="closeConfirmationModal()">
                                                        Cancel
                                                    </button>

                                                    <button type="button" class="px-4 py-2 bg-red-600 rounded-[10px]" wire:click="deleteAgent({{$agent->id}})">
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div id="confirmation{{$agent->id}}" class="fixed inset-0 z-50 hidden bg-black bg-opacity-95" onclick="closeConfirmationModal(event)">
                                        <div class="bg-gray-900 bg-opacity-95 rounded-[20px] w-[450px] h-[350px] relative mx-auto my-auto" onclick="event.stopPropagation()">
                                            {{-- Modal that will display if agent still has properties and can't be deleted --}}
                                            <div id="{{ $agent->id }}" class="flex flex-col items-center justify-center h-full p-2">
                                                {{-- x button --}}
                                                <span class="absolute flex items-center justify-center px-[10px] py-0 text-2xl text-white bg-gray-700 rounded-full cursor-pointer top-3 right-3 text-center" onclick="closeModal('confirmation{{$agent->id}}')">
                                                    <div class="flex items-center justify-center">&times</div>
                                                </span>

                                                {{-- Header text --}}
                                                <div class="flex flex-col items-center justify-center w-full px-5 mx-auto mt-auto">
                                                    <p class="text-xl text-center">Sorry, you can't delete this agent:</p>
                                                    <p id="agentName" class="my-3 text-2xl text-center"></p>
                                                </div>

                                                {{-- X animacija koju ću pokazati kada Admin pokuša obrisati Agenta koji ima propertije --}}
                                                <div>
                                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" class="rounded-xl"
                                                        width="120px" height="120px" viewBox="0 0 50 50" style="background-color: transparent"  enable-background="new 0 0 50 50" xml:space="preserve">
                                                    <g id="Layer_3" >
                                                        <line id="path2" fill="none" stroke="#dc2626" stroke-width="3" stroke-miterlimit="10" x1="8.5" y1="41.5" x2="41.5" y2="8.5"/>
                                                        <line id="path3" fill="none" stroke="#dc2626" stroke-width="3" stroke-miterlimit="10" x1="41.5" y1="41.5" x2="8.5" y2="8.5"/>
                                                    </g>
                                                    </svg>
                                                </div>

                                                {{-- Action explanation text --}}
                                                <div class="mt-3 mb-auto">
                                                    <p class="text-xs">Note: Make sure this agent has no properties assigned to him</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
