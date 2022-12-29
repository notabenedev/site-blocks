<?php

namespace Notabenedev\SiteBlocks\Events;

use App\BlockGroup;
use Illuminate\Queue\SerializesModels;

class BlockGroupUpdate
{
    use SerializesModels;

    public $blockGroup;
    public $morph;
    public $action;

    /**
     * Create a new event instance.
     *
     * ImageUpdate constructor.
     * @param BlockGroup $blockGroup
     * @param string $action
     */
    public function __construct(BlockGroup $blockGroup, string $action = "undefined")
    {
        $this->blockGroup = $blockGroup;
        $this->morph = $blockGroup->blockGroupable;
        $this->action = $action;
    }
}
