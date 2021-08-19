<x:backend::layouts.app header="{{ $type }}">
    <x-slot name="headerButtons">
        <x:backend::button.link :href="route('dashboard.page.create')">
            {{ __('Create') }}
        </x:backend::button.link>
    </x-slot>
    <x:backend::table>
        <x-slot name="headers">
            <x:backend::table.tr>
                <x:backend::table.th name="Name"/>
                <x:backend::table.th name="Author"/>
                <x:backend::table.th class="text-right" name="Actions"/>
            </x:backend::table.tr>
        </x-slot>
        @foreach($pages as $key => $page)
            <x:backend::table.tr>
                <x:backend::table.td>
                    {{ $page->name }}
                </x:backend::table.td>
                <x:backend::table.td>
                    {{ $page->author->name }}
                </x:backend::table.td>
                <x:backend::table.td class="flex justify-end items-center gap-4">
                    <form method="post" action="{{ route('dashboard.page.delete', [$page]) }}">
                        @csrf
                        @method('delete')
                        <x:backend::button.primary>Delete</x:backend::button.primary>
                    </form>
                    <a href="{{ route('dashboard.page.edit', [$page]) }}">Edit</a>
                </x:backend::table.td>
            </x:backend::table.tr>
        @endforeach
    </x:backend::table>
    {{ $pages->links() }}
</x:backend::layouts.app>