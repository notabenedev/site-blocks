@can("viewAny", \App\BlockGroup::class)
    @if ($theme == "sb-admin")
        @php($active = strstr($currentRoute, 'admin.blocks.') !== FALSE)
        <li class="nav-item dropdown{{ $active ? ' active' : '' }}">
            <a class="nav-link"
               href="#"
               data-bs-toggle="collapse"
               data-bs-target="#collapse-blocks-groups-menu"
               aria-controls="#collapse-blocks-groups-menu"
               aria-expanded="{{ $active ? "true" : "false" }}">
                @isset($ico)
                    <i class="{{ $ico }}"></i>
                @endisset
                <span>{{ config("site-blocks.sitePackageName") }}</span>
            </a>
            <div id="collapse-blocks-groups-menu" class="collapse{{ $active ? " show" : "" }}" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a href="{{ route('admin.blocks.index') }}"
                       class="collapse-item{{ (strstr($currentRoute, 'admin.blocks.') !== FALSE && strstr($currentRoute, 'admin.blocks.groups') == FALSE)  ? " active" : "" }}">
                        <span>Блоки</span>
                    </a>
                    <a href="{{ route('admin.blocks.groups.index') }}"
                       class="collapse-item{{strstr($currentRoute, 'admin.blocks.groups') !== FALSE ? ' active' : '' }}">
                        <span>Группы блоков</span>
                    </a>
                </div>
            </div>
        </li>
    @else
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle{{ strstr($currentRoute, 'admin.blocks') !== FALSE ? ' active' : '' }}"
               href="#"
               id="blocks-groups-dropdown"
               role="button"
               data-toggle="dropdown"
               aria-haspopup="true"
               aria-expanded="false">
                @isset($ico)
                    <i class="{{ $ico }}"></i>
                @endisset
                {{ config("site-blocks.sitePackageName") }}
            </a>
            <div class="dropdown-menu" aria-labelledby="blocks-groups-dropdown">
                <a href="{{ route('admin.blocks.index') }}"
                   class="dropdown-item">
                    Блоки
                </a>
                <a href="{{ route('admin.blocks.groups.index') }}"
                   class="dropdown-item">
                    Группы блоков
                </a>
            </div>
        </li>
    @endif
@endcan