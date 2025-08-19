<!-- BEGIN: SideNav-->
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    @include('panels.biru.sidebar')
    <ul class="sidenav sidenav-collapsible leftside-navigation  collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        @include('panels.dashboard')
        <li class="navigation-header"><a class="navigation-header-text">Menumpang Ujian Keluar </a><i class="navigation-header-icon material-icons">more_horiz</i></li>
        <li class="divider"></li>
        <li class="bold {{request()->routeIs('ujian') ? 'active' : '' }}">
            <a class="waves-effect waves-cyan {{request()->routeIs('ujian.numpangkeluar') ? 'active' : '' }}" href="{{route('ujian.numpangkeluar')}} ">
                <i class="material-icons">toys</i>
                <span class="menu-title" data-i18n="Support">Menumpang Ujian Keluar</span>
            </a>
        </li>
        <li class="divider"></li>
        <li class="bold {{request()->routeIs('ujian') ? 'active' : '' }}">
            <a class="waves-effect waves-cyan {{request()->routeIs('ujian.laporannumpang') ? 'active' : '' }}" href="{{route('ujian.laporannumpang')}} ">
                <i class="material-icons">view_list</i>
                <span class="menu-title" data-i18n="Support">Laporan Numpang Ujian</span>
            </a>
        </li>
{{--        <li class="bold {{request()->routeIs('ujian') ? 'active' : '' }}">--}}
{{--            <a class="waves-effect waves-cyan {{request()->routeIs('ujian.laporannumpang.jumlahmtk') ? 'active' : '' }}" href="{{route('ujian.laporannumpang.jumlahmtk')}} ">--}}
{{--                <i class="material-icons">view_module</i>--}}
{{--                <span class="menu-title" data-i18n="Support">Laporan Jumlah Matakuliah</span>--}}
{{--            </a>--}}
{{--        </li>--}}
        <li class="divider"></li>
        <li class="navigation-header"><a class="navigation-header-text">Menumpang Ujian Masuk </a><i class="navigation-header-icon material-icons">more_horiz</i></li>
        <li class="divider"></li>
        <li class="bold {{request()->routeIs('ujian') ? 'active' : '' }}">
            <a class="waves-effect waves-cyan {{request()->routeIs('ujian.numpangmasuk') ? 'active' : '' }}" href="{{route('ujian.numpangmasuk')}} ">
                <i class="material-icons">access_time</i>
                <span class="menu-title" data-i18n="Support">Numpang Ujian Masuk</span>
            </a>
        </li>

        <li class="divider"></li>
        <li class="bold {{request()->routeIs('ujian') ? 'active' : '' }}">
            <a class="waves-effect waves-cyan {{request()->routeIs('ujian.laporannumpangmasuk') ? 'active' : '' }}" href="{{route('ujian.laporannumpangmasuk')}} ">
                <i class="material-icons">view_module</i>
                <span class="menu-title" data-i18n="Support">Laporan Numpang Ujian</span>
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
