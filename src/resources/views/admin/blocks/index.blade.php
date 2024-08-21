@extends('admin.layout')

@section('page-title', 'Блоки - ')
@section('header-title', "Блоки")

@section('admin')
    @include("site-blocks::admin.blocks.pills")
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <form action="{{ route($currentRoute) }}"
                      class="d-lg-inline-flex"
                      method="get">
                    <label class="sr-only" for="title">Блоки</label>
                    <input type="text"
                           class="form-control mb-2 me-sm-2"
                           id="title"
                           name="title"
                           value="{{ $query->get('title') }}"
                           placeholder="Блоки">

                    <select class="custom-select mb-2 me-sm-2" name="group" aria-label="Группа ">
                        <option value="all"{{ ! $query->has('group') || $query->get('group') === 'all' ? " selected" : '' }}>
                            Все группы
                        </option>
                        @foreach($groups as $item)
                            <option value="{{ $item->slug }}"{{ $query->get('group') === $item->slug ? " selected" : '' }}>
                                {{ $item->title }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-primary mb-2 me-sm-1">Применить</button>
                    <a href="{{ route($currentRoute) }}" class="btn btn-secondary mb-2">Сбросить</a>
                </form>
            </div>
           @include("site-blocks::admin.blocks.includes.table-list", ["blocksList" => $blocksList,"page" => $page,"per" => $per])
        </div>
    </div>

    @if ($blocksList->lastPage() > 1)
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{ $blocksList->links() }}
                </div>
            </div>
        </div>
    @endif
@endsection
