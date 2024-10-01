@props(['floor', 'garden'])

@php
    $garden === 0 ? $garden = "No" : $garden = "Yes";
@endphp

<div class="flex items-left justify-left">
    <x-property-detail icon='maki-garden' title="Garden" :text="$garden" unit="" css='w-[40px] h-[40px]' />

    <x-property-detail icon='gameicon-family-house' title="Floors" :text="$floor" unit="" css='w-[40px] h-[40px]' />
</div>
