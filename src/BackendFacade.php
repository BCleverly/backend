<?php

namespace BCleverly\Backend;

use Illuminate\Support\Facades\Facade;

/**
 * @see \BCleverly\Backend\Backend
 */
class BackendFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'backend';
    }
}
