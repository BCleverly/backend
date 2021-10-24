@php
/* @var $style string */
$tag = match($style) {'ordered' => 'ol', 'unordered' => 'ul'};
/* @var $items array */
foreach($items as $item) {
    $item->style = $style;
}
@endphp
<{{ $tag }}>
    @each('backend::editorjs.list-item', $items, 'item')
</{{ $tag }}>
