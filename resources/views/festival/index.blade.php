<x:backend::layouts.app header="{{ __('Festivals') }}">
    <x-slot name="headerButtons">
        <x:backend::button.link :href="route('dashboard.festival.performer.index')">
            {{ __('Performers') }}
        </x:backend::button.link>
        <x:backend::button.link :href="route('dashboard.festival.create')">
            {{ __('Create') }}
        </x:backend::button.link>
    </x-slot>
    <x:backend::table>
        <x-slot name="headers">
            <x:backend::table.tr>
                <x:backend::table.th name="Name"/>

                <x:backend::table.th class="text-right" name="Actions"/>
            </x:backend::table.tr>
        </x-slot>
        @foreach($festivals as $key => $festival)
            <x:backend::table.tr>
                <x:backend::table.td>
                    {{ $festival->name }}
                </x:backend::table.td>
                <x:backend::table.td class="flex justify-end items-center gap-4">
                    <form method="post" action="{{ route('dashboard.festival.delete', [$festival]) }}">
                        @csrf
                        @method('delete')
                        <x:backend::button.primary>Delete</x:backend::button.primary>
                    </form>
                    <a href="{{ route('dashboard.festival.edit', [$festival]) }}">Edit</a>
                </x:backend::table.td>
            </x:backend::table.tr>
        @endforeach
    </x:backend::table>
    {{ $festivals->links() }}
</x:backend::layouts.app>