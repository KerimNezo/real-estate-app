@php
    $order = 'Most recent';
@endphp

<x-app-layout>
    <x-slot:title>
        All properties
    </x-slot>

    <main>
        <div class="w-full pt-24 bg-white ">
            <div id="property-index-content" class="relative items-start justify-center flex-grow w-full h-full pb-24 mx-auto bg-white pt-9">
                <!-- Property query filter form -->
                <livewire:property-filter-form :$cities />

                <!-- Property query result list -->
                <livewire:property-result-list :$propertyCount order='Most recent' :$properties/>
            </div>
        </div>
    </main>
</x-app-layout>
