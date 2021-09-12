<?php


use BCleverly\Backend\Actions\ShowDashboard;
use BCleverly\Backend\Actions\Tag\{CreateTag, DeleteTag, EditTag, ListTagByType, ListTags, StoreTag, StoreTagByType, UpdateTag};
use BCleverly\Backend\Actions\Page\{CreatePage, DeletePage, EditPage, ListPages, ListPageTypes, StorePage, UpdatePage, UploadPageMedia};
use BCleverly\Backend\Actions\Festival\{CreateFestival, DeleteFestival, EditFestival, ListFestivals, StoreFestival, UpdateFestival, UploadFestivalMedia};
use BCleverly\Backend\Actions\Festival\Performer\{CreatePerformer, DeletePerformer, ListPerformers};

Route::group([
    'middleware' => [
        'web',
        'auth',
    ],
    'as'         => 'dashboard.',
    'prefix'     => 'dashboard',
], function () {

    Route::get('/', ShowDashboard::class)->name('index');

    Route::get('/search', \BCleverly\Backend\Actions\Search::class)->name('search');

    Route::group([
        'as'     => 'tag.',
        'prefix' => 'tag',
    ], function () {
        Route::get('/', ListTags::class)->name('index');
        Route::get('type/create', CreateTag::class)->name('create');
        Route::get('{tag}/edit', EditTag::class)->name('edit');
        Route::patch('{tag}', UpdateTag::class)->name('update');
        Route::post('create', StoreTag::class)->name('store');
        Route::delete('{tag}', DeleteTag::class)->name('delete');

        Route::get('type/{tagType}', ListTagByType::class)->name('type.index');
        Route::get('type/{tagType}/edit', ListTagByType::class)->name('type.edit');

        Route::post('/type', StoreTagByType::class)->name('type.store');
    });

    Route::group([
        'as'     => 'page.',
        'prefix' => 'page',
    ], function () {
        Route::get('/', ListPageTypes::class)->name('index');
        Route::post('/', StorePage::class)->name('store');
        Route::get('/create', CreatePage::class)->name('create');
        Route::get('/{page}/edit', EditPage::class)->name('edit');
        Route::patch('/{page}/edit', UpdatePage::class)->name('update');
        Route::post('/{page}/media/upload', UploadPageMedia::class)->name('media.upload');
        Route::delete('/{page}', DeletePage::class)->name('delete');

        Route::get('/{type}', ListPages::class)->name('type.index');
    });

    Route::group([
        'as'     => 'festival.',
        'prefix' => 'festival',
    ], function () {
        Route::get('/', ListFestivals::class)->name('index');
        Route::post('/', StoreFestival::class)->name('store');
        Route::get('/create', CreateFestival::class)->name('create');
        Route::get('/{festival}/edit', EditFestival::class)->name('edit');
        Route::patch('/{festival}', UpdateFestival::class)->name('update');
        Route::delete('/{festival}', DeleteFestival::class)->name('delete');
        Route::post('/{festival}/media/upload', UploadFestivalMedia::class)->name('media.upload');

        Route::group([
            'as'     => 'performer.',
            'prefix' => 'performer',
        ], function () {
            Route::get('/', ListPerformers::class)->name('index');
            Route::get('/create', CreatePerformer::class)->name('create');
            Route::get('/{performer}/edit', DeletePerformer::class)->name('edit');
            Route::patch('/{performer}', DeletePerformer::class)->name('update');
            Route::delete('/{performer}', DeletePerformer::class)->name('delete');
        });
    });

//    Route::group([
//        'as'     => 'files.',
//        'prefix' => 'files',
//    ], function () {
//        Route::get('{path?}', ShowDirectory::class)->where('path', '(.*)')->name('index');
//        Route::post('add-folder', CreateDirectory::class)->name('folder');
//    });

//    Route::group([
//        'as'     => 'store.',
//        'prefix' => 'store',
//    ], function () {
//        Route::get('/', StoreDashboard::class)->name('index');
//        Route::group([
//            'as'     => 'product.',
//            'prefix' => 'product',
//        ], function () {
//            Route::get('/', ListProducts::class)->name('index');
//            Route::post('/', StoreProduct::class)->name('store');
//            Route::get('create', CreateProduct::class)->name('create');
//            Route::get('{product}/edit', EditProduct::class)->name('edit');
//            Route::patch('{product}/edit', UpdateProduct::class)->name('update');
//        });
//    });
});
