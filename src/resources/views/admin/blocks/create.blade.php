@extends('admin.layout')

@section('page-title', 'Блок - Добавить - ')
@section('header-title',  'Блок - Добавить')

@section('admin')
    @include("site-blocks::admin.blocks.pills")
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post"
                      class="col-12 needs-validation"
                      enctype="multipart/form-data"
                      action="{{ route('admin.blocks.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="title">Заголовок <span class="text-danger">*</span></label>
                        <input type="text"
                               id="title"
                               name="title"
                               value="{{ old('title') }}"
                               required
                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}">
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text"
                               id="slug"
                               Name="slug"
                               value="{{ old('slug') }}"
                               class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}">
                        @if ($errors->has('slug'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('slug') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="short">Краткое описание</label>
                        <input type="text"
                               id="short"
                               Name="short"
                               value="{{ old('short') }}"
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="description">Описание <span class="text-danger">*</span></label>
                        <textarea class="form-control tiny {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                  name="description"
                                  id="description"
                                  rows="3">
                            {{ old('description') }}
                        </textarea>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="custom-file">
                        <input type="file"
                               class="custom-file-input{{ $errors->has('image') ? ' is-invalid' : '' }}"
                               id="custom-file-input"
                               lang="ru"
                               name="image"
                               aria-describedby="inputGroupMain">
                        <label class="custom-file-label"
                               for="custom-file-input">
                            Выберите файл главного изображения
                        </label>
                        @if ($errors->has('image'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('image') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="form-group mt-3">
                        @isset($group)
                            <label>Группа блоков:</label>
                            @include("site-blocks::admin.block-groups.includes.tree-radio", ['groups' => [$group]])
                        @else
                            @isset($groups)
                                <label>Группы блоков:</label>
                                @include("site-blocks::admin.block-groups.includes.tree-radio", ['groups' => $groups])
                            @endisset
                        @endisset

                    </div>

                    <div class="btn-group mt-2"
                         role="group">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
