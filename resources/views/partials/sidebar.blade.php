<div class="sidebar-menu">
    <div class="sidebar-menu-inner">
        <header class="logo-env">
            <!-- logo -->
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo@2x.png') }}" width="120" alt="" />
                </a>
            </div>

            <!-- logo collapse icon -->
            <div class="sidebar-collapse">
                <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                    <i class="entypo-menu"></i>
                </a>
            </div>

            <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
            <div class="sidebar-mobile-menu visible-xs">
                <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                    <i class="entypo-menu"></i>
                </a>
            </div>
        </header>

        <ul id="main-menu" class="main-menu">
            <li>
                <a href="#">
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