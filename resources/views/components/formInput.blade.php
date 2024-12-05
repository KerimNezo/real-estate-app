@props(['title', 'label', 'model' => '', 'type', 'placeholder' => ''])

<div>
    <div class="relative w-full mb-2">
        <label for="{{ $title }}" class="block font-bold">{{ $label }}:</label>

        <x-error-message-info :titleVar="$title" />
    </div>

    <div class="mb-2">
        @if ($title === 'password_confirmation')
            <input id="{{ $title }}" wire:key="{{ $title }}" placeholder="{{ $placeholder }}" type="{{ $type }}" name="{{ $title }}" id="{{ $title }}" wire:model.blur="{{ $model }}" class="w-full px-3 py-2 bg-gray-800 border rounded-lg
            @error('password') border-red-500 @enderror">
        @else
            <input id="{{ $title }}" wire:key="{{ $title }}" placeholder="{{ $placeholder }}" type="{{ $type }}" name="{{ $title }}" id="{{ $title }}" wire:model.blur="{{ $model }}" class="w-full px-3 py-2 bg-gray-800 border rounded-lg
            @error($title) border-red-500 @enderror">
        @endif
    </div>
</div>
