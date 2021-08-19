<x:backend::layouts.app header="{{ __('Creating') }}">
    <x-slot name="headerButtons">

    </x-slot>

    <x:backend::form method="post" action="{{ route('dashboard.tag.store') }}">
        <x:backend::form.text name="name"/>
        <x:backend::form.data-list name="type" :items="$tagTypes"/>

        <x-slot name="buttons">
            <x:backend::button.primary>
                {{ __('Save') }}
            </x:backend::button.primary>
        </x-slot>

    </x:backend::form>
</x:backend::layouts.app>