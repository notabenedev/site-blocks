<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\SiteBlocks\Admin\BlockController;
Route::group([
    'namespace' => 'App\Http\Controllers\Vendor\SiteBlocks\Admin',
    'middleware' => ['web', 'management'],
    'as' => 'admin.',
    'prefix' => 'admin',
], function () {

    Route::group([
        "prefix" =>  "blocks",
        "as" => "blocks.",
    ],function (){
        Route::get("/", [BlockController::class, "index"])->name("index");
        Route::get("/create", [BlockController::class, "create"])->name("create");
        Route::get("/create-to/{group}", [BlockController::class, "createToGroup"])->name("createToGroup");
        Route::post("", [BlockController::class, "store"])->name("store");
        Route::get("/{block}", [BlockController::class, "show"])->name("show");
        Route::get("/{block}/edit", [BlockController::class, "edit"])->name("edit");
        Route::put("/{block}", [BlockController::class, "update"])->name("update");
        Route::delete("/{block}", [BlockController::class, "destroy"])->name("destroy");
    });

    // Изменить вес
    Route::put("blocks/tree/priority", [BlockController::class,"changeItemsPriority"])
        ->name("blocks.item-priority");

    Route::group([
        'prefix' => 'blocks/{block}',
        'as' => 'blocks.show.',
    ], function () {
        Route::delete('delete-image', 'BlockController@deleteImage')
            ->name('delete-image');
    });

});