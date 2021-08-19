<?php

namespace BCleverly\Backend\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['id', 'name', 'alpha2', 'alpha3'];
}