@can("viewAny", \App\StaffDepartment::class)
    @if ($theme == "sb-admin")
        @php($active = strstr($currentRoute, 'admin.employees') !== FALSE)
        <li class="nav-item dropdown{{ $active ? ' active' : '' }}">
            <a class="nav-link"
               href="#"
               data-toggle="collapse"
               data-target="#collapse-departments-menu"
               aria-controls="#collapse-departments-menu"
               aria-expanded="{{ $active ? "true" : "false" }}">
                @isset($ico)
                    <i class="{{ $ico }}"></i>
                @endisset
                <span>{{ config("site-staff.siteEmployeeName") }}</span>
            </a>
            <div id="collapse-departments-menu" class="collapse{{ $active ? " show" : "" }}" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a href="{{ route('admin.employees.index') }}"
                       class="collapse-item{{ strstr($currentRoute, 'admin.employees.') !== FALSE  ? " active" : "" }}">
                        <span>{{ config("site-staff.siteEmployeeName") }}</span>
                    </a>
                    <a href="{{ route('admin.departments.index') }}"
                       class="collapse-item{{strstr($currentRoute, 'admin.departments') !== FALSE ? ' active' : '' }}">
                        <span>{{ config("site-staff.siteDepartmentName") }}</span>
                    </a>
                </div>
            </div>
        </li>
    @else
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle{{ strstr($currentRoute, 'admin.employees') !== FALSE ? ' active' : '' }}"
               href="#"
               id="user-dropdown"
               role="button"
               data-toggle="dropdown"
               aria-haspopup="true"
               aria-expanded="false">
                @isset($ico)
                    <i class="{{ $ico }}"></i>
                @endisset
                {{ config("site-staff.sitePackageName") }}
            </a>
            <div class="dropdown-menu" aria-labelledby="user-dropdown">
                <a href="{{ route('admin.employees.index') }}"
                   class="dropdown-item">
                    {{ config("site-staff.siteEmployeeName") }}
                </a>
                <a href="{{ route('admin.departments.index') }}"
                   class="dropdown-item">
                    {{ config("site-staff.siteDepartmentName") }}
                </a>
            </div>
        </li>
    @endif
@endcan