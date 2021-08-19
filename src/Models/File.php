<?php

namespace BCleverly\Backend\Models;

use BCleverly\Backend\Database\Factories\FileFactory;
use BCleverly\Backend\Traits\{HasTags};
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsTo, SoftDeletes, Builder};
use OwenIt\Auditing\Auditable;

class File extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasFactory, SoftDeletes, Auditable, HasTags;

    protected $fillable = [
        'name',
        'description',
        'path',
    ];

    protected $with = ['tags'];

    protected static function newFactory(): FileFactory
    {
        return FileFactory::new();
    }
}
