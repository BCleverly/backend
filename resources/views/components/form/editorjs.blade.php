@props([
'name',
'label',
'model' => '',
'model',
'uploadUrl' => route('dashboard.file.upload')
])

<div {{ $attributes->merge([
    'class' => 'mb-4 bg-white rounded shadow'
]) }}>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label ?? \Illuminate\Support\Str::ucfirst($name) }}
    </label>
    <div class="mt-1">
        <textarea
                data-imageupload="{{ $uploadUrl }}"
                name="{{ $name }}"
                id="{{ $name }}"
                rows="3"
                class="hidden">{{ old((string)$name, $model->{$name} ?? '') }}</textarea>
        <div class="editorjs"></div>

    </div>
    <x:backend::form.error-message :name="(string)$name"></x:backend::form.error-message>
</div>
