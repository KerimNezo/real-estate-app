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
            <div id="main-content" class="w-full pt-[100px] bg-gray-900">
                <div class="flex items-center justify-center w-full z-9">
                    <!-- table to display property data -->
                    <div class="py-8 text-xl text-center px-[6%]">
                        <div class="overflow-x-auto">
                            <table class="min-w-full overflow-hidden bg-gray-800 rounded-xl">
                                <thead class="bg-gray-800 border-gray-700">
                                    <tr id="table-header">
                                        <!-- Image -->
                                        <x-table.table-header title="Image" />
                                        <!-- Agent -->
                                        <x-table.table-header title="Agent" />
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($propertyAttributes as $key => $value)
                                    <tr class="border-t border-gray-700">
                                        <!-- Agent name -->
                                        <td id="table-data">
                                            <div class="flex items-center justify-start">
                                                <p class="hover:text-white">
                                                    {{ $key }}
                                                </p>
                                            </div>
                                        </td>
                                        <!-- Property price -->
                                        <td id="table-data">
                                            <div class="flex items-center justify-start">

                                                <p>
                                                    @if ($key === 'price')
                                                    {{ number_format($value, 0) }} $
                                                    @else
                                                    {{ $value ?? 'no'}}
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

        @include('admin.footer')
    </div>
</x-admin-layout>
