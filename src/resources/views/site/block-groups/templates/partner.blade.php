@if(isset($group) && isset($blocks))
    <div class="content-section blocks-partner" id="blocksPartner{{ $group->slug }}">
        <div class="d-flex flex-wrap justify-content-between">
            @foreach ($blocks as $item)
                {!! $item->getTeaser("partner", $loop->first ? 1 : 0) !!}
            @endforeach
        </div>
    </div>
@endif