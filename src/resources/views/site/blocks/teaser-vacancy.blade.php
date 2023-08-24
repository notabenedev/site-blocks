<div class="card blocks-vacancy__card">
    <div class="card-header blocks-vacancy__card-header" id="vacancyBlockGroup{{ $block->blockGroup->slug }}Heading{{ $block->slug }}">
        <a class="btn btn-block blocks-vacancy__card-btn{{ !empty($first) ? "" : " collapsed" }}"
           data-toggle="collapse"
           data-target="#collapse{{ $block->slug }}"
           aria-expanded="{{ !empty($first) ? "true" : "false" }}"
           aria-controls="collapse{{ $block->slug }}">
            <h2 class="mb-0 blocks-vacancy__card-h2 text-left">
                {{ $block->title }}
            </h2>
        </a>
    </div>

    <div id="collapse{{ $block->slug }}"
         class="collapse blocks-vacancy__collapse{{ !empty($first) ? " show" : "" }}"
         aria-labelledby="vacancyBlockGroup{{ $block->blockGroup->slug }}Heading{{ $block->slug }}"
         data-parent="#vacancyBlockGroup{{ $block->blockGroup->slug }}">
        <div class="card-footer blocks-vacancy__card-footer">
            <h3 class="blocks-vacancy__short">
                {{ $block->short }}
            </h3>
        </div>
        <div class="card-body blocks-vacancy__card-body">
            <div  class="{{ config("site-blocks.floatImgVacancyTemplate", "float-md-right") }}">
                @if ($block->image)
                    @img([
                    "image" => $block->image,
                    "template" => "sm-grid-12",
                    "lightbox" => "blockGroup" . $block->slug,
                    "imgClass" => "img-fluid blocks-vacancy__img",
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

</div>