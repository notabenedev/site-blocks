@extends("admin.layout")

@section("page-title", "Группы блоков - ".config("site-blocks.sitePackageName")." - ")

@section('header-title', "Группы блоков")

@section('admin')
    @include("site-blocks::admin.block-groups.includes.pills")
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include("site-blocks::admin.block-groups.includes.table-list", ["groups" => $groups])
            </div>
        </div>
    </div>
    @if ($groups->lastPage() > 1)
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{ $groups->links() }}
                </div>
            </div>
        </div>
    @endif
@endsection