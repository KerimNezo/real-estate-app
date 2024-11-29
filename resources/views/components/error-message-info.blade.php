@props(['title' => 'null', 'titleVar' => ''])

@if ($title === 'null')
    @error($titleVar)
    <div class="absolute text-red-500 -translate-y-1/2 top-1/2 right-4 group">
        <div class="flex items-center justify-center w-6 h-6 border-2 border-red-500 rounded-full cursor-pointer">
            i
        </div>
        <!-- Tooltip on Hover -->
        <div class="absolute right-0 hidden px-2 py-1 mb-2 text-sm text-white bg-gray-900 border-gray-900 rounded-lg opacity-75 w-60 border-3 bottom-full group-hover:block">
            {{ $message }}
        </div>
    </div>
    @enderror
@else
    @error($title)
    <div class="absolute text-red-500 -translate-y-1/2 top-1/2 right-4 group">
        <div class="flex items-center justify-center w-6 h-6 border-2 border-red-500 rounded-full cursor-pointer">
            i
        </div>
        <!-- Tooltip on Hover -->
        <div class="absolute right-0 hidden px-2 py-1 mb-2 text-sm text-white bg-gray-900 border-gray-900 rounded-lg opacity-75 w-60 border-3 bottom-full group-hover:block">
            {{ $message }}
        </div>
    </div>
    @enderror
@endif
