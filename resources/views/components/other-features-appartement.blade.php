@props(['elevator', 'keycard'])

@php
    $keycard === null ? $keycard = "No" : $keycard = "Yes";
    $elevator === null ? $elevator = "No" : $elevator = "Yes";
@endphp

<div class="flex items-left justify-left">
    <x-property-detail icon='phosphor-elevator' title="Elevator" :text="$elevator" unit="" css='w-[40px] h-[40px]' />

    <x-property-detail icon='phosphor-identification-card-light' title="Keycard" :text="$keycard" unit="" css='w-[40px] h-[40px]' />
</div>
