<?php

namespace Notabenedev\SiteBlocks\Traits;

use App\BlockGroup;

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
     *  Группы блоков Шаблона.
     *
     * @param array $templates
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function blockGroupsByTemplates(array $templates) {
         return $this->blockGroups()->whereIn("template", $templates)->orderBy("priority")->get();
    }

    /**
     * Группы блоков Не из Шаблонов.
     *
     * @param array $templates
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function blockGroupsNotInTemplates(array $templates) {
        return $this->blockGroups()->whereNotIn("template", $templates)->orderBy("priority")->get();
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