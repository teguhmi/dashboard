<!-- BEGIN: SideNav-->
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light navbar-full  sidenav-active-rounded">
    <div class="brand-sidebar">
        <h2 class="logo-wrapper">
            <a class="brand-logo darken-1" href="#">
                <img class="hide-on-med-and-down " src="../../../app-assets/images/logo/logo_ut.png" alt="logo">
                <img class="show-on-medium-and-down hide-on-med-and-up" src="../../../app-assets/images/logo/logo_ut.png')}}" alt="logo">
                {{--<img class="hide-on-med-and-down " src="{{asset('storage/logo/logo_ut_text.png')}}"/>--}}
                <span class="logo-text hide-on-med-and-down">{{ config('app.upbjj') }}</span>
            </a>
            <a class="navbar-toggler" href="#">
                <i class="material-icons">radio_button_checked</i>
            </a>
        </h2>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation  collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        @include('panels.dashboard')
        <li class="navigation-header"><a class="navigation-header-text"> </a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        @auth
            <li class="bold">
                <a class="collapsible-header waves-effect waves-cyan " href="#">
                    <i class="material-icons">photo_filter</i>
                    <span class="menu-title" data-i18n="Menu levels">Seminar</span>
                </a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li>
                            <a href="#">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Second level">Pendaftaran Seminar</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Second level">Jadwal Seminar</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
        @endauth
        <li class="bold {{request()->routeIs('sertifikat.*') ? 'active' : '' }}">
            <a class="collapsible-header waves-effect waves-cyan " href="#">
                <i class="material-icons">import_contacts</i>
                <span class="menu-title" data-i18n="Menu levels">Sertifikat</span>
            </a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li class="{{request()->routeIs('sertifikat.dashboard') ? 'active' : '' }}">
                        <a class="waves-effect waves-cyan {{request()->routeIs('sertifikat.dashboard') ? 'active' : '' }}" href="{{route('sertifikat.dashboard')}}">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span data-i18n="Second level">Cari Sertifikat</span>
                        </a>
                    </li>
                    <li class="divider"></li>
                    @if (    (Auth::check() && (Auth::user()->hakakses == 'admin'))    )
                        <li class="{{request()->routeIs('sertifikat.conf') ? 'active' : '' }}">
                            <a class="waves-effect waves-cyan {{request()->routeIs('sertifikat.conf') ? 'active' : '' }}" href="{{route('sertifikat.conf')}}">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Second level">Input / Edit Sertifikat</span>
                            </a>
                        </li>
                        <li class="{{request()->routeIs('sertifikat.import.*') ? 'active' : '' }}">
                            <a class="waves-effect waves-cyan {{request()->routeIs('sertifikat.import.view') ? 'active' : '' }}" href="{{route('sertifikat.import.view')}}">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Second level">Daftar / Import Peserta</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
{{--        <li class="bold {{request()->routeIs('jadwal.*') ? 'active' : '' }}">--}}
{{--            <a class="collapsible-header waves-effect waves-cyan " href="#">--}}
{{--                <i class="material-icons">import_contacts</i>--}}
{{--                <span class="menu-title" data-i18n="Menu levels">Jadwal</span>--}}
{{--            </a>--}}
{{--            <div class="collapsible-body">--}}
{{--                <ul class="collapsible collapsible-sub" data-collapsible="accordion">--}}
{{--                    <li class="{{request()->routeIs('jadwal.tutorial') ? 'active' : '' }}">--}}
{{--                        <a class="waves-effect waves-cyan {{request()->routeIs('jadwal.tutorial') ? 'active' : '' }}" href="{{route('jadwal.tutorial')}}">--}}
{{--                            <i class="material-icons">radio_button_unchecked</i>--}}
{{--                            <span data-i18n="Second level">Jadwal Tutorial</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </li>--}}
    </ul>
    <div class="navigation-background">

    </div>
    <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out">
        <i class="material-icons">menu</i>
    </a>
</aside>
<!-- END: SideNav-->
