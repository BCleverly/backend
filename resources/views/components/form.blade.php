@props([
    'sidebar',
])

<form {{ $attributes->merge([
    'class' => 'space-y-8'
]) }}>
    @csrf
    <div class="mt-6 flex flex-wrap gap-4">
        <div class="flex-1">
            {{ $slot }}
        </div>
        @isset($sidebar)
            <div class="sm:max-w-[300px]">
                {{ $sidebar }}
            </div>
        @endisset
    </div>

    @isset($buttons)
        <div class="pt-5">
            <div class="flex justify-end">
               {{ $buttons }}
            </div>
        </div>
    @endisset

</form>