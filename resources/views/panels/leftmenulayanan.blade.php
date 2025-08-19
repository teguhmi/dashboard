<!-- BEGIN: SideNav-->
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    @include('panels.biru.sidebar')
    <ul class="sidenav sidenav-collapsible leftside-navigation  collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        @include('panels.dashboard')
        <li class="navigation-header"><a class="navigation-header-text">Layanan </a><i class="navigation-header-icon material-icons">more_horiz</i></li>
        <li class="bold {{request()->routeIs('layanan.tiket') ? 'active' : '' }}">
            <a class="waves-effect waves-cyan {{request()->routeIs('layanan.tiket') ? 'active' : '' }}" href="{{route('layanan.tiket')}} ">
                <i class="material-icons">all_inclusive</i>
                <span class="menu-title" data-i18n="Support">Formulir Layanan</span>
            </a>
        </li>
        <li class="bold {{request()->routeIs('legalisir.*') ? 'active' : '' }}">
            <a class="waves-effect waves-cyan {{request()->routeIs('legalisir.index') ? 'active' : '' }}" href="{{route('legalisir.index')}} ">
                <i class="material-icons">bug_report</i>
                <span class="menu-title" data-i18n="Support">Formulir Legalisir</span>
            </a>
        </li>
        @auth
            <li class="divider"></li>
            <li class="bold {{request()->routeIs('layanan.deskripsi.*') ? 'active' : '' }}">
                <a class="collapsible-header waves-effect waves-cyan " href="#">
                    <i class="material-icons">business</i>
                    <span class="menu-title" data-i18n="Menu levels">Data Layanan</span>
                </a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li>
                            <a class="waves-effect waves-cyan {{request()->routeIs('layanan.deskripsi.index') ? 'active' : '' }}" href="{{route('layanan.deskripsi.index')}} ">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Second level">Daftar Layanan Masuk</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="bold {{request()->routeIs('layanan.laporan.*') ? 'active' : '' }}">
                <a class="collapsible-header waves-effect waves-cyan " href="#">
                    <i class="material-icons">grain</i>
                    <span class="menu-title" data-i18n="Menu levels">Laporan</span>
                </a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li>
                            <a class="waves-effect waves-cyan {{request()->routeIs('layanan.laporan') ? 'active' : '' }}" href="{{route('layanan.laporan')}} ">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Second level">Peragaan Data Layanan</span>
                            </a>
                        </li>

                        <li>
                            <a class="waves-effect waves-cyan {{request()->routeIs('layanan.laporan.iso') ? 'active' : '' }}" href="{{route('layanan.laporan.iso')}} ">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Second level">Laporan Form ISO</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        @endauth
        @if (    (Auth::check() && (Auth::user()->hakakses == 'admin'))    )
            <li class="divider"></li>
            <li class="bold {{request()->routeIs('layanan.data.*') ? 'active' : '' }}">
                <a class="collapsible-header waves-effect waves-cyan " href="#">
                    <i class="material-icons">blur_linear</i>
                    <span class="menu-title" data-i18n="Menu levels">Konfigurasi Data</span>
                </a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li>
                            <a class="waves-effect waves-cyan {{request()->routeIs('layanan.data.asal') ? 'active' : '' }}" href="{{route('layanan.data.asal')}} ">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Second level">Asal Layanan</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-cyan {{request()->routeIs('layanan.data.kategori') ? 'active' : '' }}" href="{{route('layanan.data.kategori')}} ">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Second level">Kategori Layanan</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-cyan {{request()->routeIs('layanan.data.kp') ? 'active' : '' }}" href="{{route('layanan.data.kp')}} ">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Second level">Kelompok Pelanggan</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-cyan {{request()->routeIs('layanan.data.pj') ? 'active' : '' }}" href="{{route('layanan.data.pj')}} ">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Second level">Penanggung Jawab</span>
                            </a>
                        </li>
                    </ul>
                </div>
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
