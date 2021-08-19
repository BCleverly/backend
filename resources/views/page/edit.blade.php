<x:backend::layouts.app header="Editing {{ $page->name }}" >
   <x:backend::form method="post" action="{{ route('dashboard.page.update', $page) }}" enctype="multipart/form-data">
      @method('patch')
      <x:backend::form.hidden name="id" :model="$page"/>
      <x:backend::form.text name="name" :model="$page"/>
      <x:backend::form.text name="slug" :model="$page"/>
      <x:backend::collapse label="Excerpt">
         <x:backend::form.textarea name="excerpt" label="" :model="$page"/>
      </x:backend::collapse>

      <x:backend::form.textarea name="body" :model="$page" uploadUrl="{{ route('dashboard.page.media.upload', $page) }}"/>

      <x:backend::dividers.divider>
         Meta information
      </x:backend::dividers.divider>

      <x:backend::form.text name="meta[title]" label="Meta Title" :model="$page->metaTag"/>
      <x:backend::form.textarea name="meta[description]" label="Meta Description" :model="$page->metaTag"/>
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
                                 :items="$tags" itemsKey="item" itemsKeyProp="name" itemsValueProp="name" multiple/>

         <x:backend::form.datetime name="publish_at" label="Publish" :model="$page"/>
         <x:backend::form.datetime name="un_publish_at" label="Un publish" :model="$page"/>

         @foreach($page->getMedia('heroImage') as $media)
            <img src="{{ $media->getUrl('thumb') }}" alt="">
         @endforeach

         <x:backend::form.file name="heroImage" multiple/>


      </x-slot>

      <x-slot name="buttons">
         <x:backend::button.primary>
            {{ __('Save') }}
         </x:backend::button.primary>
      </x-slot>
   </x:backend::form>
</x:backend::layouts.app>