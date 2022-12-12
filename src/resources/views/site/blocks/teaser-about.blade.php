<div class="card blocks-about__card">
    <div class="card-header blocks-about__card-header" id="aboutBlockGroup{{ $block->blockGroup->slug }}Heading{{ $block->slug }}">
        <h3 class="mb-0 blocks-about__card-h2">
            {{ $block->title }}
        </h3>
    </div>
    <div class="card-body blocks-about__card-body">
        <div class="float-md-left">
            @if ($block->image)
                    @img([
                    "image" => $block->image,
                    "template" => "sm-grid-12",
                    "lightbox" => "blockGroup" . $block->slug,
                    "imgClass" => "img-fluid rounded mb-3 mr-md-3 blocks-about__img",
                    "grid" => [
                    "lg-grid-4" => 992,
                    "md-grid-6" => 768
                    ],
                    ])
            @endif
         </div>
            {!! $block->description !!}
    </div>
</div>
