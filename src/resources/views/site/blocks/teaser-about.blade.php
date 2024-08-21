<div class="card blocks-about__card">
    <div class="card-header blocks-about__card-header" id="aboutBlockGroup{{ $block->blockGroup->slug }}Heading{{ $block->slug }}">
        <h3 class="mb-0 blocks-about__card-h2">
            {{ $block->title }}
        </h3>
    </div>
    <div class="card-body blocks-about__card-body">
        <div class="{{ config("site-blocks.floatImgAboutTemplate", "float-md-left") }}">
            @if ($block->image)
                    @img([
                    "image" => $block->image,
                    "template" => "sm-grid-12",
                    "lightbox" => "blockGroup" . $block->slug,
                    "imgClass" => "img-fluid blocks-about__img",
                    "grid" => config("site-blocks.filters", [
                            "xxl-grid-6" => 1400,
                            "xl-grid-6" => 1200,
                            "lg-grid-6" => 992,
                            "md-grid-6" => 768
                        ]) ,
                    ])
            @endif
         </div>
            {!! $block->description !!}
    </div>
</div>
