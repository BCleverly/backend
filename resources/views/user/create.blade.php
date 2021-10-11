<x:backend::layouts.app header="{{ __('Create user') }}">
    <x-slot name="headerButtons">
        <a href="{{ route('dashboard.user.create') }}">Create</a>
    </x-slot>
    <x:backend::form action="{{ route('dashboard.user.store') }}" method="post">
        <x:backend::form.text name="name"/>
        <x:backend::form.email name="email"/>
        <x:backend::form.password name="password"/>
        <x:backend::form.password name="password_confirmation"/>

        <x-slot name="buttons">
            <x:backend::button.primary type="submit" name="saveAction" value="saveClose">
               {{ __('Save') }}
            </x:backend::button.primary>
         </x-slot>
    </x:backend::table>
</x:backend::layouts.app>