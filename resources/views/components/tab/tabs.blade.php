@props([
'active',
'containerClasses' => '',
'tabsContainerClasses' => ''
])
<div
        {{ $attributes->merge(['class' => ' ' . $containerClasses]) }}
        x-data="{
        'activeTab': '{{ $active }}',
        tabs: [],
        tabHeadings: [],
        toggleTabs() {
            this.tabs.forEach(
                tab => tab.__x.$data.showIfActive(this.activeTab)
            );
        }
    }"
        x-init="() => {
        tabs = [...$refs.tabs.children];
        tabHeadings = tabs.map(tab => tab.__x.$data.name);
        toggleTabs();
    }">
    <div class="border-b flex">
        <div class="flex-1">
            <template x-for="(tab, index) in tabHeadings" x-key="index" class="">
                <a href="#"
                   :class="tab === activeTab ? 'text-blue-500 border-blue-500' : ''"
                   class="inline-block p-4 mr-2 border-b-2 border-gray-100 hover:text-blue-500  hover:border-blue-500"
                   x-text="tab"
                   x-on:click.prevent="activeTab = tab; toggleTabs();"
                ></a>
            </template>
        </div>
        @isset($tabButtons)
            <div class="p-2 flex justify-center">
                {{ $tabButtons }}
            </div>
        @endisset
    </div>
    <div x-cloak x-ref="tabs" class="{{ $tabsContainerClasses }}">
        {{ $slot }}
    </div>
</div>