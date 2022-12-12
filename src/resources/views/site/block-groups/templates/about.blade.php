@if(isset($group) && isset($blocks))
    <div class="content-section blocks-about" id="blocksAbout{{ $group->slug }}">
        @foreach ($blocks as $item)
            {!! $item->getTeaser("about", $loop->first ? 1 : 0) !!}
        @endforeach
    </div>
@endif