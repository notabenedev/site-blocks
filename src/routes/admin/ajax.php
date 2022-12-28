<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => "admin/vue",
    'middleware' => ['web', 'management'],
    'namespace' => 'Notabenedev\SiteBlocks\Http\Controllers\Admin'
], function () {
    // Роуты блоков
    Route::group([
        'prefix' => "blocks",
        'as' => "admin.vue.blocks.",
    ], function () {
        // Получить
        Route::get('/{group}/{id}', 'BlockController@get')
            ->name('get');
        // Добавить
        Route::post('/{group}/{id}', 'BlockController@post')
            ->name('post');
        // Изменить порядок
        Route::put("/{group}/{id}", "BlockController@updateOrder")
            ->name("order");
        // Удаление
        Route::delete('/{group}/{id}/{block}/delete', 'BlockController@delete')
            ->name('delete');
        // Сменить имя.
        Route::post('/{group}/{id}/{block}/title', 'BlockController@title')
            ->name('title');
    });
    // Роуты групп блоков для модели.
    Route::group([
        'prefix' => "blocks/groups",
        'as' => "admin.vue.blocks.groups.",
    ], function () {
        // Получить группы.
        Route::get('/{model}/{id}', 'BlockGroupController@get')
            ->name('get');
        // Добавить группу.
        Route::post('/{model}/{id}', 'BlockGroupController@post')
            ->name('post');
        // Изменить порядок групп.
        Route::put("/{model}/{id}", "BlockGroupController@updateOrder")
            ->name("order");
        // Удаление группы.
        Route::delete('/{model}/{id}/{group}/delete', 'BlockGroupController@delete')
            ->name('delete');
        // Сменить имя группы.
        Route::post('/{model}/{id}/{group}/title', 'BlockGroupController@title')
            ->name('title');
    });
});