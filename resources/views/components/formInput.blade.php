@props(['title', 'label', 'model' => '', 'type'])

<div class="mb-2 mr-auto">
    <label for="{{ $title }}" class="block mb-2 font-bold">{{ $label }}:</label>

    @if ($title === 'password_confirmation')
        <input type="{{ $type }}" name="{{ $title }}" id="{{ $title }}" wire:model.blur="{{ $model }}" class="w-full px-3 py-2 bg-gray-800 border rounded-lg
        @error('password')  border-red-500 @enderror">
    @else
        <input type="{{ $type }}" name="{{ $title }}" id="{{ $title }}" wire:model.blur="{{ $model }}" class="w-full px-3 py-2 bg-gray-800 border rounded-lg
        @error($title)  border-red-500 @enderror">
    @endif
</div>
