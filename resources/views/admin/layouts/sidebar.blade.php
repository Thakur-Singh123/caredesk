<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">
                 <img src="{{ url('logo.png') }}" style="
                        height: 50px;
                        width: 160px;
                        object-fit: cover;
                    " ></span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        
            <!-- Regular Admin / Staff Menu Items -->
            <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.branches*') ? 'active' : '' }}">
                <a href="{{ route('admin.branches.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-building-house"></i>
                    <div data-i18n="Branches">Branches</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.policies*') ? 'active' : '' }}">
                <a href="{{ route('admin.policies.import') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Policies">Import Policies</div>
                </a>
            </li>
    </ul>
</aside>