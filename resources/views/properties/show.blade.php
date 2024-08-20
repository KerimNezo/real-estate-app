<x-app-layout>
    <x-slot:title>
        Property name
    </x-slot:title>

    <main class="w-full h-full pt-32 bg-slate-500">
        <div class="h-[500px]">
            {{ $property }}
        </div>
    </main>
</x-app-layout>
