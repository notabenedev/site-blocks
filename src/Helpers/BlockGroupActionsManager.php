<?php

namespace Notabenedev\SiteBlocks\Helpers;

use App\BlockGroup;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class BlockGroupActionsManager
{
    /**
     * Admin breadcrumbs
     *
     * @param BlockGroup $group
     * @param bool $isBlockPage
     * @return array
     *
     */
    public function getAdminBreadcrumb(BlockGroup $group, $isBlockPage = false)
    {
        $breadcrumb = [];


        $breadcrumb[] = (object) [
                "title" => config("site-blocks.sitePackageName"),
                "url" => route("admin.blocks.groups.index"),
                "active" => false,
            ];

        $routeParams = Route::current()->parameters();
        $isBlockPage = $isBlockPage && ! empty($routeParams["block"]);
        $active = ! empty($routeParams["group"]) &&
            $routeParams["group"]->id == $group->id &&
            ! $isBlockPage;
        $breadcrumb[] = (object) [
            "title" => $group->title,
            "url" => route("admin.blocks.groups.show", ["group" => $group]),
            "active" => $active,
        ];
        if ($isBlockPage) {
            $block = $routeParams["block"];
            $breadcrumb[] = (object) [
                "title" => $block->title,
                "url" => route("admin.blocks.show", ["block" => $block]),
                "active" => true,
            ];
        }
        return $breadcrumb;
    }
}