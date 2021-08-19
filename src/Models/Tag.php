<?php

namespace BCleverly\Backend\Models;

class Tag extends \Spatie\Tags\Tag
{
    protected $fillable = ['name', 'type'];
}