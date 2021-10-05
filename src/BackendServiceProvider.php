<?php

namespace BCleverly\Backend;

use BCleverly\Backend\Commands\InstallBackend;
use BCleverly\Backend\Commands\InstallCountriesCommand;
use BCleverly\Backend\Models\Festival\FestivalDay;
use BCleverly\Backend\Models\Festival\FestivalPerformer;
use BCleverly\Backend\Models\Festival\FestivalStage;
use BCleverly\Backend\Models\Page;
use BCleverly\Backend\Observers\FestivalDayObserver;
use BCleverly\Backend\Observers\FestivalStageObserver;
use BCleverly\Backend\Observers\PageObserver;
use BCleverly\Backend\Observers\FestivalPerformerObserver;
use BCleverly\Backend\Search\Dashboard;
use BCleverly\Backend\Views\Components\ManagePerformers;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Route;
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
            2 => FestivalDay::class,
            3 => FestivalPerformer::class,
        ]);

        Page::observe(PageObserver::class);
        FestivalDay::observe(FestivalDayObserver::class);
        FestivalPerformer::observe(FestivalPerformerObserver::class);
        FestivalStage::observe(FestivalStageObserver::class);

        Dashboard::bootSearchable();

        Route::macro('dashboard', function (string $prefix = 'dashboard') {
            Route::group([
                'middleware' => [
                    'web',
                ],
                'as'         => 'dashboard.',
                'prefix'     => 'dashboard',
            ], function () {
                require_once __DIR__ . '/../routes/routes.php';
            });
        });

//        Blade::component('manage-performers', ManagePerformers::class);
    }
}
