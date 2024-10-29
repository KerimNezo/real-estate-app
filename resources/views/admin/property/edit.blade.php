<x-admin-layout>
    <x-slot:title>
        {{ $property->name }}
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
                <div class="w-[80%] mx-auto py-8">
                    <!-- Livewire form -->
                    <livewire:admin.edit-property :$property />
                </div>
            </div>
        </div>

        @include('admin.footer')
    </div>


    <script>
        function updateOfferType(type) {
            document.getElementById('offer_type_input').value = type;
            console.log(type);

            document.querySelectorAll('button[id="offerType"]').forEach(button => {
                button.classList.remove('bg-blue-600', 'text-white');
            });

            event.target.classList.add('bg-blue-600', 'text-white');

            if (type == 'Sale') {
                document.getElementById('Rented').classList.add('hidden');
                document.getElementById('Sold').classList.remove('hidden');
            } else {
                document.getElementById('Sold').classList.add('hidden');
                document.getElementById('Rented').classList.remove('hidden');
            }
        }

        function updateStatus(status) {
            document.getElementById('status_input').value = status;
            console.log(status);

            if (status == 'Available') {
                document.querySelectorAll('button[id="Sold"], button[id="Rented"]').forEach(button => {
                    button.classList.remove('bg-blue-600', 'text-white');
                });
                event.target.classList.add('bg-blue-600', 'text-white');
            } else {
                document.getElementById('Available').classList.remove('bg-blue-600', 'text-white');
                document.getElementById('Sold').classList.add('bg-blue-600', 'text-white');
                document.getElementById('Rented').classList.add('bg-blue-600', 'text-white');
            }
        }
    </script>
</x-admin-layout>
