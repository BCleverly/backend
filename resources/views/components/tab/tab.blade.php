@props(['name'])
<div x-data="{
    'name': '{{ $name }}',
    'show': false,
    showIfActive(active) {
        this.show = (this.name === active)
    }
    }" x-show="show"
        {{ $attributes->merge([
        'class' => ''
    ]) }}>
    {{ $slot }}
</div>