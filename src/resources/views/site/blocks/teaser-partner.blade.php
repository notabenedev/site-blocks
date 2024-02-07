<div class="blocks-partner mb-4">
    <div class="card border-0 d-hover-relative blocks-partner__card">
        @if ($block->image)
            @pic([
            "image" => $block->image,
            "template" => "widen-logo",
            "imgClass" => "img-fluid card-img-top blocks-partner__img",
            "grid" => config("site-blocks.filtersPartner", []),
            ])
        @endif
        @isset($block->short)
            <div class="small card-body d-hover blocks-partner__card-content">
                @isset($block->short)
                    <div class="blocks-partner__card-short">
                        {{ $block->short }}
                    </div>
                @endisset
                @isset($block->description)
                    <div class="blocks-partner__card-desc">
                        {!! $block->description !!}
                    </div>
                @endisset
            </div>
        @endisset
    </div>
</div>
