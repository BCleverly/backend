@props([
    'name' => '',
    'label',
    'items' => [],
    'multiple',
    'selected' => [],
    'default' => '',
])
<div {{ $attributes->merge([
    'class' => 'mb-4'
]) }}>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label ?? \Illuminate\Support\Str::ucfirst($name) }}
    </label>
    <select {{ isset($multiple) === true ? 'multiple' : '' }} id="{{ $name }}" name="{{ $name }}{{ isset($multiple) ? '[]' : '' }}" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
        @isset($default)
            <option value="">{{ $default }}</option>
        @endisset
        @foreach($items as $key => $item)
            <option {{ in_array($item['value'], $selected, true) ? 'selected' : '' }}
                    value="{{ $item['value'] }}">
                {{ $item['text'] }}
            </option>
        @endforeach
    </select>
    <x:backend::form.error-message :name="(string)$name"></x:backend::form.error-message>
</div>