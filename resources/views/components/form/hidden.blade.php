@props([
    'name',
    'model' => '',
    'model'
])

<div {{ $attributes->merge([
    'class' => ''
]) }}>
        <input
                value="{{ old((string)$name, $model->{$name} ?? '') }}"
                type="hidden" name="{{ $name }}" id="{{ $name }}">
</div>
