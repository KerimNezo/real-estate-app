@props(['var', 'imagePath', 'text', 'sqr'])


@if (is_null($var))

@else
    <li class="flex justify-center items-center gap-1">
        <img src="{{$imagePath}}" alt="" class="w-[30px] h-[30px]">
        @if ($sqr != 0)
            <span class="text-sm">{{$text}} m&sup2; </span>
        @else
            <span class="text-sm">{{$text}}</span>
        @endif

    </li>
@endif
