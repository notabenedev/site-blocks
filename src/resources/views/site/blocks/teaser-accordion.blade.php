<div class="card blocks-accrordion__card">
    <div class="card-header blocks-accrordion__card-header" id="accordionBlockGroup{{ $block->blockGroup->slug }}Heading{{ $block->slug }}">
        <h2 class="mb-0 blocks-accrordion__card-h2">
            <a class="btn btn-link btn-block text-left{{ !empty($first) ? "" : " collapsed" }}"
               data-toggle="collapse"
               data-target="#collapse{{ $block->slug }}"
               aria-expanded="{{ !empty($first) ? "true" : "false" }}"
               aria-controls="collapse{{ $block->slug }}">
                {{ $block->title }}
            </a>
        </h2>
    </div>

    <div id="collapse{{ $block->slug }}"
         class="collapse blocks-accrordion__collapse{{ !empty($first) ? " show" : "" }}"
         aria-labelledby="accordionBlockGroup{{ $block->blockGroup->slug }}Heading{{ $block->slug }}"
         data-parent="#accordionBlockGroup{{ $block->blockGroup->slug }}">
        <div class="card-body blocks-accrordion__card-body">
            <div  class="{{ config("site-blocks.floatImgAccordionTemplate", "float-md-right") }}">
                @if ($block->image)
                    @img([
                    "image" => $block->image,
                    "template" => "sm-grid-12",
                    "lightbox" => "blockGroup" . $block->slug,
                    "imgClass" => "img-fluid blocks-accrordion__img",
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