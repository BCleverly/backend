@props(['active', 'icon'])

@php
    $classes = ($active ?? false)
                ? 'bg-gray-900 text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md'
                : 'text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md';
@endphp

<a {{ $attributes->merge([
    'class' => $classes
]) }}>
    @if(isset($icon))
    @else
        <svg class="{{ ($active ?? false) ? 'text-gray-400 group-hover:text-gray-300' : 'text-gray-300' }} mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
    @endif

    {{ $slot }}
</a>