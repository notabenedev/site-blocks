<?php

namespace Notabenedev\SiteBlocks\Http\Controllers\Admin;

use App\Block;
use App\BlockGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlockController extends Controller
{

    const PAGER = 20;

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
        $blocks = Block::query();

        if ($query->get('title')) {
            $title = trim($query->get('title'));
            $blocks->where('title', 'LIKE', "%$title%");
        }
        $blocks->orderBy('created_at', 'desc');
        return view("site-blocks::admin.blocks.index", [
            'blocksList' => $blocks->paginate(self::PAGER)->appends($request->input()),
            'query' => $query,
            'per' => self::PAGER,
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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->storeValidator($request->all());
        $block = Block::create($request->all());
        $block->uploadImage($request, "blocks/main");
        $block->updateGroup($request->all(), true);
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
            "title" => ["required", "min:2", "max:100", "unique:blocks,title"],
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
        return view("site-blocks::admin.blocks.edit", [
            'block' => $block,
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
        $block->update($request->all());
        $block->uploadImage($request, "blocks/main");
        $block->updateGroup($request->all(), true);

        return redirect()
            ->route('admin.blocks.show', ['block' => $block])
            ->with('success', 'Успешно обновленно');
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
            "title" => ["required", "min:2", "max:100", "unique:blocks,title,{$id}"],
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
    public function destroy(Block $block)
    {
        $block->delete();
        return redirect()
            ->route("admin.blocks.index")
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
}
