@props([
'name',
'label',
'model' => '',
'model',
'uploadUrl' => ''
])

<div {{ $attributes->merge([
    'class' => 'mb-4'
]) }}>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label ?? \Illuminate\Support\Str::ucfirst($name) }}
    </label>
    <div class="mt-1 flex rounded-md shadow-sm">
        <textarea
                data-upload="{{ $uploadUrl }}?_token={{ csrf_token() }}&command=QuickUpload&responseType=json"
                name="{{ $name }}" id="{{ $name }}"
                rows="3" class="hidden">{{ old((string)$name, $model->{$name} ?? '') }}</textarea>
        <div class="ckeditor"></div>
    </div>
    <x:backend::form.error-message :name="(string)$name"></x:backend::form.error-message>
</div>
