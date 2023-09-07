<div class="col-12 col-sm-6 col-lg-4">
    <div class="blocks-benefit__container">
        <div class="d-inline-flex">
            @if ($block->image)
                @pic([
                "image" => $block->image,
                "template" => "avatar",
                "imgClass" => "blocks-benefit__ico",
                "grid" => config("site-blocks.filtersBenefit", [
                ]) ,
                ])
            @endif
            <div class="blocks-benefit__content">
                <h4 class="blocks-benefit__title">
                    {{ $block->title }}
                </h4>
                @isset($block->short)
                    <p class="blocks-benefit__short">
                        {{ $block->short }}
                    </p>
                @endisset
            </div>
        </div>
        @isset($block->description)
            <div class="blocks-benefit__desc">
                {!! $block->description !!}
            </div>
        @endisset
    </div>
</div>
