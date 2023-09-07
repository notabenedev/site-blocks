<div class="col-12 col-sm-6 col-lg-4">
    <div class="blocks-digit__container">
        @if ($block->image)
                @pic([
                "image" => $block->image,
                "template" => "avatar",
                "imgClass" => "blocks-digit__ico",
                "grid" => config("site-blocks.filtersDigit", [
                ]) ,
                ])
        @endif
        <div class="blocks-digit__top">
                <h4 class="blocks-digit__title">
                    {{ $block->title }}
                </h4>
        </div>

        @isset($block->short)
            <div class="blocks-digit__bottom">
                <p class="blocks-digit__short">
                        {{ $block->short }}
                </p>
            </div>
        @endisset

        @isset($block->description)
            <div class="blocks-digit__desc">
                {!! $block->description !!}
            </div>
        @endisset
    </div>
</div>
