<x:backend::layouts.app header="{{ __('Create Festival') }}">
    {{ $errors }}
    <x:backend::form method="post" action="{{ route('dashboard.festival.update', $festival) }}" enctype="multipart/form-data">
        @method('patch')
        <x:backend::form.text name="name" :model="$festival"/>
        <x:backend::form.text name="slug" :model="$festival"/>
        <x:backend::collapse label="Description">
            <x:backend::form.textarea name="description" label="" :model="$festival"/>
        </x:backend::collapse>

        <x:backend::form.editorjs name="body" label="" uploadUrl="{{ route('dashboard.festival.media.upload', $festival) }}" :model="$festival"/>

        <x:backend::dividers.divider>
            Meta information
        </x:backend::dividers.divider>

        <div class="mb-4">
            <label for="metaTitle" class="block text-sm font-medium text-gray-700">
                Meta Title
            </label>
            <div class="mt-1 flex rounded-md shadow-sm">
                <input
                        value="{{ old('meta.title', $festival->metaTag->title) }}"
                        type="text" name="meta[title]" id="metaTitle" autocomplete="metaTitle"
                        class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 sm:text-sm border-gray-300">
            </div>
        </div>
        <div class="mb-4">
            <label for="metaDescription" class="block text-sm font-medium text-gray-700">
                Meta Description
            </label>
            <div class="mt-1 flex rounded-md shadow-sm">
            <textarea
                    type="text"
                    name="meta[description]"
                    id="metaDescription"
                    autocomplete="metaDescription"
                    class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 sm:text-sm border-gray-300">{{ old('meta.description', $festival->metaTag->description) }}</textarea>
            </div>
        </div>

        <div>
            @if($festival->metaTag->getFirstMedia('hero'))
                <img src="{{ $festival->metaTag->getFirstMedia('hero')->getUrl('thumb') }}" alt="">
            @endif

            <x:backend::form.file name="meta[hero]" label="Meta Image"/>
        </div>
        <x-slot name="sidebar">
            <x:backend::form.datetime name="publish_at" label="Publish" :model="$festival"/>
        </x-slot>

        <x-slot name="buttons">
            <x:backend::button.primary type="submit" name="saveAction" value="save">
                {{ __('Save') }}
            </x:backend::button.primary>

            <x:backend::button.primary type="submit" name="saveAction" value="saveClose">
                {{ __('Save and close') }}
            </x:backend::button.primary>
        </x-slot>
    </x:backend::form>
</x:backend::layouts.app>