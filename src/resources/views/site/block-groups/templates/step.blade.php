@if(isset($group) && isset($blocks))
    <div class="content-section blocks-step" id="blocksStep{{ $group->slug }}">
        <div class="row">
            @foreach ($blocks as $item)
                {!! $item->getTeaser("step", $loop->first ? 1 : 0) !!}
            @endforeach
        </div>
    </div>
@endif