@props(['text', 'link'])

<div class="w-full hover:text-white rounded-[5px]">
    <a href="{{ $link }}" class="block w-full pl-11">
        <p class="m-0 text-sm">{{ $text }}</p>
    </a>
</div>
