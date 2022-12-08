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

        static::deleting(function (\App\Block $model) {
            $model->blockable()->sync([]);
        });
        static::deleted(function (\App\Block $model) {
            // Забыть кэш.
            $model->forgetCache();
        });
    }

    public function group(){
        return $this->belongsTo(App\BlockGroup::class,"block_group_id");
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

}
