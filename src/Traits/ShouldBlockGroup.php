<?php

namespace Notabenedev\SiteBlocks\Traits;

use App\BlockGroup;
use Illuminate\Http\Request;

trait ShouldBlockGroup
{
    protected static function bootShouldBlockGroup()
    {
        static::deleting(function($model) {
             // Чистим группы
            $model->clearBlockGroups();
        });
    }

    /**
     * Группы блоков.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function blockGroups() {
        return $this->morphMany(BlockGroup::class, 'block_groupable');
    }


    /**
     * Удалить все группы.
     */
    public function clearBlockGroups()
    {
        foreach ($this->blockGroups()->get() as $blockGroup) {
            $blockGroup->delete();
        }
    }
}