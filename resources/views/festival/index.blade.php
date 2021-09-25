<x:backend::layouts.app header="{{ __('Festivals') }}">
    <div>
        @foreach($days as $day)
            <div>
                {{ $day }}
            </div>
        @endforeach
    </div>
    <div>
        @foreach($stages as $stage)
            <div>
                {{ $stage }}
            </div>
        @endforeach
    </div>
    <div>
        @foreach($performers as $performer)
            <div>
                {{ $performer }}
            </div>
        @endforeach
    </div>
</x:backend::layouts.app>