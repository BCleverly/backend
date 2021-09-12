<?php

namespace BCleverly\Backend;

use BCleverly\Backend\Commands\InstallBackend;
use BCleverly\Backend\Commands\InstallCountriesCommand;
use BCleverly\Backend\Models\Festival\Festival;
use BCleverly\Backend\Models\Festival\Performer;
use BCleverly\Backend\Models\Page;
use BCleverly\Backend\Observers\FestivalObserver;
use BCleverly\Backend\Observers\PageObserver;
use BCleverly\Backend\Observers\PerformerObserver;
use BCleverly\Backend\Search\Dashboard;
use Illuminate\Database\Eloquent\Relations\Relation;
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
                'create_pages_table',
                'create_meta_tags_table',
                'create_tags_table',
                'create_festival_tables',
            ])
            ->hasAssets()
            ->hasCommands([
                InstallCountriesCommand::class,
                InstallBackend::class
            ]);
    }

    public function bootingPackage()
    {
        Relation::morphMap([
            1 => Page::class,
            2 => Festival::class,
            3 => Performer::class,
        ]);

        Page::observe(PageObserver::class);
        Festival::observe(FestivalObserver::class);
        Performer::observe(PerformerObserver::class);

        Dashboard::bootSearchable();
    }
}
