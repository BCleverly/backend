@props([
    'title',
    'type',
    'description',
    'url'
])
<div class="border-b mb-4 grid grid-cols-1 lg:grid-cols-12 gap-4 py-3 px-2">
    <div class="w-full col-span-1 p-1">
        <img src="https://via.placeholder.com/150" alt="">
    </div>
    <div class="col-span-11">
        <h2 class="font-bold"><a href="{{ $url }}">{{ $title }}</a></h2>
        @isset($description)
            <p class="">{{ $description }}</p>
        @endisset
        <p class="mt-1"><small>Type: {{ $type }}</small></p>
    </div>
</div>