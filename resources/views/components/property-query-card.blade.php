@props(['text', 'logo', 'link'])

<a href="{{$link}}" method="GET">
    <div class="flex flex-col justify-center items-center">
        <img src="{{$logo}}" alt="photo" class="w-[130px]">
        <span class="text-lg text-black">{{$text}}</span>
    </div>
</a>
