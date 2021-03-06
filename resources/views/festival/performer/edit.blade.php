<x:backend::layouts.app header="{{ __('Edit performer') }}">
    <x:backend::form method="post" action="{{ route('dashboard.festival.performer.update', $performer) }}" enctype="multipart/form-data">
        @method('patch')
        <x:backend::form.text name="name" placeholder="Performer name" :model="$performer"/>

        <x:backend::form.editorjs name="body" label="" :model="$performer"/>

        <x:backend::dividers.divider>
            Meta information
        </x:backend::dividers.divider>

        <div class="mb-4">
            <label for="metaTitle" class="block text-sm font-medium text-gray-700">
                Meta Title
            </label>
            <div class="mt-1 flex rounded-md shadow-sm">
                <input
                        value="{{ old('meta.title', $performer->metaTag->title) }}"
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
                    class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 sm:text-sm border-gray-300">{{ old('meta.description', $performer->metaTag->description) }}</textarea>
            </div>
        </div>

        <x-slot name="sidebar">
            @foreach($performer->getMedia('heroImage') as $media)
                {{ $media }}
            @endforeach

            <x:backend::form.file name="heroImage" multiple/>
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