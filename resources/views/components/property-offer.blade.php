@props(['lease'])

@if (is_null($lease))
    <div id="type" class="mb-auto mt-4 mr-auto ml-4 bg-red-600 rounded-[5px] w-[80px] h-7 text-sm font-bold flex items-center justify-center">
        <div class="align-middle">FOR SALE</div>
    </div>
@else
    <div id="type" class="mb-auto mt-4 mr-auto ml-4 bg-sky-600 rounded-[5px] w-[80px] h-7 text-sm font-bold flex items-center justify-center">
        <div class="align-middle">FOR RENT</div>
    </div>
@endif
