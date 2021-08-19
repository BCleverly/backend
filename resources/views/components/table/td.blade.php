@props([
])
<td {{ $attributes->merge([
        'scope' => 'col',
        'class' => 'px-6 py-4 whitespace-nowrap text-sm text-gray-500'
    ]) }}>
    {{ $slot }}
</td>