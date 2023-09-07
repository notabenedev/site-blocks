@if(isset($group) && isset($blocks))
    <div class="content-section blocks-benefit" id="blocksBenefit{{ $group->slug }}">
        <div class="row">
            @foreach ($blocks as $item)
                {!! $item->getTeaser("benefit", $loop->first ? 1 : 0) !!}
            @endforeach
        </div>
    </div>
@endif