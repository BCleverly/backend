@props([
    'icon',
    'route' => '',
])
<li class="list-disc">
    <a href="{{ $route }}" class="block">
        {{ $slot }}
    </a>
</li>