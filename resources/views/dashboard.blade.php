<x:backend::layouts.app header="Dashboard" >
    <div class="grid grid-cols-2">
        <div class="col-span-2 md:col-span-1">
            <x:backend::feed heading="Recent page changes">
                @foreach($pages as $key => $page)
                <x:backend::feed.item
                        :title="$page->author->name"
                        message="Updated page {{ $page->name }}"
                        :time="$page->updated_at->diffForHumans()"
                />
                @endforeach
            </x:backend::feed>
        </div>
    </div>
</x:backend::layouts.app>
