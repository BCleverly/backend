<x:backend::layouts.app header="{{ __('Files') }}">
    <x-slot name="headerButtons">
        <form action="{{ route('dashboard.files.folder') }}" method="post">
            @csrf
            <input type="hidden" name="path" value="{{ $path }}">
            <x:backend::form.text name="name" hideLabel="true"/>
            <x:backend::button.primary>Add folder</x:backend::button.primary>
        </form>
    </x-slot>

    <x:backend::file.list>
        @if(empty($path) === false)
           <x:backend::file.folder-item :hideFolderIcon="true" route="{{ route('dashboard.files.index', substr($path, 0, strrpos( $path, '/'))) }}">
               ..
           </x:backend::file.folder-item>
        @endif
        @foreach($directories as $item)
            <x:backend::file.folder-item route="{{ route('dashboard.files.index', $item) }}">
                {{ \Illuminate\Support\Str::remove($path . '/',$item) }}
            </x:backend::file.folder-item>
        @endforeach
        @foreach($files as $item)
            <x:backend::file.item route="{{ route('dashboard.files.index', $item) }}" :download="true" type="file">
                <x-slot name="icon">
                    ext
                </x-slot>
                {{ \Illuminate\Support\Str::remove($path . '/',$item) }}
            </x:backend::file.item>
        @endforeach
    </x:backend::file.list>
</x:backend::layouts.app>