<div class="accordion" id="accordionBlockGroup{{ $blockGroup->slug }}">
    @foreach ($blocks as $item)
        <div class="card">
            <div class="card-header" id="accordionBlockGroup{{ $blockGroup->slug }}Heading{{ $item->slug }}">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $item->slug }}" aria-expanded="true" aria-controls="collapse{{ $item->slug }}">
                        {{ $item->title }}
                    </button>
                </h2>
            </div>

            <div id="collapse{{ $item->slug }}" class="collapse show" aria-labelledby="accordionBlockGroup{{ $blockGroup->slug }}Heading{{ $item->slug }}" data-parent="#accordionBlockGroup{{ $blockGroup->slug }}">
                <div class="card-body">
                    {{ $item->description }}
                </div>
            </div>
        </div>
    @endforeach
</div>