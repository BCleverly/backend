<x:backend::layouts.app header="{{ __('Tags') }}">
    <x-slot name="headerButtons">

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
                    {{ $tag->name }}
                </x:backend::table.td>
                <x:backend::table.td class="text-right flex justify-end gap-4 items-center">
                    <form action="{{ route('dashboard.tag.delete', $tag) }}" method="post">
                        @csrf
                        @method('delete')
                        <x:backend::button.primary>Delete</x:backend::button.primary>
                    </form>
                    <a href="{{ route('dashboard.tag.edit', [$tag]) }}">
                        Edit
                    </a>
                </x:backend::table.td>
            </x:backend::table.tr>
        @endforeach
    </x:backend::table>
</x:backend::layouts.app>