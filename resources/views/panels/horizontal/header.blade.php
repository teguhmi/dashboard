<header class="page-topbar" id="header">
    <div class="navbar navbar-fixed">
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-light-blue-cyan">
            <div class="nav-wrapper">
                <ul class="left">
                    <li>
                        <h2 class="logo-wrapper"><a class="brand-logo darken-1" href="{{route('home')}}">
                                <img src="../../../app-assets/images/logo/logo_ut.png" alt="UT logo">
                                <span class="logo-text hide-on-med-and-down">{{config('app.upbjj')}}</span></a>
                        </h2>
                    </li>
                </ul>

                <div class="header header-search-wrapper hide-on-med-and-down">
{{--                    <img src="../../../app-assets/images/logo/logo.png" alt="UT logo">--}}

                </div>
                <ul class="navbar-list right">
                    <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
                    <li class="hide-on-large-only"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search </i></a></li>
                    <li>
                    @if (Route::has('login'))
                        @auth
                            <li>
                                <a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown">
                                    <span class="avatar-status avatar-online"><img src="{{asset('app-assets/images/avatar/avatar-7.png')}}" alt="avatar"></span>
                                </a>
                            </li>
                        @else
                            <li>
                                <a class="white-text" href="{{route('login')}}">Staf UT</a>
                            </li>
                        @endauth
                    @endif

                </ul>
                <ul class="dropdown-content" id="profile-dropdown">
                    <li><a class="grey-text text-darken-1" href="user-profile-page.html"><i class="material-icons">person_outline</i> Profile</a></li>
                    <li class="divider"></li>
                    <li>
                        <a class="grey-text text-darken-1" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="material-icons">keyboard_tab</i> Keluar
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
       @include('panels.topmenuhome')
    </div>
</header>
