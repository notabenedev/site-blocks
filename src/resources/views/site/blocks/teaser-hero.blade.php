<section class="blocks-hero__section"
         id="heroBlock{{ $block->slug }}"
         style="background-image: url('{{ route("image-filter",["template"=>"original", 'filename' => $block->image->file_name]) }}')">
    <div class="container blocks-hero__container">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8">
                <p class="blocks-hero__short">
                    {{ $block->short }}
                </p>
                <h1 class="blocks-hero__title">
                    {{ $block->title }}
                </h1>
            </div>
            <div class="col-12 col-md-10 col-lg-8 col-xl-6">
                <div class="blocks-hero__description">
                    {!! $block->description !!}
                </div>
            </div>
        </div>
    </div>
</section>

