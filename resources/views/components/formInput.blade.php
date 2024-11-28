@props(['title', 'label', 'model' => '', 'type', 'placeholder' => ''])

<div class="mb-2 mr-auto">
    <label for="{{ $title }}" class="block mb-1 font-bold">{{ $label }}:</label>

    <div class="relative">
        @if ($title === 'password_confirmation')
            <input id="{{ $title }}" wire:key="{{ $title }}" placeholder="{{ $placeholder }}" type="{{ $type }}" name="{{ $title }}" id="{{ $title }}" wire:model.blur="{{ $model }}" class="w-full px-3 py-2 bg-gray-800 border rounded-lg
            @error('password')  border-red-500 @enderror">
        @else
            <input id="{{ $title }}" wire:key="{{ $title }}" placeholder="{{ $placeholder }}" type="{{ $type }}" name="{{ $title }}" id="{{ $title }}" wire:model.blur="{{ $model }}" class="w-full px-3 py-2 bg-gray-800 border rounded-lg
            @error($title)  border-red-500 @enderror">
        @endif

        @error($title)
            <div class="absolute text-red-500 -translate-y-1/2 top-1/2 right-4 group">
                <div class="flex items-center justify-center w-6 h-6 border-2 border-red-500 rounded-full cursor-pointer">
                    i
                </div>
                <!-- Tooltip on Hover -->
                <div class="absolute right-0 hidden w-40 px-2 py-1 mb-2 text-sm text-white bg-gray-800 border-gray-900 rounded-lg opacity-75 border-3 bottom-full group-hover:block">
                    {{ $message }}
                </div>
            </div>
        @enderror
    </div>
</div>
