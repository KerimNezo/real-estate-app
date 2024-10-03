@props(['title', 'text', 'icon', 'unit', 'css'])

<div id="property-detail" class="flex items-center justify-start w-[33%] ">
    <div class="bg-white p-[2px] rounded-[10px] !w-[50px] !h-[50px] flex justify-center items-center" style="color: #EF5D60;">
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
