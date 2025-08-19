<!-- BEGIN: SideNav-->
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    @include('panels.biru.sidebar')
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        @include('panels.dashboard')
        <li class="navigation-header">
            <a class="navigation-header-text"> </a>
            <i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        <li class="bold {{request()->routeIs('ttm.*') ? 'active' : '' }}">
            <a class="collapsible-header waves-effect waves-cyan " href="#">
                <i class="material-icons">brightness_5</i>
                <span class="menu-title" data-i18n="Menu levels">Jadwal</span>
            </a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li class="{{request()->routeIs('ttm.jadwal') ? 'active' : '' }}">
                        <a class="waves-effect waves-cyan {{request()->routeIs('ttm.jadwal') ? 'active' : '' }}" href="{{route('ttm.jadwal')}}">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span data-i18n="Second level">Jadwal Tutorial</span>
                        </a>
                    </li>

                    {{--                    <li class="{{request()->routeIs('jadwal.uotap') ? 'active' : '' }}">--}}
                    {{--                        <a class="waves-effect waves-cyan {{request()->routeIs('jadwal.uotap') ? 'active' : '' }}" href="{{route('jadwal.uotap')}}">--}}
                    {{--                            <i class="material-icons">radio_button_unchecked</i>--}}
                    {{--                            <span data-i18n="Second level">Jadwal UO TAP</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    <li class="divider"></li>
                </ul>
            </div>
        </li>
        @auth
            <li class="bold {{request()->routeIs('angket.*') ? 'active' : '' }}">
                <a class="collapsible-header waves-effect waves-cyan " href="#">
                    <i class="material-icons">brightness_4</i>
                    <span class="menu-title" data-i18n="Menu levels">Data Tutorial</span>
                </a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li class="{{request()->routeIs('angket.tutor') ? 'active' : '' }}">
                            <a class="waves-effect waves-cyan {{request()->routeIs('angket.tutor') ? 'active' : '' }}" href="{{route('angket.tutor')}}">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Second level">Data Kelas Tutor</span>
                            </a>
                        </li>
                        <li class="{{request()->routeIs('angket.tutor') ? 'active' : '' }}">
                            <a class="waves-effect waves-cyan {{request()->routeIs('angket.evaluasi') ? 'active' : '' }}" href="{{route('angket.evaluasi')}}">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Second level">Evaluasi Tutor</span>
                            </a>
                        </li>
                        <li class="divider"></li>
                    </ul>
                </div>
            </li>
        @endauth
{{--        @auth--}}
            <li class="bold {{request()->routeIs('tutor.*') ? 'active' : '' }}">
                <a class="collapsible-header waves-effect waves-cyan " href="#">
                    <i class="material-icons">person</i>
                    <span class="menu-title" data-i18n="Menu levels">Data Tutor</span>
                </a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li class="{{request()->routeIs('tutor.dp') ? 'active' : '' }}">
                            <a class="waves-effect waves-cyan {{request()->routeIs('tutor.dp') ? 'active' : '' }}" href="{{route('tutor.dp')}}">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Second level">Profile Tutor</span>
                            </a>
                        </li>
                        <li class="{{request()->routeIs('tutor.formtutorial') ? 'active' : '' }}">
                            <a class="waves-effect waves-cyan {{request()->routeIs('tutor.formtutorial') ? 'active' : '' }}" href="{{route('tutor.formtutorial')}}">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Second level">Form Tutorial</span>
                            </a>
                        </li>
                        <li class="divider"></li>
                    </ul>
                </div>
            </li>
{{--        @endauth--}}
    </ul>
    <div class="navigation-background">

    </div>
    <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out">
        <i class="material-icons">menu</i>
    </a>
</aside>
<!-- END: SideNav-->
