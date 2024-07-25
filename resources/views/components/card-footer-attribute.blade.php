@props(['var', 'imagePath', 'text'])


@if (is_null($var))

@else
    <li class="flex justify-center items-center gap-1">
        <img src="{{$imagePath}}" alt="" class="w-[30px] h-[30px]">

        <span class="text-sm">{{$text}}</span>
    </li>
@endif
