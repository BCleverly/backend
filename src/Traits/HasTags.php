<?php

namespace BCleverly\Backend\Traits;

use BCleverly\Backend\Models\Tag;
use Spatie\Tags\HasTags as BaseHasTags;

trait HasTags
{
    use BaseHasTags;

    public static function getTagClassName(): string
    {
        return Tag::class;
    }
}
