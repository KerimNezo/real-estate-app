@props(['elevator', 'keycard'])

@php
    $keycard_entry === null ? $keycard = "No" : $keycard = "Yes";
    $elevator === null ? $elevator = "No" : $elevator = "Yes";
@endphp

<x-property-detail icon='phosphor-elevator' title="Elevator" :text="$elevator" unit="" css='w-[40px] h-[40px]' />

<x-property-detail icon='phosphor-identification-card-light' title="Keycard entry" :text="$keycard" unit="" css='w-[40px] h-[40px]' />

<!-- Empty div to push the second detail to the left, instead of this we can put other detail if we ever come up with one -->
<div class="bg-[#ededed] w-full">

</div>
