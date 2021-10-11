<?php

use BCleverly\Backend\Actions\Festival\Day\CreateDay;
use BCleverly\Backend\Actions\Festival\Day\ManageDay;
use BCleverly\Backend\Actions\Festival\Day\StoreDay;
use BCleverly\Backend\Actions\Festival\Performer\CreatePerformer;
use BCleverly\Backend\Actions\Festival\Performer\DeletePerformer;
use BCleverly\Backend\Actions\Festival\Performer\ListPerformers;
use BCleverly\Backend\Actions\Festival\ManageFestival;
use BCleverly\Backend\Actions\Page\CreatePage;
use BCleverly\Backend\Actions\Page\DeletePage;
use BCleverly\Backend\Actions\Page\EditPage;
use BCleverly\Backend\Actions\Page\ListPages;
use BCleverly\Backend\Actions\Page\ListPageTypes;
use BCleverly\Backend\Actions\Page\StorePage;
use BCleverly\Backend\Actions\Page\UpdatePage;
use BCleverly\Backend\Actions\Page\UploadPageMedia;
use BCleverly\Backend\Actions\ShowDashboard;
use BCleverly\Backend\Actions\Tag\CreateTag;
use BCleverly\Backend\Actions\Tag\DeleteTag;
use BCleverly\Backend\Actions\Tag\EditTag;
use BCleverly\Backend\Actions\Tag\ListTagByType;
use BCleverly\Backend\Actions\Tag\ListTags;
use BCleverly\Backend\Actions\Tag\StoreTag;
use BCleverly\Backend\Actions\Tag\StoreTagByType;
use BCleverly\Backend\Actions\Tag\UpdateTag;
use Illuminate\Support\Facades\Route;

Route::get('/', ShowDashboard::class)->name('index');

Route::get('/search', \BCleverly\Backend\Actions\Search::class)->name('search');

Route::group([
    'as'     => 'file.',
    'prefix' => 'file',
], function () {
    Route::post('upload', \BCleverly\Backend\Actions\File\UploadFiles::class)->name('upload');
});

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

    Route::post('type', StoreTagByType::class)->name('type.store');
});

Route::group([
    'as'     => 'page.',
    'prefix' => 'page',
], function () {
    Route::get('/', ListPageTypes::class)->name('index');
    Route::post('/', StorePage::class)->name('store');
    Route::get('create', CreatePage::class)->name('create');
    Route::get('{page}/edit', EditPage::class)->name('edit');
    Route::patch('{page}/edit', UpdatePage::class)->name('update');
    Route::post('{page}/media/upload', UploadPageMedia::class)->name('media.upload');
    Route::delete('{page}', DeletePage::class)->name('delete');

    Route::get('{type}', ListPages::class)->name('type.index');
});

Route::group([
    'as'     => 'festival.',
    'prefix' => 'festival',
], function () {
    Route::get('/', ManageFestival::class)->name('dashboard');

    Route::group([
        'as'     => 'performer.',
        'prefix' => 'performer',
    ], function () {
        Route::get('/', ListPerformers::class)->name('index');
        Route::get('/create', CreatePerformer::class)->name('create');
        Route::get('/{performer}/edit', \BCleverly\Backend\Actions\Festival\Performer\EditPerformer::class)->name('edit');
        Route::patch('/{performer}', \BCleverly\Backend\Actions\Festival\Performer\UpdatePerformer::class)->name('update');
        Route::delete('/{performer}', DeletePerformer::class)->name('delete');
    });

    Route::get('day/create', CreateDay::class)->name('day.create');
    Route::post('day', StoreDay::class)->name('day.store');
    Route::get('day/{day}', ManageDay::class)->name('day');

    Route::post('day/{day}/performer', \BCleverly\Backend\Actions\Festival\Day\AddPerformer::class)->name('day.add-performer');

    Route::patch('day/{day}/performer/{performer}', \BCleverly\Backend\Actions\Festival\Day\UpdatePerformer::class)->name('day.update-performer');

    Route::delete('day/{day}/performer/{performer}', \BCleverly\Backend\Actions\Festival\Day\RemovePerformer::class)->name('day.remove-performer');
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
