<?php

namespace Notabenedev\SiteBlocks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use PortedCheese\BaseSettings\Traits\ShouldSlug;

class BlockGroup extends Model
{
    use HasFactory;
    use ShouldSlug;

    protected $fillable = [
        "title",
        "slug",
        "template"
    ];

    protected $imageKey = "main_image";

    protected static function booting() {

        parent::booting();
        static::created(function (\App\BlockGroup $model){
            // Забыть кэш.
            $model->forgetCache();
        });

        static::updating(function (\App\BlockGroup $model) {
            // Забыть кэш.
            $model->forgetCache();
        });

        static::deleting(function (\App\BlockGroup $model) {
            $model->blockable()->sync([]);
            // Забыть кэш.
            $model->forgetCache();
        });
    }

    /**
     * Группа блоков может относится к любому материалу.
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function blockable() {
        return $this->morphTo();
    }

    /**
     * Блоки группы
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     */
    public function blocks(){
        return $this->hasMany(\App\Block::class)->orderBy("priority");
    }

    /**
     * Model's blocks sort by priority
     *
     * @param $modelObject
     * @return mixed
     */
    public static function blockableSort($modelObject)
    {
        $collection = $modelObject->blockable->sortBy('priority');
        return $collection->get();
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
     * Получить группу
     *
     * @return string
     * @throws \Throwable
     */
    public function getBlocksCache()
    {
        $key = "block-group-blocks:{$this->id}";
        $model = $this;
        $blocks = Cache::rememberForever($key, function () use ($model) {
            return $model->blocks;
        });

        return $blocks;
    }


    /**
     * Очистить кэш.
     */
    public function forgetCache($full = FALSE)
    {
        if (!$full) {
            Cache::forget("block-group-blocks:{$this->id}");
        }

    }

    /**
     * Найти модель по имени в конфиге.
     *
     * @param $modelName
     * @param $id
     * @return bool
     */
    public static function getBlockGroupModel($modelName, $id)
    {
        $model = false;
        foreach (config('site-blocks.models') as $name => $class) {
            if (
                $name == $modelName &&
                class_exists($class)
            ) {
                try {
                    $model = $class::findOrFail($id);
                } catch (\Exception $e) {
                    return false;
                }
                break;
            }
        }
        return $model;
    }

    /**
     * Get no models groups
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getFree(){
        $query = self::query();
        return $query
            ->whereNull("blockable_type")
            ->whereNull("blockable_id")
            ->orderBy("title")
            ->get();
    }
}
