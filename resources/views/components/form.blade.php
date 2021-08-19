@props([
    'sidebar',
])

<form {{ $attributes->merge([
    'class' => 'space-y-8'
]) }}>
    @csrf
    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
        <div class="{{ isset($sidebar) ? 'sm:col-span-4' : 'sm:col-span-6' }}">
            {{ $slot }}
        </div>
        @isset($sidebar)
            <div class="sm:col-span-2">
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