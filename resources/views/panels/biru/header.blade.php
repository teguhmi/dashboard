<!-- BEGIN: Header-->
<header class="page-topbar" id="header">
    <div class="navbar navbar-fixed">
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
            <div class="nav-wrapper">
                {{--<div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>--}}
                {{--<input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Explore Materialize" data-search="template-list">--}}
                {{--<ul class="search-list collection display-none"></ul>--}}
                {{--</div>--}}
                <ul class="navbar-list right">
                    <li class="hide-on-med-and-down">
                        <a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);">
                            <i class="material-icons">settings_overscan</i>
                        </a>
                    </li>
                    @if (Route::has('login'))
                        @auth
                            <li>
                                <a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown">
                                    <span class="avatar-status avatar-online"><img src="{{asset('app-assets/images/avatar/avatar-7.png')}}" alt="avatar"></span>
                                </a>
                            </li>
                        @else
                            <li>
                                <a class="grey-text text-darken-1" href="{{route('login')}}">Staf UT</a>
                            </li>
                        @endauth
                    @endif
                </ul>
                <!-- profile-dropdown-->
                <ul class="dropdown-content" id="profile-dropdown">
                    <li><a class="grey-text text-darken-1" href="#"><i class="material-icons">person_outline</i> Profile</a></li>
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
    </div>
</header>
