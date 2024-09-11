@props(['text', 'logo', 'link'])

<a href="{{$link}}" method="GET" class="property-type-query" style="width: 178px;">
    <div class="flex flex-col items-center justify-center">
        <img src="{{asset($logo)}}" alt="photo" class="property-type-image">
        <!-- Change width to be 120px on smaller screens and bigger on desktop -->
        <span class="text-lg text-black">{{$text}}</span>
    </div>
</a>
