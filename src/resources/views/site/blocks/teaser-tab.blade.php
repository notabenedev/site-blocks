<div class="card blocks-tab__card">
    @if ($block->image)
        @pic([
        "image" => $block->image,
        "lightbox" => "blockGroup" . $block->slug,
        "template" => "sm-grid-12",
        "imgClass" => "card-img-top",
        "grid" => config("site-blocks.filtersTab", [
        "lg-grid-4" => 992,
        "md-grid-6" => 768
        ]) ,
        ])
    @endif
    <div class="card-body blocks-tab__card-body">
        <h4 class="mb-0 blocks-tab__card-h2">
            {{ $block->title }}
        </h4>
        {!! $block->description !!}
    </div>
</div>
