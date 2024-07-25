@props(['property'])

<ul class="flex justify-center items-center gap-2">
    <x-card-footer-attribute :var="$property->surface" imagePath="./photos/icons/square.svg" text="{{$property->surface}}" />

    <x-card-footer-attribute :var="$property->garage" imagePath="./photos/icons/garage.svg" text="{{$property->garage}}" />

    <x-card-footer-attribute :var="$property->floors" imagePath="./photos/icons/floor.svg" text="{{$property->floors}}" />

    <x-card-footer-attribute :var="$property->keycard_entry" imagePath="./photos/icons/kartica.svg" text="" />
</ul>
