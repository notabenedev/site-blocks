<div class="col-12 mb-2">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills">
                @can("viewAny", \App\Block::class)
                    <li class="nav-item">
                        <a href="{{ route("admin.blocks.index") }}"
                           class="nav-link{{ $currentRoute === "admin.blocks.index" ? " active" : "" }}">
                            Список
                        </a>
                    </li>
                @endcan
                @can("create", \App\Block::class)
                    <li class="nav-item">
                        <a href="{{ route("admin.blocks.create") }}"
                           class="nav-link{{ $currentRoute === "admin.blocks.create" ? " active" : "" }}">
                            Добавить
                        </a>
                    </li>
                @endcan
                @if (! empty($block))
                    @can("view", \App\Block::class)
                        <li class="nav-item">
                            <a href="{{ route("admin.blocks.show", ["block" => $block]) }}"
                               class="nav-link{{ $currentRoute === "admin.blocks.show" ? " active" : "" }}">
                                Просмотр
                            </a>
                        </li>
                    @endcan

                    @can("update", \App\Block::class)
                        <li class="nav-item">
                            <a class="nav-link{{ $currentRoute == 'admin.blocks.edit' ? ' active' : '' }}"
                               href="{{ route('admin.blocks.edit', ['block' => $block]) }}">
                                Редактировать
                            </a>
                        </li>
                    @endcan

                    @can("delete", \App\Block::class)
                        <li class="nav-item">
                            <button type="button" class="btn btn-link nav-link"
                                    data-confirm="{{ "delete-form-block-{$block->id}" }}">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </button>
                            <confirm-form :id="'{{ "delete-form-block-{$block->id}" }}'">
                                <template>
                                    <form action="{{ route('admin.blocks.destroy', ['block' => $block]) }}"
                                          id="delete-form-block-{{ $block->id }}"
                                          class="btn-group"
                                          method="post">
                                        @csrf
                                        @method("delete")
                                    </form>
                                </template>
                            </confirm-form>
                        </li>
                    @endcan
                @endif
            </ul>
        </div>
    </div>
</div>