<?php

namespace Notabenedev\SiteBlocks\Http\Controllers\Admin;

use App\Block;
use App\BlockGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlockController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->authorizeResource(Block::class, "block");
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

        $groups = BlockGroup::query()
            ->orderBy("block_groupable_type")
            ->orderBy("title","asc")
            ->get()
        ;

        $blocks = Block::query();

        if ( $query->get("group")) {
            $group = BlockGroup::query()
                ->where("slug","=", $query->get("group"))
                ->first();
            if ($group)
                $blocks = $group->blocks();
        }
        $pager = config("site-blocks.adminPager", 20);

        if ($query->get('title')) {
            $title = trim($query->get('title'));
            $blocks->where('title', 'LIKE', "%$title%");
        }
        $blocks->orderBy('created_at', 'desc');
        return view("site-blocks::admin.blocks.index", [
            'blocksList' => $blocks->paginate($pager)->appends($request->input()),
            'query' => $query,
            'groups' => $groups,
            'per' => $pager,
            'page' => $query->get('page', 1) - 1
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view("site-blocks::admin.blocks.create");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createToGroup(BlockGroup $group)
    {
        return view("site-blocks::admin.blocks.create", ["group" => $group] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->storeValidator($request->all());

        $group = $this->getGroup($request->all());
        if (! empty($group)) {
            $block = $group->blocks()->create($request->all());
            $block->uploadImage($request, "blocks/main", "image");
            $max = \App\Block::query()
                ->where("block_group_id", $group->id)
                ->max("priority");
            $block->priority = $max + 1;
            $group->forgetCache();
        }
        else{
            $block = Block::create($request->all());
            $block->uploadImage($request, "blocks/main");
        }
        $block->save();

        return redirect()
            ->route("admin.blocks.show", ['block' => $block])
            ->with('success', 'Успешно создано');
    }


    /**
     * Валидация сохранения.
     *
     * @param $data
     */
    protected function storeValidator($data)
    {
        Validator::make($data, [
            "title" => ["required", "min:2", "max:100"],
            "slug" => ["nullable", "min:2", "max:100", "unique:blocks,slug"],
            "image" => ["nullable", "image"],
        ], [], [
            "title" => "Заголовок",
            "slug" => "Адресная строка",
            "image" => "Главное изображение",
        ])->validate();
    }

    /**
     * Display the specified resource.
     *
     * @param Block $block
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Block $block)
    {
        return view("site-blocks::admin.blocks.show", [
            'block' => $block,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Block $block
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     */
    public function edit(Block $block)
    {
        $group = null;
        if (! empty($block->blockGroup)){
            $group = $block->blockGroup;
            if (empty($group->blockGroupable))
                $group = null;
        }
        return view("site-blocks::admin.blocks.edit", [
            'block' => $block,
            'group' => $group,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Block $block
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function update(Request $request, Block $block)
    {
        $this->updateValidator($request->all(), $block);

        $group = $this->getGroup($request->all());
        $groupOrigin = $block->blockGroup;

        // set new group
        $block->update($request->all());
        $block->uploadImage($request, "blocks/main");
        $block->updateGroup($request->all());
        $block->save();

        //clear groups cache
        $group->forgetCache();
        $groupOrigin->forgetCache();

        return redirect()
            ->route('admin.blocks.show', ['block' => $block])
            ->with('success', 'Успешно обновлено');
    }

    /**
     * Валидация обновления.
     *
     * @param $data
     * @param Block $block
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function updateValidator($data, Block $block)
    {
        $id = $block->id;
        Validator::make($data, [
            "title" => ["required", "min:2", "max:100"],
            "slug" => ["nullable", "min:2", "max:100", "unique:blocks,slug,{$id}"],
            "image" => ["nullable", "image"],
        ], [], [
            'title' => "Заголовок",
            "slug" => "Адресная строка",
            'main_image' => 'Главное изображение',
        ])->validate();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Block $block
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Block $block)
    {
        $group = $block->blockGroup;
        $block->delete();

        if($request->get("redirect") && $request->get("redirect") == "group")
            return redirect()
                ->route("admin.blocks.groups.show", ["group" => $group])
                ->with('success', 'Успешно удалено');
        else
        return redirect()
            ->back()
            ->with('success', 'Успешно удалено');
    }


    /**
     * Удалить главное изображение.
     *
     * @param Block $block
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function deleteImage(Block $block)
    {
        $this->authorize("update", $block);
        $block->clearImage();
        return redirect()
            ->back()
            ->with('success', 'Изображение удалено');
    }

    /**
     *
     * @param BlockGroup $group
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function tree(BlockGroup $group)
    {
        $this->authorize("update", Block::class);
        $collection = $group->blocks()->orderBy("priority")->get();
        $groups = [];
        foreach ($collection as $item) {
            $groups[] = [
                "name" => $item->title,
                "id" => $item->id,
            ];
        }
        return view ("site-blocks::admin.block-groups.blocks-tree", ["groups" => $groups, "group" => $group]);
    }

    /**
     * Get group from Input
     *
     * @param $userInput
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    protected function getGroup($userInput){
        $groupId = null;
        foreach ($userInput as $key => $value) {
            if (strstr($key, "check-") == false) {
                continue;
            }
            $groupId = $value;
        }
        try{
            $group = BlockGroup::query()->findOrFail($groupId);
            return $group;
        }
        catch (\Exception $exception){
            return null;
        }

    }
}
