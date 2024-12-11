<x-admin-layout>
    <x-slot:title>
        Agent: {{ $agent->name }}
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
            <div id="main-content" class="w-full bg-gray-900">
                <div class="flex flex-col items-center justify-center w-full z-9">
                    <!-- table to display property agent data -->
                    <div class="py-8 text-xl text-center px-[6%] w-full">
                        {{-- Table header --}}
                        <div>
                            <p class="pb-2 pl-4 text-sm text-left">
                                {{ ucwords($agent->getRoleNames()[0]) }} information
                            </p>
                        </div>

                        {{-- Table content --}}
                        <div class="w-full overflow-x-auto">
                            <!-- Agent data -->
                            <div class="">
                                <table class="min-w-full overflow-hidden bg-gray-800 rounded-xl">
                                    <!-- Header of the table -->
                                    <thead class="w-full bg-gray-800 border-gray-700">
                                        <tr id="table-header" style="width: 100%">
                                            <!-- Key -->
                                            <th class="px-4 py-2 text-lg border-b border-gray-700">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-lg">Key</p>
                                                </div>
                                            </th>

                                            <!-- Data -->
                                            <th class="w-full px-4 py-2 text-lg border-b border-gray-700">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-lg">Data</p>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>

                                    <!-- Table data -->
                                    <tbody class="w-full">
                                        <!-- Agent data -->
                                        <tr class="w-full border-t border-gray-700">
                                            <!-- Agent profile image title -->
                                            <td class="px-4 py-4 text-base leading-6">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-left w-36">
                                                        Avatar
                                                    </p>
                                                </div>
                                            </td>

                                            <!-- Agent profile image content -->
                                            <td class="w-full px-4 py-4 text-base leading-6">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-left">
                                                    @if ($agent->id === 1)
                                                        <img src="{{ $agent->getFirstMediaUrl('admin-pfp') }}" alt="" class="rounded-[5px] h-[100px] w-[100px]">
                                                    @else
                                                        <img src="{{ $agent->getFirstMediaUrl('agent-pfps') }}" alt="" class="rounded-[5px] h-[100px] w-[100px]">
                                                    @endif
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>

                                        @foreach ($agentData as $key=>$value)
                                            <tr class="w-full border-t border-gray-700">
                                                <!-- key -->
                                                <td class="px-4 py-4 text-base leading-6">
                                                    <div class="flex items-center justify-start">
                                                        <p class="text-left w-36">
                                                            {{ ucwords(str_replace('_', ' ', $key)) }}
                                                        </p>
                                                    </div>
                                                </td>

                                                <!-- value -->
                                                <td class="w-full px-4 py-4 text-base leading-6">
                                                    <div class="flex items-center justify-start">
                                                        <p class="text-left">
                                                            {{ $value }}
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Table that display agents properties --}}
                    @if ($agent->id !== 1)
                        <div class="py-8 text-xl text-center px-[6%] w-full">
                            <livewire:admin.agent-property-table :$agent />
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-auto">
            @include('admin.footer')
        </div>
    </div>

    {{-- Confirmation form modal --}}
    <div id="confirmationButtonModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-95" onclick="closeConfirmationModal(event)">
        <div class="bg-gray-900 bg-opacity-95 rounded-[20px] w-[450px] h-[350px] relative mx-auto my-auto" onclick="event.stopPropagation()">
            <div class="flex flex-col items-center justify-center h-full p-2">
                {{-- x button --}}
                <span class="absolute flex items-center justify-center px-[10px] py-0 text-2xl text-white bg-gray-700 rounded-full cursor-pointer top-3 right-3 text-center" onclick="closeConfirmationModal()">&times;</span>

                {{-- Header text --}}
                <div class="flex items-center justify-center w-full px-5 mx-auto mt-10">
                    <p class="text-xl text-center">Are you sure you want to delete this property?</p>
                </div>

                {{-- Action explanation text --}}
                <div class="mb-auto">
                    <p class="text-xs">(Confirming this will permanently delete the selected property)</p>
                </div>

                {{-- Property details --}}
                <div class="flex w-full px-5 py-3">
                    {{-- Property image --}}
                    <div class="px-5 bg-gray-800 rounded-[20px] w-full py-3 flex justify-center items-center">
                        <img id="propertyPhoto" src="" alt="Property image" class="w-24 rounded-[10px] mr-auto">
                        <p id="propertyName" class="text-base text-center"></p>
                    </div>
                </div>

                {{-- Form footer containing two buttons --}}
                <div class="flex w-full px-5 py-5">
                    <button class="px-4 py-2 mr-auto bg-green-600 rounded-[10px]" onclick="closeConfirmationModal()">
                        Cancel
                    </button>

                    {{-- Hidden form for sending delete request --}}
                    <form id="deletePropertyForm" action="" method="POST" class="ml-auto">
                        @csrf
                        @method('DELETE') <!-- Spoofing the DELETE request -->
                        <button type="submit" class="px-4 py-2 bg-red-600 rounded-[10px]">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal script -->
    <script>
        function openConfirmationModal(property, imageUrl) {
            document.getElementById('confirmationButtonModal').classList.remove('hidden');
            document.getElementById('confirmationButtonModal').classList.add('flex');
            document.getElementById('propertyPhoto').src = imageUrl;
            document.getElementById('propertyName').textContent = property.name;

            document.getElementById('deletePropertyForm').action = `{{ route('delete-property', ':id') }}`.replace(':id', property.id);
        }

        function closeConfirmationModal(event) {
            if (event) {
                event.stopPropagation(); // Prevents the event from bubbling if the click was on the modal content
            }
            document.getElementById('confirmationButtonModal').classList.add('hidden');
        }
    </script>
</x-admin-layout>
