@props(['floor', 'garden'])

@php
    $garden === null ? $garden = "No" : $garden = "Yes";
@endphp

<x-property-detail icon='maki-garden' title="Garden" :text="$garden" unit="" css='w-[40px] h-[40px]' />

<x-property-detail icon='gameicon-family-house' title="Floors" :text="$floor" unit="" css='w-[40px] h-[40px]' />

<!-- Empty div to push the second detail to the left, instead of this we can put other detail if we ever come up with one -->
<div class="bg-[#ededed] w-full">

</div>
