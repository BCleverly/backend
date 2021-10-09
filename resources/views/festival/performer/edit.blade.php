<x:backend::layouts.app header="{{ __('Edit performer') }}">
    <x:backend::form method="post" action="{{ route('dashboard.festival.performer.update', $performer) }}">
        @method('patch')
        <x:backend::form.text name="name" placeholder="Performer name" :model="$performer"/>

        <x:backend::form.editorjs name="body" label="" :model="$performer"/>

        <x-slot name="sidebar">
            @foreach($performer->getMedia('heroImage') as $media)
                <img src="{{ $performer->getUrl('thumb') }}" alt="">
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