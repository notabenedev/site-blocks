@extends("admin.layout")

@section("page-title", $object->title." - Группы блоков - ".config("site-blocks.sitePackageName")." - ")

@section('header-title', $object->title." - Группы блоков")

@section('admin')
    @if(isset($model) && ($model == "pages"))
        @includeIf("site-pages::admin.pages.includes.pills", ["folder" => $object->folder, "page" => $object])
    @endif
    <div class="col-12">
        <div class="card">
    @canany(['update', "create"], \App\BlockGroup::class)
        <div class="card-body">
            <block-group-component csrf-token="{{ csrf_token() }}"
                                   put-url="{{ route('admin.vue.blocks.groups.post', ['id' => $object->id, 'model' => $model]) }}"
                                   get-url="{{ route('admin.vue.blocks.groups.get', ['id' => $object->id, 'model' => $model]) }}"
                                   order-url="{{ route('admin.vue.blocks.groups.order', ['id' => $object->id, 'model' => $model]) }}"
                                   :get-templates="{{ json_encode(config("site-blocks.templates")) }}"
                >
            </block-group-component>
        </div>
    @elsecan('view', \App\BlockGroup::class)
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    @include("site-blocks::admin.block-groups.includes.table-list", ["groups" => $groups, "model" => $model, "object" => $object])
                </div>
            </div>
        </div>
    @endcan
        </div>
    </div>
@endsection