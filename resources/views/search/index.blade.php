<x:backend::layouts.app header="Search results for {{ request('query') }}">
    @foreach($results as $key => $result)
        @includeIf('backend::search.result.' . \Str::of(get_class($result))->afterLast('\\'), ['model' => $result])
    @endforeach
    {{ $results->links() }}
</x:backend::layouts.app>

