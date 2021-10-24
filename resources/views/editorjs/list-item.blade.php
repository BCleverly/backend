<li>
    {{ $item->content }}
    @if(count($item->items) > 0)
        @include('backend::editorjs.list', [
            'items' => $item->items,
            'style' => $item->style
        ])
    @endif
</li>
