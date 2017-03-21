<div class="sidebar-menu">
    <div class="sidebar-menu-inner">
        <header class="logo-env">
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo@2x.png') }}" width="120" alt="" />
                </a>
            </div>

            <div class="sidebar-collapse">
                <a href="#" class="sidebar-collapse-icon">
                    <i class="entypo-menu"></i>
                </a>
            </div>

            <div class="sidebar-mobile-menu visible-xs">
                <a href="#" class="with-animation">
                    <i class="entypo-menu"></i>
                </a>
            </div>
        </header>

        <ul id="main-menu" class="main-menu">
            <li @if(Request::path() == '/')class="active"@endif>
                <a href="{{ url('/') }}">
                    <i class="entypo-gauge"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="has-sub">
                <a href="#">
                    <i class="entypo-vcard"></i>
                    <span class="title">Leads</span>
                </a>
                <ul @if(Request::path() == 'leads/view' OR Request::path() == 'leads/export')class="visible"@endif >
                    <li @if(Request::path() == 'leads/view')class="active"@endif>
                        <a href="{{ url('/leads/view') }}">
                            <span class="title">View Leads</span>
                        </a>
                    </li>
                    <li @if(Request::path() == 'leads/export')class="active"@endif>
                        <a href="{{ url('/leads/export') }}">
                            <span class="title">Export Leads</span>
                        </a>
                    </li>
                </ul>
            </li>
            @if($user->is_Admin == 1)
            <li class="has-sub">
                <a href="#">
                    <i class="entypo-user"></i>
                    <span class="title">Users</span>
                </a>
                <ul @if(Request::path() == 'users/manage' OR Request::path() == 'users/create')class="visible"@endif>
                    <li @if(Request::path() == 'users/manage')class="active"@endif>
                        <a href="{{ url('/users/manage') }}">
                            <span class="title">Manage Users</span>
                        </a>
                    </li>
                    <li @if(Request::path() == 'users/create')class="active"@endif>
                        <a href="{{ url('/users/create') }}">
                            <span class="title">Create User</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>

    </div>

</div>