<x-admin-layout>
    <x-slot:title>
        Admin Panel
    </x-slot:title>

    <!-- Page content -->
    <div class="flex flex-col min-h-screen bg-gray-900">
        <!-- Admin topbar -->
        <div class="fixed top-0 left-0 z-10 w-full bg-gray-800">
            @include('components.topbar-admin')
        </div>

        <div class="flex w-full pt-[100px]">
            @include('components.sidebar-admin')

            <!-- Main content-->
            <div id="main-content" class="w-full pt-6 bg-gray-900">
                <!-- Agent table -->
                <livewire:admin.agent-index />
            </div>
        </div>

        <div class="mt-auto">
            @include('admin.footer')
        </div>
    </div>

    <!-- Confirmation form modal -->
    <div id="confirmationButtonModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-95" onclick="closeConfirmationModal(event)">
        <div class="bg-gray-900 bg-opacity-95 rounded-[20px] w-[450px] h-[350px] relative mx-auto my-auto" onclick="event.stopPropagation()">
            {{-- Modal that displays if agent has no properties assigned to him. --}}
            <div id="confirmationModal" class="flex flex-col items-center justify-center h-full p-2">
                {{-- x button --}}
                <span class="absolute flex items-center justify-center px-[10px] py-0 text-2xl text-white bg-gray-700 rounded-full cursor-pointer top-3 right-3 text-center" onclick="closeConfirmationModal()">
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

                    <!-- Hidden form for deletion -->
                    <form id="deleteAgentForm" action="" method="POST" class="ml-auto">
                        @csrf
                        @method('DELETE') <!-- Spoofing the DELETE request -->
                        <button type="submit" class="px-4 py-2 bg-red-600 rounded-[10px]">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            {{-- Modal that displays if agent still has some properties assigned to him. --}}
            <div id="warningModal" class="flex flex-col items-center justify-center h-full p-2">
                {{-- x button --}}
                <span class="absolute flex items-center justify-center px-[10px] py-0 text-2xl text-white bg-gray-700 rounded-full cursor-pointer top-3 right-3 text-center" onclick="closeConfirmationModal()">
                    <div class="flex items-center justify-center">&times</div>
                </span>

                {{-- Header text --}}
                <div class="flex flex-col items-center justify-center w-full px-5 mx-auto mt-auto">
                    <p class="text-xl text-center">Sorry, you can't delete this agent:</p>
                    <p id="agent" class="my-3 text-2xl text-center"></p>
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

    <!-- Modal script -->
    <script>
        function openConfirmationModal(agent, imageUrl, propertyCount) {
            document.getElementById('confirmationButtonModal').classList.remove('hidden');
            document.getElementById('confirmationButtonModal').classList.add('flex');
            if (propertyCount != 0) {
                document.getElementById('warningModal').classList.remove('hidden');
                document.getElementById('confirmationModal').classList.add('hidden');
                document.getElementById('agent').textContent = agent.name;
            } else {
                document.getElementById('confirmationModal').classList.remove('hidden');
                document.getElementById('warningModal').classList.add('hidden');
                document.getElementById('agentPhoto').src = imageUrl;
                document.getElementById('deleteAgentForm').action = `{{ route('delete-agent', ':id') }}`.replace(':id', agent.id);
                document.getElementById('agentName').textContent = agent.name;
            }

        }

        function closeConfirmationModal(event) {
            if (event) {
                event.stopPropagation(); // Prevents the event from bubbling if the click was on the modal content
            }
            document.getElementById('confirmationButtonModal').classList.add('hidden');
        }
    </script>
</x-admin-layout>
