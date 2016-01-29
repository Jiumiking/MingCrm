<!-- User Info, Notifications and Menu Bar -->
<nav class="navbar user-info-navbar" role="navigation">
    <!-- Left links for user info navbar -->
    <ul class="user-info-menu left-links list-inline list-unstyled">
        <li class="hidden-sm hidden-xs">
            <a href="#" data-toggle="sidebar">
                <i class="fa-bars"></i>
            </a>
        </li>
    </ul>
    <!-- Right links for user info navbar -->
    <ul class="user-info-menu right-links list-inline list-unstyled">
        <li class="dropdown user-profile">
            <a href="#" data-toggle="dropdown">
                <img src="/images/av1.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                <span>
                    {{ Auth::user()->name }}
                    <i class="fa-angle-down"></i>
                </span>
            </a>
            <ul class="dropdown-menu user-profile-menu list-unstyled">
                <li>
                    <a href="{{route('user.edit',Auth::user()->id)}}">
                        <i class="fa-user"></i>
                        个人信息
                    </a>
                </li>
                <li>
                    <a href="{{route('user.changePersonalPassword')}}">
                        <i class="fa-lock"></i>
                        修改密码
                    </a>
                </li>
                <li class="last">
                    <a href="{{ url('/logout') }}">
                        <i class="fa-power-off"></i>
                        安全退出
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>