<?php

namespace BCleverly\Backend;

use BCleverly\Backend\Models\Page;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class BackendViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // TODO cache this and have an event listener destroy cache on page type addition
            $view->pageTypes = Cache::remember('dashboard:pageTypes', now()->addHour(), fn() => \DB::select('SELECT DISTINCT type from pages'));
        });
    }
}
