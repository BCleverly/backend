<x:backend::layouts.app header="{{ __('Tags') }}">
    <x-slot name="headerButtons">
        <a href="{{ route('dashboard.tag.create') }}">Create</a>
    </x-slot>
    <x:backend::table>
        <x-slot name="headers">
            <x:backend::table.tr>
                <x:backend::table.th :name="__('Type')"/>
                <x:backend::table.th class="text-right" :name="__('Actions')"/>
            </x:backend::table.tr>
        </x-slot>
        @foreach($tags as $key => $tag)

            <x:backend::table.tr>
                <x:backend::table.td>
                    <a href="{{ route('dashboard.tag.type.index', $tag->type) }}">
                        {{ $tag->type }}
                    </a>
                </x:backend::table.td>
                <x:backend::table.td class="text-right">
                    actions
                </x:backend::table.td>
            </x:backend::table.tr>
        @endforeach
    </x:backend::table>
</x:backend::layouts.app>