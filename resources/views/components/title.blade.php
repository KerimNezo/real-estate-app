@props(['text', 'position'])

@if ($position == 'left')
    <h1 class="py-3 text-3xl pl-[10%] text-teal-900">{{$text}}</h1>
    <hr class="w-[100px] h-1 border-[0px] bg-teal-900 ml-[10%] rounded-[5px]">
@else
    <h1 class="py-3 text-3xl text-center text-teal-900">{{$text}}</h1>
    <hr class="mx-auto w-[100px] h-1 border-[0px] bg-teal-900 rounded-[5px]" >
@endif

