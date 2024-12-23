<x-admin-layout>
    <x-slot:title>
        Action: {{ $action->name }}
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
                                Action information
                            </p>
                        </div>

                        {{-- Table content --}}
                        <div class="w-full overflow-x-auto">
                            <!-- Agent data -->
                            <div>
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
                                        <tr class="w-full border-t border-gray-700">
                                            <!-- key -->
                                            <td class="px-4 py-4 text-base leading-6">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-left w-36">
                                                        Property
                                                    </p>
                                                </div>
                                            </td>

                                            <!-- value -->
                                            <td class="w-full px-4 py-4 text-base leading-6">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-left">
                                                        {{ $action->property->name}}
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="w-full border-t border-gray-700">
                                            <!-- key -->
                                            <td class="px-4 py-4 text-base leading-6">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-left w-36">
                                                        User
                                                    </p>
                                                </div>
                                            </td>

                                            <!-- value -->
                                            <td class="w-full px-4 py-4 text-base leading-6">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-left">
                                                        {{ $action->user->name}}
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>

                                        @foreach ($actionData as $key=>$value)
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
                                                            @if ($key === 'created_at')
                                                                {{ $value }} ({{ $action->created_at->diffForHumans()}})
                                                            @elseif ($key === 'name')
                                                                {{ ucfirst($value) }}
                                                            @else
                                                                {{ $value }}
                                                            @endif
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
                </div>
            </div>
        </div>

        <div class="mt-auto">
            @include('admin.footer')
        </div>
    </div>
</x-admin-layout>
