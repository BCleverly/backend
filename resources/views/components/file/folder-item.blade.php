@props([
    'hideFolderIcon' => 'false',
    'route' => '',
])
<li class="list-disc">
    <a href="{{ $route }}" class="block">
        @if($hideFolderIcon === false)
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
        @endif
        <span class="text-gray-900 font-medium hover:text-gray-600">{{ $slot }}</span>
    </a>
</li>