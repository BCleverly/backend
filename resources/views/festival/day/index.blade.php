<x:backend::layouts.app header="{{ $day->name }}">
    <div>
        <x:backend::form action="{{ route('dashboard.festival.day.add-performer', $day) }}" method="post">

            <x:backend::form.select name="performer"
                                    :items="$performers"/>

            <x:backend::form.select name="stage"
                                    :items="$stages"/>

            <div class="relative flex items-start mb-4">
                <div class="flex items-center h-5">
                    <input id="headline" name="headline" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                </div>
                <div class="ml-3 text-sm">
                    <label for="headline" class="font-medium text-gray-700">Headliner</label>
                    <p class="text-gray-500">Title says it all.</p>
                </div>
            </div>

            <x:backend::form.datetime name="time" label="Performance time"/>

            <x-slot name="buttons">
                <x:backend::button.primary type="submit" name="saveAction" value="save">
                    {{ __('Add Performer') }}
                </x:backend::button.primary>
            </x-slot>

        </x:backend::form>
        @foreach($day->performers as $stage => $performers)
            <div class="mb-6">
                <h2 class="border-b  border-gray-300 px-2 py-2 w-full block">{{ $stage }}</h2>
                <div>
                    <ul role="list" class="divide-y divide-gray-200">
                        @foreach($performers as $index => $performer)
                            <li class="py-4 flex items-center">
                                <div class="flex w-1/2">
                                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $performer->name }}</p>
                                        <p class="text-sm text-gray-500">Headliner: {{ $performer->pivot->headline ? 'Yes' : 'No' }}. Time {{ \Carbon\Carbon::createFromTimeString($performer->pivot->time)->format('H:i') }} </p>
                                    </div>
                                </div>
                                <div class="w-1/2 flex justify-end">
                                    <x:backend::collapse label="Edit">
                                        <form method="post" action="{{ route('dashboard.festival.day.update-performer', [$day, $performer])  }}">
                                            @csrf
                                            @method('patch')
                                            <div class="relative flex items-start mb-4">
                                                <div class="flex items-center h-5">
                                                    <input {{ $performer->pivot->headline ? 'checked' : '' }} id="headline" name="headline" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="headline" class="font-medium text-gray-700">Headliner</label>
                                                </div>
                                            </div>

                                            <x:backend::form.datetime name="time" label="Performance time" :model="$performer->pivot"/>

                                            <x:backend::button.primary type="submit" name="saveAction" value="save">
                                                {{ __('Update') }}
                                            </x:backend::button.primary>
                                        </form>
                                    </x:backend::collapse>
                                    <form method="post" action="{{ route('dashboard.festival.day.remove-performer', [$day, $performer])  }}">
                                        @csrf
                                        @method('delete')
                                        <x:backend::button.danger>&times;</x:backend::button.danger>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach

    </div>
</x:backend::layouts.app>