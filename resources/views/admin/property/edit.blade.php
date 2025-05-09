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

        <div class="flex w-full pt-[100px] flex-grow overflow-hidden">
            @if (Auth::user()->hasRole('admin'))
                @include('components.sidebar-admin')
            @else
                @include('components.sidebar-agent')
            @endif

            <!-- Main content -->
            <div id="main-content" class="flex flex-col w-full overflow-hidden bg-gray-900">
                <div class="w-[80%] mx-auto py-8 ">
                    <!-- Livewire form -->
                    <livewire:admin.edit-property :$property :$propertyMedia/>
                </div>
            </div>
        </div>

        @include('admin.footer')
    </div>

    <script>
        // ovu koristimo da maknemo boju sa offer typa gore
        function updateOfferType(type) {
            document.getElementById('offer_type_input').value = type;
            console.log(type);

            document.querySelectorAll('label[id="offerType"]').forEach(button => {
                button.classList.remove('bg-blue-600', 'text-white');
            });

            event.target.classList.add('bg-blue-600', 'text-white');
        }

        // ovu koristimo da maknemo boju sa ovih dole budućih available/unavailable
        function updateStatus(status) {
            document.getElementById('status_input').value = status;
            console.log(status);

            if (status == 'Available') {
                document.querySelectorAll('label[id="Unavailable"]').forEach(button => {
                    button.classList.remove('bg-blue-600', 'text-white');
                });
                event.target.classList.add('bg-blue-600', 'text-white');
            } else {
                document.getElementById('Available').classList.remove('bg-blue-600', 'text-white');
                document.getElementById('Unavailable').classList.add('bg-blue-600', 'text-white');
            }
        }
    </script>
</x-admin-layout>
