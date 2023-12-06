<div class="blocks-alert__container alert alert-warning alert-dismissible fade" role="alert"
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
        <button type="button" class="close blocks-alert__close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
</div>

