<?php

namespace BCleverly\Backend\Traits;

use BCleverly\Backend\Models\MetaTag;

trait HasMetaTags
{
    public function metaTag()
    {
        return $this->morphOne(MetaTag::class, 'meta_taggable')->withDefault([
            'title' => '',
            'description' => '',
        ]);
    }
}
