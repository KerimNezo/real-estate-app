@props(['text', 'logo', 'link'])

<a href="{{$link}}" method="GET" class="property-type-query" style="width: 178px;">
    <div class="flex flex-col justify-center items-center">
        <img src="{{$logo}}" alt="photo" class="w-[125px]">
        <span class="text-lg text-black">{{$text}}</span>
    </div>
</a>
