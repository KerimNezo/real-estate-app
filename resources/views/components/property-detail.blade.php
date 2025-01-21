@props(['title', 'text', 'icon', 'unit', 'css'])


@php
    if($title === 'Garage') {
            if($text === 1) {
                $text = 'Yes';
            } else {
                $text = 'No';
            }
    }
@endphp

<div id="property-detail" class="flex items-center justify-start w-[33%] ">
    <div class="!bg-[#8E8A8D] !bg-opacity-0 p-[2px] rounded-[10px] !w-[50px] !h-[50px] flex justify-center items-center !text-teal-800 !fill-teal-800" >
        @svg($icon, $css)
    </div>
    <div class="flex flex-col items-start justify-center">
        <p id="details-title">{!! $title !!}</p>

        <div class="flex">
            <p id="details-text"> {!! $text !!} </p>
            <p id="details-text"> {!! $unit !!}</p>
        </div>
    </div>
</div>
