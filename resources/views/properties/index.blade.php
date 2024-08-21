@php
    $order = 'Most recent';
@endphp

<x-app-layout>
    <x-slot:title>
        All properties
    </x-slot>

    <main>
        <livewire:all-properties :cities='$cities' :propertyCount='$propertyCount' order='Most recent' :properties='$properties'/>
    </main>
</x-app-layout>
