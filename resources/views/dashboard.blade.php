<x:backend::layouts.app header="Dashboard" >
    <div class="grid grid-cols-2 gap-4">
        <div class="col-span-2 md:col-span-1">
            <x:backend::feed heading="Recent page changes">
                @foreach($pages as $key => $page)
                <x:backend::feed.item
                        :title="$page->name"
                        message="Updated page {{ $page->author->name }}"
                        :time="$page->updated_at->diffForHumans()"
                />
                @endforeach
            </x:backend::feed>
        </div>
        <div class="col-span-2 md:col-span-1">
            <x:backend::feed heading="Recent performer changes">
                @foreach($performers as $key => $performer)
                    <x:backend::feed.item
                            :title="$performer->name"
                            :time="$performer->updated_at->diffForHumans()"
                    />
                @endforeach
            </x:backend::feed>
        </div>
    </div>
</x:backend::layouts.app>
