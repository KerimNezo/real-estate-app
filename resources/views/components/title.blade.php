@props(['text', 'position'])

@if ($position == 'left')
    <h1 class="py-3 text-3xl pl-[10%] text-black">{{$text}}</h1>
    <hr class="w-[100px] h-1 border-[0px] bg-black ml-[10%] rounded-[5px]">
@else
    <h1 class="py-3 text-3xl text-center text-black">{{$text}}</h1>
    <hr class="mx-auto w-[100px] h-1 border-[0px] bg-black rounded-[5px]" >
@endif

