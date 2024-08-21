<div class="blocks-alert__container alert alert-danger alert-dismissible fade show d-none" role="alert"
     id="alertBlockGroup{{ $block->blockGroup->slug }}Heading{{ $block->slug }}">
        @isset($block->short)
            <div class="blocks-alert__short">
                {{ $block->short  }}
            </div>
        @endisset
        @isset($block->description)
            <div class="blocks-alert__body">
                {!! $block->description !!}
            </div>
        @endisset
        <button type="button" class="btn-close blocks-alert__close" data-bs-dismiss="alert" aria-label="Close">
        </button>
</div>

