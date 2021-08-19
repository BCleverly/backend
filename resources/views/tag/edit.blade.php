<x:backend::layouts.app header="{{ __('Editing') . ' ' . $tag->name }}">
    <x-slot name="headerButtons">

    </x-slot>

    <x:backend::form method="post" action="{{ route('dashboard.tag.update', [$tag]) }}">
        @method('patch')
        <x:backend::form.text name="name" :model="$tag"/>
        <x:backend::form.hidden name="id" :model="$tag"/>

        <x-slot name="buttons">
            <x:backend::button.primary>
                {{ __('Save') }}
            </x:backend::button.primary>
        </x-slot>

    </x:backend::form>
</x:backend::layouts.app>