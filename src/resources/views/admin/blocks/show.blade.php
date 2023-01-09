@extends('admin.layout')

@section('page-title', 'Блоки - '.$block->title)
@section('header-title', "Блок - {$block->title}")

@section('admin')
    @include("site-blocks::admin.blocks.pills", ["group" => $block->blockGroup])

    <div class="col-12">
        @if($block->image)
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Изображение</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-inline-block">
                            @img([
                            "image" => $block->image,
                            "template" => "medium",
                            "lightbox" => "lightGroup" . $block->id,
                            "imgClass" => "rounded mb-2",
                            "grid" => [],
                            ])
                            @can("update",\App\Block::class)
                                <button type="button" class="close ml-1" data-confirm="{{ "delete-form-{$block->id}" }}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            @endcan
                        </div>
                        @can("update",\App\Block::class)
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
                        @endcan
                    </div>
                </div>
        @endif
        <div class="card mb-2">
            <div class="card-header">
                <h5 class="card-title">Краткое описание</h5>
            </div>
            <div class="card-body">
                {{ $block->short }}
            </div>
        </div>
        <div class="card mb-2">
            <div class="card-header">
                <h5 class="card-title">Описание</h5>
            </div>
            <div class="card-body">
                {!! $block->description !!}
            </div>
        </div>
            @isset($block->blockGroup)
                <div class="card mb-2">
                    <div class="card-header">
                        <h5 class="card-title">Группа</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route("admin.blocks.groups.show", ["group" => $block->blockGroup]) }}" class="badge badge-pill badge-secondary">
                            {{ $block->blockGroup->title }}
                        </a>
                    </div>
                </div>
            @endisset
    </div>
@endsection