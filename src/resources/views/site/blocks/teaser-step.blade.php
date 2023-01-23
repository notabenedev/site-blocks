    <div class="col-12 col-sm-6 col-lg-3 blocks-step__col">
        <div class="card blocks-step__card">
            <div class="card-body">
                <div class="d-inline-flex">
                    @isset($block->short)
                        <div class="blocks-step__card-number">
                            {{ $block->short }}
                        </div>
                    @endisset
                    <div class="blocks-step__card-content">
                        @if ($block->image)
                            <div class="{{ config("site-blocks.floatImgStepTemplate", "float-md-left") }}">
                                    @img([
                                    "image" => $block->image,
                                    "template" => "sm-grid-12",
                                    "lightbox" => "blockGroup" . $block->slug,
                                    "imgClass" => "img-fluid blocks-step__img",
                                    "grid" => config("site-blocks.filters", [
                                    "lg-grid-6" => 992,
                                    "md-grid-6" => 768
                                    ]) ,
                                    ])
                            </div>
                        @endif
                        <h3 class="blocks-step__card-title">
                            {{ $block->title }}
                        </h3>
                    </div>
                </div>
                <div class="blocks-step__card-desc">
                    {!! $block->description !!}
                </div>
            </div>
        </div>
    </div>
