<x:backend::layouts.app header="{{ __('Page types') }}">
    <x-slot name="headerButtons">
        <x:backend::button.link :href="route('dashboard.page.create')">
            {{ __('Create') }}
        </x:backend::button.link>
    </x-slot>
    <x:backend::table>
        <x-slot name="headers">
            <x:backend::table.tr>
                <x:backend::table.th name="Type"/>
                <x:backend::table.th class="text-right" name="Actions"/>
            </x:backend::table.tr>
        </x-slot>
        @foreach($types as $key => $type)
            <x:backend::table.tr>
                <x:backend::table.td>
                    {{ $type->type }}
                </x:backend::table.td>
                <x:backend::table.td class="flex justify-end items-center gap-4">
                    <a href="{{ route('dashboard.page.type.index', $type->type) }}">View posts</a>
                </x:backend::table.td>
            </x:backend::table.tr>
        @endforeach
    </x:backend::table>
</x:backend::layouts.app>