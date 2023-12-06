<?php

namespace Notabenedev\SiteBlocks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Notabenedev\SiteBlocks\Events\BlockGroupUpdate;
use PortedCheese\BaseSettings\Traits\ShouldImage;
use PortedCheese\BaseSettings\Traits\ShouldSlug;

class Block extends Model
{
    use HasFactory;
    use ShouldSlug, ShouldImage;

    protected $fillable = [
        "title",
        "slug",
        "short",
        "description"
    ];

    protected $imageKey = "main_image";

    protected static function booting() {

        parent::booting();

        static::creating(function (\App\Block $model) {
            // Забыть кэш.
            if (! empty($model->blockGroup)){
                $model->blockGroup->forgetCache();
                event(new BlockGroupUpdate($model->blockGroup, "updating"));
            }
        });

        static::updating(function (\App\Block $model) {
            // Забыть кэш.
            $model->forgetCache();
            if (! empty($model->blockGroup)){
                $model->blockGroup->forgetCache();
                event(new BlockGroupUpdate($model->blockGroup, "updating"));
            }
        });

        static::deleting(function (\App\Block $model) {
            // Забыть кэш.
            $model->forgetCache();
            if (! empty($model->blockGroup)){
                $model->blockGroup->forgetCache();
            }
        });
    }

    /**
     * Группа блока
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blockGroup(){
        return $this->belongsTo(\App\BlockGroup::class);
    }

    /**
     * Изменить дату создания.
     *
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return datehelper()->changeTz($value);
    }


    /**
     * Получить тизер
     *
     * @return string
     * @throws \Throwable
     */
    public function getTeaser($template, $first)
    {
        $key = "block-teaser:{$this->id}-{teaser-$template}";
        $model = $this;
        $block = Cache::rememberForever($key, function () use ($model) {
            $image = $model->image;
            return $model;
        });

        $view = view("site-blocks::site.blocks.teaser-$template", [
            'block' => $block,
            'first' =>$first,
        ]);
        return $view->render();
    }


    /**
     * Очистить кэш.
     */
    public function forgetCache()
    {
        $templates = ["accordion", "about", "step", "vacancy", "benefit", "digit", "tab", "alert"];
        foreach ($templates as $template) {
            Cache::forget("block-teaser:{$this->id}-{teaser-$template}");
        }
    }

    /**
     * Обновить отделы.
     *
     * @param $userInput
     */
    public function updateGroup($userInput)
    {
        $groupId = null;
        foreach ($userInput as $key => $value) {
            if (strstr($key, "check-") == false) {
                continue;
            }
            $groupId = $value;
        }
        $this->block_group_id = $groupId;
        $this->save();
        $this->forgetCache();
        $this->blockGroup->forgetCache();
    }
}
