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
            <div id="main-content" class="w-full bg-gray-900">
                <div class="flex items-center justify-center w-full z-9">
                    <!-- table to display property data -->
                    <div class="py-8 text-xl text-center px-[6%]">
                        <div class="overflow-x-auto">
                            <table class="min-w-full overflow-hidden bg-gray-800 rounded-xl">
                                <!-- Header of the table -->
                                <thead class="bg-gray-800 border-gray-700">
                                    <tr id="table-header">
                                        <!-- Image -->
                                        <th class="py-2 pl-12 pr-3 text-lg border-b border-gray-700">
                                            <div id="header-title">
                                                <p class="text-lg">
                                                    Key
                                                </p>
                                            </div>
                                        </th>

                                        <!-- Agent -->
                                        <th class="py-2 pl-12 pr-3 text-lg border-b border-gray-700">
                                            <div id="header-title">
                                                <p class="text-lg">
                                                    Data
                                                </p>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- media section -->
                                    <tr class="border-t border-gray-700">
                                        <!-- Key -->
                                        <td class="py-4 pl-12 text-base leading-6">
                                            <div class="flex items-center justify-start">
                                                <p class="text-left w-36">
                                                    Media
                                                </p>
                                            </div>
                                        </td>
                                        <!-- Value -->
                                        <td class="py-4 pl-12 pr-4 text-base leading-6">
                                            <div class="flex items-center justify-start space-x-2">
                                                @foreach($property->getMedia('property-photos') as $media)
                                                    <img src="{{ $media->getUrl() }}" alt="Property Photo" class="w-[120px] h-[90px] object-cover rounded-lg">
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- user data -->
                                    @foreach ($userData as $key => $value)
                                        @if ($key === 'id')
                                        <!-- Don't display his id -->
                                        @else
                                        <tr class="border-t border-gray-700">
                                            <!-- Key -->
                                            <td class="py-4 pl-12 text-base leading-6">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-left w-36">
                                                        {{ ucwords(str_replace('_', ' ', $key)) }}
                                                    </p>
                                                </div>
                                            </td>
                                            <!-- Value -->
                                            <td class="py-4 pl-12 pr-4 text-base leading-6">
                                                <div class="flex items-center justify-start">
                                                    <p class="text-left">
                                                        {{ $value }}
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    <!-- property data -->
                                    @foreach ($propertyData as $key => $value)
                                    <tr class="border-t border-gray-700">
                                        <!-- Key -->
                                        <td class="py-4 pl-12 text-base leading-6">
                                            <div class="flex items-center justify-start">
                                                <p class="text-left w-36">
                                                    {{ ucwords(str_replace('_', ' ', $key)) }}
                                                </p>
                                            </div>
                                        </td>
                                        <!-- Value -->
                                        <td class="py-4 pl-12 pr-4 text-base leading-6">
                                            <div class="flex items-center justify-start">
                                                <p class="text-left">
                                                    @if ($key === 'price')
                                                    {{ number_format($value, 0) }} $
                                                    @else
                                                    {{ $value ?? 'No'}}
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
