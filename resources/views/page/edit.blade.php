<x:backend::layouts.app header="Editing {{ $page->name }}" :fullWidth="false">
   <x:backend::form method="post" action="{{ route('dashboard.page.update', $page) }}" enctype="multipart/form-data">
      @method('patch')
      <x:backend::form.hidden name="id" :model="$page"/>
      <x:backend::form.text name="name" :model="$page"/>
      <x:backend::form.text name="slug" :model="$page"/>
      <x:backend::collapse label="Excerpt">
         <x:backend::form.textarea name="excerpt" label="" :model="$page"/>
      </x:backend::collapse>

      <x:backend::form.editorjs name="body" label="" :model="$page" uploadUrl="{{ route('dashboard.page.media.upload', $page) }}"/>

      <x:backend::dividers.divider>
         Meta information
      </x:backend::dividers.divider>

      <div class="mb-4">
         <label for="metaTitle" class="block text-sm font-medium text-gray-700">
            Meta Title
         </label>
         <div class="mt-1 flex rounded-md shadow-sm">
            <input
                    value="{{ old('meta.title', $page->metaTag->title) }}"
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
                    class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 sm:text-sm border-gray-300">{{ old('meta.description', $page->metaTag->description) }}</textarea>
         </div>
      </div>

      <div>
         @if($page->metaTag->getFirstMedia('hero'))
            <img src="{{ $page->metaTag->getFirstMedia('hero')->getUrl('thumb') }}" alt="">
         @endif

         <x:backend::form.file name="meta[hero]" label="Meta Image"/>
      </div>

      <x-slot name="sidebar">
         <x:backend::form.select name="categories"
                                 :selected="$pageTags['categories'] ?? []"
                                 :items="$categories" multiple/>
         <x:backend::form.select name="tags"
                                 :selected="$pageTags['tags'] ?? []"
                                 :items="$tags" multiple/>

         <x:backend::form.select name="parent_id"
                                 :selected="isset($page->parent) ? [$page->parent->id] : []"
                                 :items="$pages"/>

         <x:backend::form.datetime name="publish_at" label="Publish" :model="$page"/>
         <x:backend::form.datetime name="un_publish_at" label="Un publish" :model="$page"/>

         @foreach($page->getMedia('heroImage') as $media)
            <img src="{{ $media->getUrl('thumb') }}" alt="">
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