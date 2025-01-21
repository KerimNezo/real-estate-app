<x-app-layout>
    <x-slot:title>
        All properties
    </x-slot>

    <main>
        <div class="w-full pt-24 bg-gray-300 ">
            <div id="property-index-content" class="relative items-start justify-center w-full h-full mx-auto bg-gray-300 py-9">
                <!-- Property query filter form -->
                <livewire:property-filter-form />

                <!-- Property query result list -->
                <livewire:property-result-list :$filters/>
            </div>
        </div>
    </main>
</x-app-layout>
