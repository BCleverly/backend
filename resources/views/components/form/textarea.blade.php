@props([
    'name',
    'label',
    'model'
])

<div {{ $attributes->merge([
    'class' => 'mb-4'
]) }}>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label ?? \Illuminate\Support\Str::ucfirst($name) }}
    </label>
    <div class="mt-1 flex rounded-md shadow-sm">
        <textarea
                name="{{ $name }}" id="{{ $name }}"
                rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md">{{ old((string)$name, $model->{$name} ?? '') }}</textarea>
    </div>
    <x:backend::form.error-message :name="(string)$name"></x:backend::form.error-message>
</div>
