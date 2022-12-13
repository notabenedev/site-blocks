<?php

namespace Notabenedev\SiteBlocks\Http\Controllers\Admin;

use App\BlockGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $view = $request->get("view","default");
        $query = $request->query;
        $pager = config("site-blocks.adminPager", 20);

        $collection = BlockGroup::query()
            ->orderBy("title","asc");
        $groups = $collection->paginate($pager)->appends($request->input());
        $per = $pager;
        $page = $query->get('page', 1) - 1;

        return view("site-blocks::admin.block-groups.index", compact("groups", "per","page"));
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

}
