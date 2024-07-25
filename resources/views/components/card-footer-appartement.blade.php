@props(['property'])

<ul class="flex justify-center items-center gap-2">
    <x-card-footer-attribute :var="$property->bedrooms" imagePath="./photos/icons/bedroom.svg" text="{{$property->bedrooms}}" />

    <x-card-footer-attribute :var="$property->surface" imagePath="./photos/icons/square.svg" text="{{$property->surface}}" />

    <x-card-footer-attribute :var="$property->toilets" imagePath="./photos/icons/bathroom.svg" text="{{$property->toilets}}" />

    <x-card-footer-attribute :var="$property->garage" imagePath="./photos/icons/garage.svg" text="" />

    <x-card-footer-attribute :var="$property->furnished" imagePath="./photos/icons/furnished.svg" text="" />
</ul>
