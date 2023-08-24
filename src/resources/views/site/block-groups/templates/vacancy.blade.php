@if(isset($group) && isset($blocks))
    <div class="accordion blocks-vacancy" id="vacancyBlockGroup{{ $group->slug }}">
        @foreach ($blocks as $item)
            {!! $item->getTeaser("vacancy", $loop->first ? 1 : 0)  !!}
        @endforeach
    </div>
@endif