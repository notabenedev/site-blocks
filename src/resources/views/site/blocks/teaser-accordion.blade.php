<div class="accordion-item blocks-accordion__card">
    <div class="accordion-header blocks-accordion__card-header" id="accordionBlockGroup{{ $block->blockGroup->slug }}Heading{{ $block->slug }}">
        <button class="accordion-button text-start{{ !empty($first) ? "" : " collapsed" }}"
           data-bs-toggle="collapse"
           data-bs-target="#collapse{{ $block->slug }}"
           aria-expanded="{{ !empty($first) ? "true" : "false" }}"
           aria-controls="collapse{{ $block->slug }}">
            <h2 class="mb-0 blocks-accordion__card-h2">
                {{ $block->title }}
            </h2>
        </button>
    </div>

    <div id="collapse{{ $block->slug }}"
         class="accordion-collapse collapse blocks-accordion__collapse{{ !empty($first) ? " show" : "" }}"
         aria-labelledby="accordionBlockGroup{{ $block->blockGroup->slug }}Heading{{ $block->slug }}"
         data-bs-parent="#accordionBlockGroup{{ $block->blockGroup->slug }}">
        <div class="accordion-body clearfix blocks-accordion__card-body">
            <div  class="{{ config("site-blocks.floatImgAccordionTemplate", "float-md-end") }}">
                @if ($block->image)
                    @img([
                    "image" => $block->image,
                    "template" => "sm-grid-12",
                    "lightbox" => "blockGroup" . $block->slug,
                    "imgClass" => "img-fluid blocks-accordion__img",
                    "grid" => [
                    "xxl-grid-4" => 1400,
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