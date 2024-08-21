@if(isset($group) && isset($blocks))
    <div class="accordion  my-4 blocks-accrordion" id="accordionBlockGroup{{ $group->slug }}">
        @foreach ($blocks as $item)
            {!! $item->getTeaser("accordion", $loop->first ? 1 : 0)  !!}
        @endforeach
    </div>
@endif