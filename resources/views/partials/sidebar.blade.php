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
            <li>
                <a href="{{ url('/') }}">
                    <i class="entypo-gauge"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            @if($user->is_Admin == 1)
            <li class="has-sub">
                <a href="#">
                    <i class="entypo-user"></i>
                    <span class="title">Users</span>
                </a>
                <ul class="visible">
                    <li>
                        <a href="{{ url('/users/manage') }}">
                            <span class="title">Manage Users</span>
                        </a>
                    </li>
                    <li>
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