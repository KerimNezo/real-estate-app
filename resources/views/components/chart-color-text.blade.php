@props(['color', 'text'])

<div class="flex items-center justify-center gap-2 pl-2">
    <p class="text-sm">
        {{ $text }}
    </p>

    <div class="{{ $color }} w-4 h-4 rounded-[5px]">
    </div>
</div>
