<?php

namespace Notabenedev\SiteBlocks\Listeners;

use App\Block;
use Illuminate\Support\Facades\Cache;

use PortedCheese\BaseSettings\Events\PriorityUpdate;

class BlockGroupsPriorityClearCache
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PriorityUpdate $event)
    {
        if ($event->table == "blocks") {
            $ids = $event->ids;
            if (! empty($ids)) {
                $blocks = Block::query()->whereIn("id", $ids)->get();
                foreach ($blocks as $block){
                    $block->forgetCache();
                    $group = $block->blockGroup;
                    $group->forgetCache();
                }
            }
        }
    }
}
