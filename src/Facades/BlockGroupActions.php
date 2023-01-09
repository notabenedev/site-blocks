<?php

namespace Notabenedev\SiteBlocks\Facades;

use Illuminate\Support\Facades\Facade;
use Notabenedev\SiteBlocks\Helpers\BlockGroupActionsManager;

/**
 *
 * Class BlockGroupActions
 * @package Notabenedev\SiteBlocks\Facades
 *
 *
 */
class BlockGroupActions extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "block-group-actions";
    }
}