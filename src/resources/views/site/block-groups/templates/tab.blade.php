@if(isset($group) && isset($blocks))
    <div class="tab-pane fade{{ (isset($first) && $first)? " show active": "" }}"
         id="pills-{{ $group->slug }}"
         role="tabpanel"
         aria-labelledby="pills-{{ $group->slug }}-tab">
        <div class="row">
            @foreach ($blocks as $item)
                <div class="col-12 col-sm-6 col-lg-4">
                    {!! $item->getTeaser("tab", $loop->first ? 1 : 0)  !!}
                </div>
            @endforeach
        </div>
    </div>
@endif