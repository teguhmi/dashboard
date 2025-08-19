<!-- BEGIN: SideNav-->
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    @include('panels.biru.sidebar')
    <ul class="sidenav sidenav-collapsible leftside-navigation  collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        @include('panels.dashboard')
        <li class="navigation-header">
            <a class="navigation-header-text"> </a>
            <i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        @if(    (Auth::check() && (Auth::user()->hakakses == 'pjw'))  ||  (Auth::check() && (Auth::user()->hakakses == 'bblba')))

            <li class="bold {{request()->routeIs('register') ? 'active' : '' }}">
                <a class="waves-effect waves-cyan {{request()->routeIs('register') ? 'active' : '' }}" href="{{route('register')}}">
                    <i class="material-icons">person_add</i>
                    <span class="menu-title" data-i18n="Support">Registrasi Pengguna</span>
                </a>
            </li>
            <li class="bold {{request()->routeIs('user.data') ? 'active' : '' }}">
                <a class="waves-effect waves-cyan {{request()->routeIs('user.data') ? 'active' : '' }}" href="{{route('user.data')}}">
                    <i class="material-icons">person</i>
                    <span class="menu-title" data-i18n="Support">Data Pengguna</span>
                </a>
            </li>
        @endif
    </ul>
    <div class="navigation-background">

    </div>
    <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out">
        <i class="material-icons">menu</i>
    </a>
</aside>
<!-- END: SideNav-->
