<?php

namespace BCleverly\Backend;

use BCleverly\Backend\Commands\InstallCountriesCommand;
use BCleverly\Backend\Models\Page;
use BCleverly\Backend\Observers\PageObserver;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BackendServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('backend')
            ->hasConfigFile()
            ->hasViews()
            ->hasRoute('routes')
            ->hasMigrations([
                'create_meta_tags_table',
                'create_pages_table',
                'create_tags_table',
            ])
            ->hasAssets()
            ->hasCommands([
                InstallCountriesCommand::class,
            ]);
    }

    public function bootingPackage()
    {
        Page::observe(PageObserver::class);
//        Blade::componentNamespace('BCleverly\\Views\\Components', 'backend');
    }
}
