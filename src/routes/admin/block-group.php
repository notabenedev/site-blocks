<?php
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Vendor\SiteBlocks\Admin\BlockGroupController;
use \App\Http\Controllers\Vendor\SiteBlocks\Admin\BlockController;

Route::group([
    "middleware" => ["web", "management"],
    "as" => "admin.blocks.",
    "prefix" => "admin/blocks",
], function () {
    Route::group([
        "prefix" => "groups",
        "as" => "groups.",
    ],function (){
        //blocks tree
        Route::get("/{group}/blocks-tree", [BlockController::class, "tree"])
            ->name("blocks-tree");

        Route::get("/", [BlockGroupController::class, "index"])->name("index");
        Route::get("/{group}", [BlockGroupController::class, "show"])->name("show");
    });
}
);
