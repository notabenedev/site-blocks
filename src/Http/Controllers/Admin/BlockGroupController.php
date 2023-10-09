<?php

namespace Notabenedev\SiteBlocks\Http\Controllers\Admin;

use App\BlockGroup;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Notabenedev\SiteBlocks\Events\BlockGroupUpdate;

class BlockGroupController extends Controller
{

    const PAGER = 20;

    public function __construct()
    {
        parent::__construct();
        $this->authorizeResource(BlockGroup::class, "group");
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     */
    public function index(Request $request)
    {
        $query = $request->query;
        $pager = config("site-blocks.adminPager", 20);

        $collection = BlockGroup::query()
            ->orderBy("title","asc");

        if ($title = $request->get("title", false)) {
            $collection->where("title", "like", "%$title%");
        }
        if ($morph = $request->get("morph", "no")) {
            if ($morph == "no") {
                $collection->whereNull("block_groupable_type");
            }
            else {
                $collection->whereNotNull("block_groupable_type");
            }
        }
        $groups = $collection->paginate($pager)->appends($request->input());
        $per = $pager;
        $page = $query->get('page', 1) - 1;

        return view("site-blocks::admin.block-groups.index", compact("groups","request", "per","page"));
    }

    /**
     * Display the specified resource.
     *
     * @param BlockGroup $group
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(BlockGroup $group)
    {
        // blocks
        $collection = $group->blocks()->orderBy("priority")->get();
        $blocks = [];
        foreach ($collection as $item) {
            $blocks[] = [
                "name" => $item->title,
                "id" => $item->id,
            ];
        }

        return view("site-blocks::admin.block-groups.show", [
            "group" => $group,
            "blocks" => $blocks
        ] );
    }

    /**
     * groups for model
     *
     * @param $model
     * @param $model_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function model($model, $model_id)
    {
        $object = BlockGroup::getBlockGroupModel($model, $model_id);
        $groups = $object->blockGroups()->get();
        return view("site-blocks::admin.block-groups.model", compact("groups", "object", "model"));
    }

    /**
     * Get groups to component
     *
     * @param $model
     * @param $id
     * @return array
     *
     */
    public function get($model, $id)
    {
        $blockGroups = BlockGroup::prepareForModel($model, $id);

        if ($blockGroups) {
            return [
                'success' => TRUE,
                'blockGroups' => $blockGroups,
            ];
        }
        else {
            return [
                'success' => FALSE,
                'message' => 'Model not found',
            ];
        }
    }


    /**
     * Изменить имя.
     *
     * @param Request $request
     * @param $model
     * @param $id
     * @param $group
     * @return array
     */
    public function title(Request $request, $model, $id, $group)
    {
        if (! $request->has("changed")) {
            return [
                'success' => FALSE,
                'message' => "Вес не найден",
            ];
        }
        if (! BlockGroup::getBlockGroupModel($model, $id)) {
            return [
                'success' => FALSE,
                'message' => 'Model not found',
            ];
        }
        try {
            $groupObject = BlockGroup::query()
                ->where("id", $group)
                ->firstOrFail();
        } catch (\Exception $e) {
            return [
                'success' => FALSE,
                'message' => 'Group not found',
            ];
        }
        $groupObject->title = $request->get('changed');
        $groupObject->save();
        return [
            'success' => TRUE,
            'blockGroups' => BlockGroup::prepareForModel($model, $id),
        ];
    }

    /**
     * Пробуем сохранить.
     *
     * @param Request $request
     * @param $model
     * @param $id
     * @return array
     */
    public function post(Request $request, $model, $id) {
        $modelClass = BlockGroup::getBlockGroupModel($model, $id);
        if (! $modelClass) {
            return [
                'success' => FALSE,
                'message' => 'Model not found',
            ];
        }

        if (! $request->has('template')) {
            return [
                'success' => FALSE,
                'message' => 'Template not found',
            ];
        }

        $template = $request->get("template");

        if (empty($template) || $template == 'undefined'){
            return [
                'success' => FALSE,
                'message' => 'Template is not set',
            ];
        }

        $title = $request->get("title");

        if (empty($title) || $title == 'undefined'){
            $title = "$modelClass->title: $model".substr($template,strripos($template,"."));
        }

        $blockGroup = BlockGroup::create([
            'title' => $title,
            'template' => $template,
        ]);
        $modelClass->blockGroups()->save($blockGroup);

        event(new BlockGroupUpdate($blockGroup, "created"));
        return [
            'success' => TRUE,
            'blockGroups' => BlockGroup::prepareForModel($model, $id),
        ];
    }

    /**
     * Пробуем удалить.
     *
     * @param $model
     * @param $id
     * @param $group
     * @return array
     */
    public function delete($model, $id, $group) {
        if ( BlockGroup::getBlockGroupModel($model, $id)) {
            try {
                $groupObject = BlockGroup::findOrFail($group);
            } catch (\Exception $e) {
                return [
                    'success' => FALSE,
                    'message' => 'Group not found',
                ];
            }
            $groupObject->delete();
            return [
                'success' => TRUE,
                'blockGroups' => BlockGroup::prepareForModel($model, $id),
            ];
        }
        else {
            return [
                'success' => FALSE,
                'message' => 'Model not found',
            ];
        }
    }

    /**
     * Порядок групп.
     *
     * @param Request $request
     * @param $model
     * @param $id
     * @return array
     */
    public function updateOrder(Request $request, $model, $id)
    {
        Validator::make($request->all(), [
            'blockGroups' => ['required', 'array'],
        ])->validate();

        $modelClass = BlockGroup::getBlockGroupModel($model, $id);
        if (! $modelClass) {
            return [
                'success' => FALSE,
                'message' => 'Model not found',
            ];
        }

        $ids = $request->get("blockGroups");
        foreach ($ids as $priority => $idBlock) {
            try {
                $blockGroup = BlockGroup::find($idBlock);
                $blockGroup->priority = $priority;
                $blockGroup->save();
            }
            catch (\Exception $exception) {
                continue;
            }
        }
        return [
            'success' => TRUE,
            'blockGroups' => BlockGroup::prepareForModel($model, $id),
        ];
    }
}
