<!-- BEGIN: Header-->
<nav
    class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark bg-white navbar-shadow">
    <div class="navbar-wrapper">

        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                        href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item"><a class="navbar-brand"><img class="brand-logo" alt="modern admin logo"
                            src="{{ asset('back-design/clients/img/logo.png') }}">
                        <h4 class="brand-text">Electricity <b>Bills</b></h4>
                    </a></li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                        data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
            </ul>
        </div>

        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                            href="#"><i class="ft-menu"></i></a></li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i
                                class="ficon ft-maximize"></i></a></li>
                </ul>

                <ul class="nav navbar-nav float-right">

                    <li class="dropdown dropdown-user nav-item">
                        <a style="color: #C30147;" class="dropdown-toggle nav-link dropdown-user-link" href="#"
                            data-toggle="dropdown"><span class="mr-1 user-name text-bold-700">
                                {{ Auth::user()->name }} </span>
                            <span class="avatar avatar-online">

                                <img src="

                                      @if (auth()->user()->detail_users()->first()->photo != '' ||
    auth()->user()->detail_users()->first()->photo != null)

                                @if(File::exists('storage/'.substr(auth()->user()->detail_users()->first()->photo,
                                strpos(auth()->user()->detail_users()->first()->photo, 'assets/'))))

                                {{ auth()->user()->detail_users()->first()->photo }}

                            @elseif(File::exists(str_replace(substr(auth()->user()->detail_users()->first()->photo,
                                0, strpos(auth()->user()->detail_users()->first()->photo, 'assets/')),
                                'storage/app/public/', auth()->user()->detail_users()->first()->photo)))

                                {{ url(
                                    str_replace(
                                        substr(
                                            auth()->user()->detail_users()->first()->photo,
                                            0,
                                            strpos(
                                                auth()->user()->detail_users()->first()->photo,
                                                'assets/',
                                            ),
                                        ),
                                        'storage/app/public/',
                                        auth()->user()->detail_users()->first()->photo,
                                    ),
                                ) }}

                            @else
                                {{ asset('/back-design/clients/default/user-profile.svg') }}
                                @endif

                            @else
                                {{ asset('/back-design/clients/default/user-profile.svg') }}
                                @endif "
                                alt="avatar">

                                <i></i>

                            </span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('backsite.profiles.index') }}"><i
                                    class='bx bx-user bx-flashing'></i> Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class='bx bx-power-off bx-burst'></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>

                </ul>
            </div>
        </div>

    </div>
</nav>
<!-- END: Header-->
