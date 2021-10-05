<x:backend::layouts.app header="{{ __('Edit performer') }}">
    <x:backend::form method="post" action="{{ route('dashboard.festival.performer.update', $performer) }}">
        @method('patch')
        <x:backend::form.text name="name" placeholder="Performer name" :model="$performer"/>

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