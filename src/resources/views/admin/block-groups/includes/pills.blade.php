@if (! empty($group))
{{--    @include("site-blocks::admin.block-groups.includes.breadcrumb")--}}
@endif
<div class="col-12 mb-2">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills">
                @can("viewAny", \App\BlockGroup::class)
                    <li class="nav-item">
                        <a href="{{ route("admin.blocks.groups.index") }}"
                           class="nav-link{{ isset($isTree) && !$isTree ? " active" : "" }}">
                            Группы блоков
                        </a>
                    </li>
                @endcan

                @if(! empty($group))
                    @can("create", \App\StaffDepartment::class)
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('admin.blocks.create') }}">
                                    Добавить блок
                                </a>
                            </li>
                    @endcan

                    @can("view", $group)
                        <li class="nav-item">
                            <a href="{{ route("admin.blocks.groups.show", ["group" => $group]) }}"
                               class="nav-link{{ $currentRoute === "admin.blocks.groups.show" ? " active" : "" }}">
                                Просмотр
                            </a>
                        </li>
                    @endcan
                    @can("update", \App\Block::class)
                        <li class="nav-item">
                            <a href="{{ route("admin.blocks.groups.blocks-tree", ["group" => $group]) }}"
                               class="nav-link{{ $currentRoute === "admin.blocks.groups.blocks-tree" ? " active" : "" }}">
                                Приоритет блоков в группе
                            </a>
                        </li>
                    @endcan
                @endif
            </ul>
        </div>
    </div>
</div>