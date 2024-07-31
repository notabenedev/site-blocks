@if(isset($group) && isset($blocks))
    <div class="content-section blocks-hero" id="blocksHero{{ $group->slug }}">
        @foreach ($blocks as $item)
            {!! $item->getTeaser("hero", $loop->first ? 1 : 0) !!}
        @endforeach
    </div>
@endif