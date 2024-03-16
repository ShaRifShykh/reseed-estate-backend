<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo ">
        <a href="#" class="app-brand-link">
{{--            <span class="app-brand-logo demo">--}}
{{--                <img src="{{ asset("assets/img/logo.png") }}" alt="Image Not Found!" width="50">--}}
{{--            </span>--}}
            <span class="app-brand-text demo menu-text fw-bold ms-2 text-uppercase">Reseed</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item{{ request()->routeIs("admin.dashboard") ? ' active' : null }}">
            <a href="{{ route("admin.dashboard") }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

{{--        <!-- Apps & Pages -->--}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">App Info</span>
        </li>
        <li class="menu-item{{ request()->routeIs("admin.posts.*") ? ' active' : null }}">
            <a href="{{ route("admin.posts.index") }}" class="menu-link">
                <i class="menu-icon fa-solid fa-building "></i>
                <div class="text-truncate" data-i18n="Posts">Posts</div>
            </a>
        </li>
        <li class="menu-item{{ request()->routeIs("admin.users.*") ? ' active' : null }}">
            <a href="{{ route("admin.users.index") }}" class="menu-link">
                <i class="menu-icon fa-solid fa-people-group "></i>
                <div class="text-truncate" data-i18n="Users">Users</div>
            </a>
        </li>
{{--        <li class="menu-item{{ request()->routeIs("admin.users.*") ? ' active' : null }}">--}}
{{--            <a href="{{ route("admin.users.index") }}" class="menu-link">--}}
{{--                <i class="menu-icon fa-solid fa-users "></i>--}}
{{--                <div class="text-truncate" data-i18n="Users">Users</div>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="menu-item{{ request()->routeIs("admin.verification.*") ? ' active open' : null }}">--}}
{{--            <a href="javascript:void(0);" class="menu-link menu-toggle">--}}
{{--                <i class="menu-icon tf-icons bx bxs-check-circle"></i>--}}
{{--                <div class="text-truncate" data-i18n="Verification">Verification</div>--}}
{{--            </a>--}}
{{--            <ul class="menu-sub">--}}
{{--                <li class="menu-item{{ request()->routeIs("admin.verification.userDocument.*") ? ' active' : null }}">--}}
{{--                    <a href="{{ route("admin.verification.userDocument.index") }}" class="menu-link">--}}
{{--                        <div class="text-truncate" data-i18n="User Document">User Document</div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="menu-item{{ request()->routeIs("admin.verification.userVerification.*") ? ' active' : null }}">--}}
{{--                    <a href="{{ route("admin.verification.userVerification.index") }}" class="menu-link">--}}
{{--                        <div class="text-truncate" data-i18n="User Verification">User Verification</div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li class="menu-item{{ request()->routeIs("admin.surveys.*") ? ' active' : null }}">--}}
{{--            <a href="{{ route("admin.surveys.index") }}" class="menu-link">--}}
{{--                <i class="menu-icon tf-icons bx bxs-inbox"></i>--}}
{{--                <div class="text-truncate" data-i18n="Surveys">Surveys</div>--}}
{{--            </a>--}}
{{--        </li>--}}
        {{--        <li class="menu-item{{ request()->routeIs("admin.users.*") ? ' active' : null }}">--}}
        {{--            <a href="{{ route("admin.users.index") }}" class="menu-link">--}}
        {{--                <i class="menu-icon bx bxs-check-circle "></i>--}}
        {{--                <div class="text-truncate" data-i18n="Document Verification">Document Verification</div>--}}
        {{--            </a>--}}
        {{--        </li>--}}
        {{--        <li class="menu-item{{ request()->routeIs("admin.users.*") ? ' active' : null }}">--}}
        {{--            <a href="{{ route("admin.users.index") }}" class="menu-link">--}}
        {{--                <i class="menu-icon bx bxs-check-circle "></i>--}}
        {{--                <div class="text-truncate" data-i18n="Verification">Verification</div>--}}
        {{--            </a>--}}
        {{--        </li>--}}

    </ul>
</aside>
<!-- / Menu -->
