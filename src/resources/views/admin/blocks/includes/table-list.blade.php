<div class="card-body">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                @isset($page)<th>#</th>@endisset
                <th>Заголовок</th>
                <th>Slug</th>
                <th>Краткое описание</th>
                @canany(["view", "update", "delete"], \App\Block::class)
                    <th>Действия</th>
                @endcanany
            </tr>
            </thead>
            <tbody>
            @foreach ($blocksList as $item)
                <tr>
                    @isset($page)
                        <td>
                            {{ $page * $per + $loop->iteration }}
                        </td>
                    @endisset
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ $item->short }}</td>
                    @canany(["view", "update", "delete", "publish"], \App\Block::class)
                        <td>
                            <div role="toolbar" class="btn-toolbar">
                                <div class="btn-group btn-group-sm mr-1">
                                    @can("update", \App\Block::class)
                                        <a href="{{ route("admin.blocks.edit", ["block" => $item]) }}" class="btn btn-primary">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can("view", \App\Block::class)
                                        <a href="{{ route('admin.blocks.show', ["block" => $item]) }}" class="btn btn-dark">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    @endcan
                                    @can("delete", \App\Block::class)
                                        <button type="button" class="btn btn-danger" data-confirm="{{ "delete-form-{$item->id}" }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    @endcan
                                </div>
                            </div>
                            @can("delete", \App\Block::class)
                                <confirm-form :id="'{{ "delete-form-{$item->id}" }}'">
                                    <template>
                                        <form action="{{ route('admin.blocks.destroy', ["block" => $item]) }}"
                                              id="delete-form-{{ $item->id }}"
                                              class="btn-group"
                                              method="post">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </template>
                                </confirm-form>
                            @endcan
                        </td>
                    @endcanany
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>