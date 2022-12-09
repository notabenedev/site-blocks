<ul class="list-unstyled">
    @foreach ($groups as $group)
        <li>
            <div class="custom-control custom-radio">
                <input class="custom-control-input"
                       type="radio"
                       {{ (! count($errors->all()) ) && (isset($block) && isset($block->blockGroup) && $block->blockGroup->id == $group->id) || old('check-' . $group->id) ? "checked" : "" }}
                       value="{{ $group->id }}"
                       id="check-{{ $group->id }}"
                       name="check-{{ $group->id }}">
                <label class="custom-control-label" for="check-{{ $group->id }}">
                    <a href="{{ route("admin.blocks.groups.show",["group" => $group]) }}"
                       target="_blank">
                        {{ $group->title }}
                    </a>
                </label>
            </div>
        </li>
    @endforeach
</ul>

