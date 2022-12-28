@extends("admin.layout")

@section("page-title", "{$group->title} - ". config("site-blocks.sitePackageName"))

@section('header-title', "{$group->title} - Группы блоков")

@section('admin')
    @include("site-blocks::admin.block-groups.includes.pills", ["group" => $group])
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Заголовок</dt>
                    <dd class="col-sm-9">{{ $group->title }}</dd>
                    <dt class="col-sm-3">Адрес</dt>
                    <dd class="col-sm-9">{{ $group->slug }}</dd>
                    <dt class="col-sm-3">Шаблон</dt>
                    <dd class="col-sm-9">{{ $group->template }}</dd>
                    @if(! empty($modelName = \App\BlockGroup::getBlockGroupModelName($group->block_groupable_type)))
                        <dt class="col-sm-3">Объект:</dt>
                        <dd class="col-sm-9">
                            <a href="{{ route("admin.$modelName.show", ["page" => $group->blockGroupable]) }}">
                                {{ $group->blockGroupable->title }}
                            </a>
                        </dd>
                    @endif
                </dl>
            </div>
        </div>
    </div>

    @if (count($group->blocks))
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h5>Блоки</h5>
                    <a href="{{ route("admin.blocks.groups.blocks-tree", ["group" => $group]) }}">Блоки - Приоритет</a>
                </div>
                @include("site-blocks::admin.blocks.includes.table-list", ["blocksList" => $group->blocks])
            </div>
        </div>
    @endif



@endsection