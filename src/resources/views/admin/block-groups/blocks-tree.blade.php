@extends("admin.layout")

@section("page-title", "Блоки - ".config("site-blocks.sitePackageName")." - ")

@section('header-title')
    @empty($group)
        Блоки
    @else
        Блоки  - {{ $group->title }}
    @endempty
@endsection
@section('admin')
    @isset($group)
        @include("site-blocks::admin.block-groups.includes.pills")
    @endisset
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <universal-priority
                        :elements="{{ json_encode($groups) }}"
                        url="{{ route("admin.vue.priority", ["table" => "blocks", "field" => "priority"]) }}"
                >

                </universal-priority>
            </div>
        </div>
    </div>
@endsection