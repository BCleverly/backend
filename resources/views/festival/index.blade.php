<x:backend::layouts.app header="{{ __('Festivals') }}">
    <div class="flex">
        <div class="w-1/2">
            <h2 class="underline font-semibold">Days</h2>
            @foreach($days as $day)
                <div>
                    <p><a href="{{ route('dashboard.festival.day', $day) }}">{{ $day->name }}</a></p>
                </div>
            @endforeach
            <div>
                <p><a href="{{ route('dashboard.festival.day.create') }}">Create</a></p>
            </div>
        </div>
        <div class="w-1/2">
            <h2 class="underline font-semibold">Performers</h2>
            @foreach($performers as $performer)
                <div>
                    <p><a href="">{{ $performer->name }}</a></p>
                </div>
            @endforeach
            <div>
                <p><a href="{{ route('dashboard.festival.performer.index') }}">View all</a></p>
                <p><a href="{{ route('dashboard.festival.performer.create') }}">Create</a></p>
            </div>
        </div>
    </div>
</x:backend::layouts.app>