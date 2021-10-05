@props([
    'heading',
])

<div class="bg-white px-4 rounded shadow mb-4">
    @isset($heading)
        <h2 class="text-xl pb-2 pt-4 font-bold underline">{{ $heading }}</h2>
    @endisset

    <ul class="divide-y divide-gray-200">
        {{ $slot }}
    </ul>
</div>