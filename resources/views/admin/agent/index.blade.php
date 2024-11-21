<x-admin-layout>
    <x-slot:title>
        All agents
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
                @include('components.admin-session-messages')

                <!-- Agent table -->
                <livewire:admin.agent-index />
            </div>
        </div>

        <div class="mt-auto">
            @include('admin.footer')
        </div>
    </div>

    <!-- Modal script -->
    <script>
        function openConfirmationModal(agent, imageUrl) {
            id = 'confirmation' + agent.id;
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('flex');
            document.getElementById(agent.id).classList.remove('hidden');
            document.getElementById('agentPhoto').src = imageUrl;
            document.getElementById('agentName').textContent = agent.name;
        }

        function closeConfirmationModal(event) {
            if (event) {
                event.stopPropagation(); // Prevents the event from bubbling if the click was on the modal content
            }
            document.getElementById(event.explicitOriginalTarget.id).classList.add('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
</x-admin-layout>
