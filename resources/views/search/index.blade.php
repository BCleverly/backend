<x:backend::layouts.app header="Search results for {{ request('query') }}">
    @foreach($results as $key => $result)
        {{ dump($result) }}
    @endforeach
    {{ $results->links() }}
</x:backend::layouts.app>

