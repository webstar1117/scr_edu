<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu" style="background-color:#ffffff">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                @if(Auth::user())
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a style="padding-right:1%;padding-top:14px" class="nav-link dropdown-toggle arrow-none" href="/account" id="topnav-dashboard"  >
                            <i class="bx bx-user"></i>Home
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a style="padding-right:1%;padding-top:14px" class="nav-link dropdown-toggle arrow-none" href="/scr-edu" id="topnav-dashboard">
                            <i class="bx bx-home-circle"></i>SCR edu
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a style="padding-right:1%;padding-top:14px" class="nav-link dropdown-toggle arrow-none" href="/scr-super" id="topnav-dashboard">
                            <i class="bx bx-home-circle"></i>SCR super
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a style="padding-right:1%;padding-top:14px" class="nav-link dropdown-toggle arrow-none" href="javascript:void();"
                         id="topnav-layout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-log-out-circle "></i>LOGOUT
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>


                </ul>
                @else
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a style="padding-right:0" class="nav-link dropdown-toggle arrow-none" href="/" id="topnav-dashboard">
                            <i class="bx bx-home-circle"></i> HOME
                        </a>
                    </li>

                    <li style="padding-right:0" class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="auth-login">
                            <i class="bx bx-log-in"></i>LOG IN
                        </a>
                    </li>
                    <li style="padding-right:0" class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="auth-register">
                            <i class="bx bx-edit-alt"></i>REGISTER
                        </a>
                    </li>


                </ul>
                @endif

            </div>
        </nav>
    </div>
</div>