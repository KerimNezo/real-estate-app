<x-admin-layout>
    <x-slot:title>
        All properties
    </x-slot:title>

    <!-- Page content -->
    <div id="page-content" class="flex flex-col min-h-screen bg-gray-900">
        <!-- Admin topbar -->
        <div class="fixed top-0 left-0 z-10 w-full bg-gray-800">
            @include('components.topbar-admin')
        </div>

        <div class="flex w-full pt-[100px] flex-grow">
            @include('components.sidebar-admin')

            <!-- Main content -->
            <div id="main-content" class="flex flex-col flex-grow w-full pt-6 bg-gray-900">
                <!-- SearchForm/Table -->
                <livewire:admin.property-index :$minPrice :$maxPrice :$assetLocation :$assetTypeId :$cities/>
            </div>
        </div>

        @include('admin.footer')
    </div>

    <!-- Confirmation form modal -->
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

                    <!-- Hidden form for deletion -->
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
