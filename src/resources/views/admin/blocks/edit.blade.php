@extends('admin.layout')

@section('page-title', $block->title . ' - Редактировать - ')
@section('header-title', "Редактировать {$block->title}")

@section('admin')
    @include("site-blocks::admin.blocks.pills")
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post"
                      class="col-12 needs-validation"
                      enctype="multipart/form-data"
                      action="{{ route('admin.blocks.update', ['block' => $block]) }}">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="title">Заголовок </label>
                        <input type="text"
                               id="title"
                               name="title"
                               value="{{ old('title') ? old('title') : $block->title }}"
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
                               name="slug"
                               value="{{ old('slug') ? old('slug') : $block->slug }}"
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
                               name="short"
                               value="{{ old('short') ? old('short') : $block->short }}"
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea class="form-control tiny"
                                  name="description"
                                  id="description"
                                  rows="3">{{ old('description') ? old('description') : $block->description }}</textarea>
                    </div>

                    <div class="form-group">
                        @if($block->image)
                            <div class="d-inline-block">
                                <img src="{{ route('imagecache', ['template' => 'small', 'filename' => $block->image->file_name]) }}"
                                     class="rounded mb-2"
                                     alt="{{ $block->image->name }}">
                                <button type="button" class="close ml-1" data-confirm="{{ "delete-form-{$block->id}" }}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
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
                        <button type="submit" class="btn btn-success">Обновить</button>
                    </div>
                </form>

                @if($block->image)
                    <confirm-form :id="'{{ "delete-form-{$block->id}" }}'">
                        <template>
                            <form action="{{ route('admin.blocks.show.delete-image', ['block' => $block]) }}"
                                  id="delete-form-{{ $block->id }}"
                                  class="btn-group"
                                  method="post">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                            </form>
                        </template>
                    </confirm-form>
                @endif
            </div>
        </div>
    </div>
@endsection
