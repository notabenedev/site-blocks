@extends("admin.layout")

@section("page-title", "Группы блоков - ".config("site-blocks.sitePackageName")." - ")

@section('header-title', "Группы блоков")

@section('admin')
    @include("site-blocks::admin.block-groups.includes.pills")
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <form action="{{ route($currentRoute) }}" method="get" class="form-inline">
                    <label for="title" class="sr-only">Заголовок</label>
                    <input type="text"
                           id="title"
                           name="title"
                           placeholder="Заголовок"
                           value="{{ $request->get("title", "") }}"
                           class="form-control  mb-2 mr-sm-2">

                    <select class="custom-select mb-2 mr-sm-2" name="morph" aria-label="Тип группы ">
                        <option value="no"{{ ! $request->has('morph') || $request->get('morph') === 'no' ? " selected" : '' }}>
                            Группы home-блоков
                        </option>
                        <option value="yes"{{ $request->get('morph') === 'yes' ? " selected" : '' }}>
                            Связанные группы
                        </option>
                    </select>

                    <button class="btn btn-primary mb-2 mr-2" type="submit">Применить</button>
                    <a href="{{ route($currentRoute) }}" class="btn btn-secondary mb-2">
                        Сбросить
                    </a>
                </form>
            </div>
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