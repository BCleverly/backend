<x:backend::layouts.app header="{{ __('Festivals') }}">
    <div>
        <p><a href="{{ route('dashboard.festival.day.create') }}">Create</a></p>
    </div>
    <div>
        {{ dump($day) }}
    </div>
</x:backend::layouts.app>