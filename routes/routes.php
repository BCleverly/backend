<?php

use BCleverly\Backend\Actions\File\CreateDirectory;
use BCleverly\Backend\Actions\File\ShowDirectory;
use BCleverly\Backend\Actions\ShowDashboard;
use BCleverly\Backend\Actions\Store\Product\{CreateProduct, EditProduct, ListProducts, StoreProduct, UpdateProduct};
use BCleverly\Backend\Actions\Store\StoreDashboard;
use BCleverly\Backend\Actions\Tag\{CreateTag, DeleteTag, EditTag, ListTagByType, ListTags, StoreTag, StoreTagByType, UpdateTag};
use BCleverly\Backend\Actions\Page\{CreatePage, DeletePage, EditPage, ListPages, ListTypes, StorePage, UpdatePage};

Route::group([
    'middleware' => [
        'web',
        'auth',
    ],
    'as'         => 'dashboard.',
    'prefix'     => 'dashboard',
], function () {

    Route::get('/', ShowDashboard::class)->name('index');

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
        Route::get('/', \BCleverly\Backend\Actions\Page\ListPageTypes::class)->name('index');
        Route::get('/create', CreatePage::class)->name('create');
        Route::get('/{page}/edit', EditPage::class)->name('edit');
        Route::patch('/{page}/edit', UpdatePage::class)->name('update');
        Route::post('/{page}/media/upload', \BCleverly\Backend\Actions\Page\UploadPageMedia::class)->name('media.upload');
        Route::delete('/{page}', DeletePage::class)->name('delete');
        Route::post('', StorePage::class)->name('store');
        Route::get('/{type}', ListPages::class)->name('type.index');
    });

    Route::group([
        'as'     => 'files.',
        'prefix' => 'files',
    ], function () {
        Route::get('{path?}', ShowDirectory::class)->where('path', '(.*)')->name('index');
        Route::post('add-folder', CreateDirectory::class)->name('folder');
    });

    Route::group([
        'as'     => 'store.',
        'prefix' => 'store',
    ], function () {
        Route::get('/', StoreDashboard::class)->name('index');
        Route::group([
            'as'     => 'product.',
            'prefix' => 'product',
        ], function () {
            Route::get('/', ListProducts::class)->name('index');
            Route::post('/', StoreProduct::class)->name('store');
            Route::get('create', CreateProduct::class)->name('create');
            Route::get('{product}/edit', EditProduct::class)->name('edit');
            Route::patch('{product}/edit', UpdateProduct::class)->name('update');
        });
    });
});
