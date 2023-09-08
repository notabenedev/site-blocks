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
     * Группы блоков Шаблона.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function blockGroupsByTemplate(string $template) {
        return $this->morphMany(BlockGroup::class, 'block_groupable')
            ->where("template","=", $template)->orderBy("priority");
    }

    /**
     * Группы блоков Не из Шаблонов.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function blockGroupsNotInTemplates(array $templates) {
        return $this->morphMany(BlockGroup::class, 'block_groupable')
            ->whereNotIn("template", $templates)->orderBy("priority");
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