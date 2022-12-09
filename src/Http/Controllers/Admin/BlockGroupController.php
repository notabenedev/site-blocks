<?php

namespace Notabenedev\SiteBlocks\Http\Controllers\Admin;

use App\BlockGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlockGroupController extends Controller
{

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

        $collection = BlockGroup::query()
            ->orderBy("title","asc");
        $groups = $collection->get();

        return view("site-blocks::admin.block-groups.index", compact("groups"));
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
