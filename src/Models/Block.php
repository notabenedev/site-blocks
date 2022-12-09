<?php

namespace Notabenedev\SiteBlocks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
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
        static::created(function (\App\Block $model){
            // Забыть кэш.
            $model->forgetCache();
        });

        static::updated(function (\App\Block $model) {
            // Забыть кэш.
            $model->forgetCache();
        });

        static::deleted(function (\App\Block $model) {
            // Забыть кэш.
            $model->forgetCache();
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
    public function getTeaser($grid = 4)
    {
        $key = "block-teaser:{$this->id}-{$grid}";
        $model = $this;
        $block = Cache::rememberForever($key, function () use ($model) {
            $image = $model->image;
            $group = $model->group;
            return $model;
        });

        $view = view("site-blocks::site.blocks.teaser", [
            'block' => $block,
            'grid' => $grid,
        ]);
        return $view->render();
    }


    /**
     * Очистить кэш.
     */
    public function forgetCache($full = FALSE)
    {
        if (!$full) {
            Cache::forget("block-teaser:{$this->id}-3");
            Cache::forget("block-teaser:{$this->id}-4");
            Cache::forget("block-teaser:{$this->id}-6");
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
    }

}
