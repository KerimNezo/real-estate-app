@props(['title', 'label', 'value' => '', 'type'])

<div class="mb-4 mr-auto">
    <label for="{{ $title }}" class="block mb-2 font-bold">{{ $label }}:</label>
    <input type="{{ $type }}" name="{{ $title }}" id="{{ $title }}" class="w-full px-3 py-2 bg-gray-800 border rounded-lg" value="{{ $value }}">
    @error('{{ $title }}')
        <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
