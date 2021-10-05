<x:backend::layouts.app header="{{ __('Festivals') }}">
    <div class="flex">
        <div class="w-1/3">
            <h2 class="underline font-semibold">Days</h2>
            @foreach($days as $day)
                <div>
                    <p><a href="{{ route('dashboard.festival.day', $day) }}">{{ $day->name }}</a></p>
                </div>
            @endforeach
        </div>
        <div class="w-1/3">
            <h2 class="underline font-semibold">Stages</h2>
            @foreach($stages as $stage)
                <div>
                    <p><a href="">{{ $stage->name }}</a></p>
                </div>
            @endforeach
        </div>
        <div class="w-1/3">
            <h2 class="underline font-semibold">Performers</h2>
            @foreach($performers as $performer)
                <div>
                    <p><a href="">{{ $performer->name }}</a></p>
                </div>
            @endforeach
        </div>
    </div>
</x:backend::layouts.app>