@props(['name', 'label'])

<div class="flex items-center w-full mb-4 mr-auto">
    <div class="flex items-center justify-center mb-2 mr-auto">
        <input wire:model="{{ $name }}" type="checkbox" name="{{ $name }}" value="1" class="mr-2 font-bold rounded-full">
        <p class="font-bold">{{ $label }}</p>
    </div>
    @error('{{ $name }}')
        <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
