@props(['avatar', 'title' => '', 'time' => '', 'message' => ''])
<li class="py-4">
    <div class="flex space-x-3">
        @isset($avatar)
            <img class="h-6 w-6 rounded-full" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" alt="">
        @endisset
        <div class="flex-1 space-y-1">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-medium">{{ $title }}</h3>
                <p class="text-sm text-gray-500">{{ $time }}</p>
            </div>
            <p class="text-sm text-gray-500">{{ $message }}</p>
        </div>
    </div>
</li>