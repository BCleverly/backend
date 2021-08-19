@props(['name'])
@error((string) $name)
    <div class="text-red-500">
        {{ $message }}
    </div>
@enderror