@props(['title', 'label', 'model' => '', 'type'])

<div class="mb-2 mr-auto">
    <label for="{{ $title }}" class="block mb-2 font-bold">{{ $label }}:</label>
    <input type="{{ $type }}" name="{{ $title }}" id="{{ $title }}" class="w-full px-3 py-2 bg-gray-800 border rounded-lg @error($title)
        border-red-500
    @enderror" wire:model.blur="{{ $model }}">
</div>
