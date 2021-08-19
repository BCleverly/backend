<?php

namespace BCleverly\Backend\Traits;

trait HasAverageReadingTime
{
    public string $modelContentAttribute = 'body';

    public function getAverageReadAttribute(): string
    {
        $word = str_word_count(strip_tags($this->attributes[$this->modelContentAttribute]));
        $m = floor($word / 200);
        $s = floor($word % 200 / (200 / 60));
        return $m . ' minute' . ($m == 1 ? '' : 's') . ', ' . $s . ' second' . ($s == 1 ? '' : 's');
    }
}