@props(['text', 'logo', 'link'])

<a href="{{$link}}" method="GET" class="property-type-query hover:bg-teal-800" style="width: 178px;">
    <div class="flex flex-col items-center justify-center">
        <img src="{{asset($logo)}}" alt="photo" class="property-type-image">
        <!-- Change width to be 120px on smaller screens and bigger on desktop -->
        <span class="text-lg text-gray-300">{{$text}}</span>
    </div>
</a>
