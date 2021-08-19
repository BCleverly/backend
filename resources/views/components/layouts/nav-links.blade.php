<x:backend::layouts.nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard.index')">
    {{ __('Dashboard') }}
</x:backend::layouts.nav-link>

<div x-data="pageTypeDropdown" class="text-white">
    <button @click="toggle" class="w-full bg-gray-900 text-white group flex justify items-center px-2 py-2 text-sm font-medium rounded-md">
        <svg class="{{ ($active ?? false) ? 'text-gray-400 group-hover:text-gray-300' : 'text-gray-300' }} mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
             aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/>
        </svg>
        <span class="flex justify-between w-full">
            Pages
            <svg class="transform-gpu transition-all duration-150 ease-in-out w-6 h-6" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
      </span>
    </button>
    <ul x-cloak x-show="open" class="mt-2">
        @foreach($pageTypes as $pageType)
            <li class="mb-2">
                <a class="ml-10 px-1 py-2 font-medium text-sm block" href="{{ route('dashboard.page.type.index', $pageType->type) }}">{{ \Illuminate\Support\Str::ucfirst($pageType->type) }}</a>
            </li>
        @endforeach
    </ul>
</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('pageTypeDropdown', () => ({
            open: false,

            toggle() {
                this.open = !this.open
            },
        }))
    })
</script>

{{--<x:backend::layouts.nav-link :href="route('dashboard.files.index')" :active="request()->routeIs('dashboard.file.*')">--}}
{{--    {{ __('Files') }}--}}
{{--</x:backend::layouts.nav-link>--}}

<x:backend::layouts.nav-link :href="route('dashboard.tag.index')" :active="request()->routeIs('dashboard.tag.*')">
    {{ __('Tags') }}
</x:backend::layouts.nav-link>