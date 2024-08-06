@props(['text', 'logo', 'link'])

<a href="{{$link}}" method="GET" class="property-type-query" style="width: 178px;">
    <div class="flex flex-col justify-center items-center">
        <img src="{{$logo}}" alt="photo" class="property-type-image">
        <!-- Change width to be 120px on smaller screens and bigger on desktop -->
        <span class="text-lg text-black">{{$text}}</span>
    </div>
</a>
