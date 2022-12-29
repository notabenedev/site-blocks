<?php

namespace Notabenedev\SiteBlocks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Notabenedev\SiteBlocks\Events\BlockGroupUpdate;
use PortedCheese\BaseSettings\Traits\ShouldSlug;

class BlockGroup extends Model
{
    use HasFactory;
    use ShouldSlug;

    protected $fillable = [
        "title",
        "slug",
        "template",
        "block_groupable_type",
        "block_groupable_id",
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
            event(new BlockGroupUpdate($model, "updated"));
        });

        static::deleting(function (\App\BlockGroup $model) {
            $model->blockGroupable()->sync([]);
            foreach ($model->blocks as $block){
                $block->delete();
            }
            // Забыть кэш.
            $model->forgetCache();
            event(new BlockGroupUpdate($model, "deleting"));
        });
    }

    /**
     * Группа блоков может относится к любому материалу.
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function blockGroupable() {
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
     * Найти имя модели по классу в конфиге.
     *
     * @param $model
     * @return bool
     */
    public static function getBlockGroupModelName($model)
    {
        $modelName = false;
        foreach (config('site-blocks.models') as $name => $class) {
            if (
                $class == $model &&
                class_exists($class)
            ) {
                $modelName = $name;
                break;
            }
        }
        return $modelName;
    }

    /**
     * Get no models groups
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getFree(){
        $query = self::query();
        return $query
            ->whereNull("block_groupable_type")
            ->whereNull("block_groupable_id")
            ->orderBy("title")
            ->get();
    }

    /**
     * Prepare for vue
     *
     * @param $model
     * @param $id
     * @return array
     */
    public static function prepareForModel($model, $id){
        $object = self::getBlockGroupModel($model, $id);
        if (! empty($object)) {
            $collection = $object->blockGroups()->orderBy("priority")->get();
        }
        $blockGroups = [];
        foreach ($collection as $item) {
            $blockGroups[] = [
                "title" => $item->title,
                "slug" => $item->slug,
                "template" => $item->template,
                "priority" => $item->priority,
                "id" => $item->id,
                "showBlocksUrl" => route("admin.blocks.groups.show", ["group" => $item]),
                'titleChanged' => $item->title,
                'titleInput' => false,
                "titleUrl" => route("admin.vue.blocks.groups.title", [
                    "model" => $model,
                    'id' => $id,
                    'group' => $item->id,
                ]),
                'delete' => route('admin.vue.blocks.groups.delete', [
                    "model" => $model,
                    'id' => $id,
                    'group' => $item->id,
                ]),
            ];
        }
        return $blockGroups;
    }
}
