<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Заголовок</th>
            <th>Адресная строка</th>
            @canany(["edit", "view", "delete"], \App\BlockGroup::class)
                <th>Действия</th>
            @endcanany
        </tr>
        </thead>
        <tbody>
        @foreach ($groups as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->slug }}</td>
                @canany(["edit", "view", "delete"], \App\BlockGroup::class)
                    <td>
                        <div role="toolbar" class="btn-toolbar">
                            <div class="btn-group mr-1">
                                @can("view", \App\BlockGroup::class)
                                    <a href="{{ route('admin.blocks.groups.show', ["group" => $item]) }}" class="btn btn-dark">
                                        <i class="far fa-eye"></i>
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </td>
                @endcanany
            </tr>
        @endforeach
        </tbody>
    </table>
</div>