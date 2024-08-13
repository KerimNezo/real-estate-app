@props(['property'])

<ul class="flex justify-start items-start gap-3 w-full px-6">
    <x-card-footer-attribute :var="$property->surface" imagePath="./photos/icons/square.svg" :text="$property->surface" :sqr="1" />

    <x-card-footer-attribute :var="$property->garage" imagePath="./photos/icons/garage.svg" :text="$property->garage" :sqr="0"/>

    <x-card-footer-attribute :var="$property->floors" imagePath="./photos/icons/floor.svg" :text="$property->floors" :sqr="0"/>

    <x-card-footer-attribute :var="$property->keycard_entry" imagePath="./photos/icons/kartica.svg" text="" :sqr="0"/>
</ul>
