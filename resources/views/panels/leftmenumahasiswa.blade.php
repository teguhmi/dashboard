<!-- BEGIN: SideNav-->
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    @include('panels.biru.sidebar')
    <ul class="sidenav sidenav-collapsible leftside-navigation  collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        @include('panels.dashboard')
        <li class="navigation-header"><a class="navigation-header-text">Layanan </a><i class="navigation-header-icon material-icons">more_horiz</i></li>
        <li class="bold {{request()->routeIs('mahasiswa') ? 'active' : '' }}">
            <a class="waves-effect waves-cyan {{request()->routeIs('mahasiswa.layanan') ? 'active' : '' }}" href="{{route('mahasiswa.layanan')}} ">
                <i class="material-icons">all_inclusive</i>
                <span class="menu-title" data-i18n="Support">Mahasiswa</span>
            </a>
        </li>
    </ul>
    <div class="navigation-background">

    </div>
    <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out">
        <i class="material-icons">menu</i>
    </a>
</aside>
<!-- END: SideNav-->
