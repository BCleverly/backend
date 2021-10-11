@props([
    'name',
    'label',
    'model' => '',
    'prefix',
    'suffix',
    'model',
    'hideLabel' => false
])

<div {{ $attributes->merge([
    'class' => 'mb-4'
]) }}>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 {{ $hideLabel ? 'sr-only': '' }}">
        {{ $label ?? \Illuminate\Support\Str::ucfirst($name) }}
    </label>
    <div class="mt-1 flex rounded-md shadow-sm">
        @isset($prefix)
            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            {{ $prefix }}
        </span>
        @endisset
        <input
                value="{{ old((string)$name, $model->{$name} ?? '') }}"
                type="email" name="{{ $name }}" id="{{ $name }}" autocomplete="{{ $name }}"
                class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 {{isset($prefix) === false ? 'rounded-l-md' : ''}} {{isset($suffix) === false ? 'rounded-r-md' : ''}} sm:text-sm border-gray-300">
        @isset($suffix)
            <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            {{ $suffix }}
        </span>
        @endisset
    </div>
    <x:backend::form.error-message :name="(string)$name"></x:backend::form.error-message>
</div>
