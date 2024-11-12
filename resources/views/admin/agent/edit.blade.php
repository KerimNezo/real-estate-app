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
            <div id="main-content" class="w-full py-6 bg-gray-900">
                <!-- Update Property Form -->
                <div>
                    <!-- Update Property Form -->
                    <div class="flex flex-col items-center justify-center p-4 mx-auto bg-gray-800 rounded-lg shadow-lg w-[80%]">
                        <!-- Title -->
                        <h1 class="py-4 text-xl font-bold text-center">
                            Update Agent Information
                        </h1>

                        <div class="w-full h-full px-4">
                            <!-- Table to display agent data-->
                            <div class="flex flex-col w-full gap-4 lg:flex-row">
                                <!-- General property data -->
                                <div class="w-full sm:w-[40%] pt-[10px]">
                                    <!-- Agent Name -->
                                    <x-formInput type="text" title="name" label="Name" :value='$agent->name'/>
                                    <p id="nameError" class="hidden pb-2 text-red-600 text-bold">You didn't enter any name.</p>

                                    <!-- Agent email -->
                                    <x-formInput type="text" title="agentEmail" label="Email" :value='$agent->email'/>
                                    <p id="emailError" class="hidden pb-2 text-red-600 text-bold">Your email isn't valid.</p>

                                    <!-- Agent phone number -->
                                    <x-formInput type="text" title="phoneNumber" label="Phone number" :value='$agent->phone_number'/>
                                    <p id="phoneError" class="hidden pb-2 text-red-600 text-bold">You didn't enter a phone number</p>

                                    <!-- Agent password -->
                                    <x-formInput type="password" title="agentPassword" label="New password" />

                                    <!-- Confirm agent password -->
                                    <x-formInput type="password" title="confirmAgentPassword" label="Confirm new password" />
                                    <p id="passwordError" class="hidden pb-2 text-red-600 text-bold">Your passwords don't match.</p>
                                </div>

                                <!-- Agent profile picture section (will be a livewire component) -->
                                <div class="w-full sm:w-[60%]">
                                    <livewire:admin.agent-picture :$agentPicture />
                                </div>
                            </div>

                            <!-- Update Button -->
                            <form id="updateForm" class="hidden" enctype="multipart/form-data" action="{{ route('update-agent', ['user' => $agent]) }}" method="POST">
                                @method('PUT')
                                @csrf
                            </form>

                            <div class="py-6 text-center">
                                <button onclick="submitForm()" class="px-6 py-2 text-white bg-blue-600 rounded-lg">
                                    Update Agent
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- <livewire:admin.edit-agent /> --}}
            </div>
        </div>

        <script>
            function submitForm() {

                console.log('verify input');
                verify();

                //document.getElementById('updateForm').submit();
            }

            function verify() {
                // function that verifies input
                const name = document.getElementById('name').value;
                const agentEmail = document.getElementById('agentEmail').value;
                const phoneNumber = document.getElementById('phoneNumber').value;
                const agentPassword = document.getElementById('agentPassword').value;
                const confirmAgentPassword = document.getElementById('confirmAgentPassword').value;

                if (agentPassword !== confirmAgentPassword) {
                    document.getElementById('passwordError').classList.remove('hidden');
                    setTimeout(() => {
                        document.getElementById('passwordError').classList.add('hidden');
                    }, 5000);
                }

                if (name === '') {
                    document.getElementById('nameError').classList.remove('hidden');
                    setTimeout(() => {
                        document.getElementById('nameError').classList.add('hidden');
                    }, 5000);
                }

                console.log('proslo je');
            }
        </script>

        @include('admin.footer')
    </div>
</x-admin-layout>
