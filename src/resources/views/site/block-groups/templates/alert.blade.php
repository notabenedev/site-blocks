@if(isset($group) && isset($blocks))
    <div class="blocks-alert" id="blocksAlert{{ $group->slug }}">
        @foreach ($blocks as $item)
            @if($loop->index < 2)
                {!! $item->getTeaser("alert", $loop->first ? 1 : 0) !!}
            @endif
        @endforeach
    </div>
@endif