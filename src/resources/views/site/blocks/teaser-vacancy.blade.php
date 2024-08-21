<div class="accordion-item  blocks-vacancy__card">
    <div class="accordion-header blocks-vacancy__card-header" id="vacancyBlockGroup{{ $block->blockGroup->slug }}Heading{{ $block->slug }}">
        <button class="accordion-button text-start blocks-vacancy__card-btn{{ !empty($first) ? "" : " collapsed" }}"
           data-bs-toggle="collapse"
           data-bs-target="#collapse{{ $block->slug }}"
           aria-expanded="{{ !empty($first) ? "true" : "false" }}"
           aria-controls="collapse{{ $block->slug }}">
            <h2 class="blocks-vacancy__card-h2 mb-0">{{ $block->title }}</h2>
        </button>
    </div>

    <div id="collapse{{ $block->slug }}"
         class="accordion-collapse collapse blocks-vacancy__collapse{{ !empty($first) ? " show" : "" }}"
         aria-labelledby="vacancyBlockGroup{{ $block->blockGroup->slug }}Heading{{ $block->slug }}"
         data-bs-parent="#vacancyBlockGroup{{ $block->blockGroup->slug }}">
        <div class="accordion-body clearfix blocks-vacancy__card-body">
            <div class="accordion-footer blocks-vacancy__card-footer">
                <h3 class="blocks-vacancy__short">
                    {{ $block->short }}
                </h3>
            </div>
            <div  class="{{ config("site-blocks.floatImgVacancyTemplate", "float-md-end") }}">
                @if ($block->image)
                    @img([
                    "image" => $block->image,
                    "template" => "sm-grid-12",
                    "lightbox" => "blockGroup" . $block->slug,
                    "imgClass" => "img-fluid blocks-vacancy__img",
                    "grid" => [
                    "xxl-grid-4" => 1400,
                    "xl-grid-4" => 1200,
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