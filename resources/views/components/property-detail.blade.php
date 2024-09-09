@props(['title', 'text', 'icon', 'unit', 'css'])

<div class="flex justify-start items-center w-full ">
    <div class="bg-white p-[2px] rounded-[10px] w-[50px] h-[50px] flex justify-center items-center" style="color: #EF5D60;">
        @svg($icon, $css)
    </div>
    <div class="flex flex-col justify-center items-start">
        <p class="text-base pr-1 pl-1 font-bold">{{ $title }}</p>
        <p class="text-lg pr-1 pl-1">{{ $text }} {!! $unit !!}</p>
    </div>
</div>
