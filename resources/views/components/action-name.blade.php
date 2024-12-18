@props(['name' => 'action_type'])

@switch($name)
    @case('created')
        <p class="px-3 py-2 text-sm font-bold text-left bg-lime-700 rounded-xl">
            {{ strtoupper($name) }}
        </p>
        @break

    @case('sold')
        <p class="px-3 py-2 text-sm font-bold text-left bg-blue-700 rounded-xl">
            {{ strtoupper($name) }}
        </p>
        @break

    @case('rented')
        <p class="px-3 py-2 text-sm font-bold text-left bg-blue-700 rounded-xl">
            {{ strtoupper($name) }}
        </p>
        @break

    @case('deleted')
        <p class="px-3 py-2 text-sm font-bold text-left bg-red-700 rounded-xl">
            {{ strtoupper($name) }}
        </p>
        @break

    @case('edited')
        <p class="px-3 py-2 text-sm font-bold text-left bg-green-700 rounded-xl">
            {{ strtoupper($name) }}
        </p>
        @break

    @case('removed')
        <p class="px-3 py-2 text-sm font-bold text-left bg-indigo-700 rounded-xl">
            {{ strtoupper($name) }}
        </p>
        @break

    @default
        <p class="px-3 py-2 text-sm font-bold text-left bg-gray-700 rounded-xl">
            {{ strtoupper($name) }}
        </p>
@endswitch
