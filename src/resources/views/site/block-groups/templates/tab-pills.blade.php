<ul class="nav nav-pills blocks-tab-pills mb-3" id="pills-tab" role="tablist">
    @foreach ($groups as $tab)
        <li class="nav-item" role="presentation">
            <button class="nav-link{{ $loop->first ? " active": "" }}"
                    id="pills-{{ $tab->slug }}-tab"
                    data-toggle="pill"
                    data-target="#pills-{{ $tab->slug }}"
                    type="button" role="tab"
                    aria-controls="pills-{{ $tab->slug }}"
                    aria-selected="{{ $loop->first ? "true": "false" }}">
                {{ $tab->title }}
            </button>
        </li>
    @endforeach
</ul>
<div class="tab-content" id="pills-tabContent">
    @foreach($groups as $tab)
        @includeIf($tab->template, ["group" => $tab, "blocks" => $tab->getBlocksCache(), "first" => $loop->first ? 1: 0])
    @endforeach
</div>