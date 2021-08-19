<div {{ $attributes->merge([
    'class' => ''
]) }} x-data="collapsable" :class="{'mb-4': !open}">
    <button type="button" @click="toggle" class="text-sm text-indigo-500 flex items-center">
        <span class="mr-1">{{ $label }}</span>
        <div class="inline-block w-4 h-4 relative transition ease-in-out duration-150 origin-center" :class="{'rotate-90':open}">
            <svg class="absolute origin-center transition ease-in-out w-4 h-4" :class="{'opacity-0' : open}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <svg class="absolute origin-center transition ease-in-out w-4 h-4 opacity-0 transform rotate-90" :class="{'opacity-100' : open}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
    </button>
    <div x-show="open">
        {{ $slot }}
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('collapsable', () => ({
            open: false,
            toggle() {
                this.open = !this.open
            },
        }))
    });
</script>