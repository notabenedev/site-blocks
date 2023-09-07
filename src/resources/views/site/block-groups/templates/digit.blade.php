@if(isset($group) && isset($blocks))
    <div class="content-section blocks-digit" id="blocksDigit{{ $group->slug }}">
        <div class="row">
            @foreach ($blocks as $item)
                {!! $item->getTeaser("digit", $loop->first ? 1 : 0) !!}
            @endforeach
        </div>
    </div>
@endif