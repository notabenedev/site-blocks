<?php

namespace Notabenedev\SiteBlocks\Listeners;

use App\Block;

class ClearCacheOnUpdateImage
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
    public function handle($event)
    {
        $morph = $event->morph;
        if (!empty($morph) && get_class($morph) == Block::class) {
            $morph->forgetCache();
        }
    }
}
