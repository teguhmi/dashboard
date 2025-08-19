<nav class="white hide-on-med-and-down" id="horizontal-nav">
    <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down" id="ul-horizontal-nav" data-menu="menu-navigation">
            {{--            <li><a class="dropdown-menu" href="Javascript:void(0)" data-target="DashboardDropdown"><i class="material-icons">dashboard</i><span><span class="dropdown-title" data-i18n="Dashboard">Dashboard</span><i class="material-icons right">keyboard_arrow_down</i></span></a>--}}
            {{--                <ul class="dropdown-content dropdown-horizontal-list" id="DashboardDropdown">--}}
            {{--                    <li data-menu=""><a href="{{route('home')}}"><span data-i18n="Modern">Dashboard UT Surakarta</span></a></li>--}}
            {{--                    <li data-menu=""><a href="https://www.ut.ac.id"><span data-i18n="Modern">Website Universitas Terbuka</span></a></li>--}}
            {{--                    <li data-menu=""><a href="{{config('app.web_upbjj')}}"><span data-i18n="eCommerce">Website {{config('app.upbjj')}}</span></a></li>--}}
            {{--                    <li data-menu=""><a href="https://sia.ut.ac.id"><span data-i18n="Analytics">Website Mahasiswa / Calon mahasiswa</span></a>--}}
            {{--                    </li>--}}
            {{--                    <li data-menu=""><a href="{{config('app.url')}}"><span data-i18n="Analytics">Sertifikat, Jadwal dan Lainnya</span></a>--}}
            {{--                    </li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}

            <li class="bold"><a class="waves-effect waves-cyan " href="{{route('home')}}"><i class="material-icons">dashboard</i><span class="menu-title" data-i18n="Mail">Home</span></a>
            @if ((Auth::check() && (Auth::user()->hakakses == 'admin')))
                <li><a class="dropdown-menu" href="Javascript:void(0)" data-target="PageDropdown"><i class="material-icons">perm_data_setting</i><span><span class="dropdown-title" data-i18n="Pages">Konfigurasi</span><i class="material-icons right">keyboard_arrow_down</i></span></a>
                    <ul class="dropdown-content dropdown-horizontal-list" id="PageDropdown">
                        <li data-menu=""><a href="{{route('faq.kategori')}}"><span data-i18n="eCommerce">Kategori FAQ</span></a></li>
                        <li data-menu=""><a href="{{route('faq.deskripsi')}}"><span data-i18n="Analytics">Deskripsi FAQ</span></a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>
<!-- BEGIN: SideNav-->
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-fixed hide-on-large-only">
    <div class="brand-sidebar sidenav-light"></div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed hide-on-large-only menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        {{--        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="Javascript:void(0)"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge pill red float-right mr-10">3</span></a>--}}
        {{--            <div class="collapsible-body">--}}
        {{--                <ul class="collapsible collapsible-sub" data-collapsible="accordion">--}}
        {{--                    <li><a href="{{route('home')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Modern">Dashboard</span></a></li>--}}
        {{--                    <li><a href="https://www.ut.ac.id"><i class="material-icons">radio_button_unchecked</i><span data-i18n="eCommerce">Website Universitas Terbuka</span></a></li>--}}
        {{--                    <li><a href="{{config('app.web_upbjj')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Analytics">Website {{config('app.upbjj')}}</span></a></li>--}}
        {{--                    <li><a href="https://sia.ut.ac.id""><i class="material-icons">radio_button_unchecked</i><span data-i18n="Analytics">Website Mahasiswa / Calon mahasiswa</span></a></li>--}}
        {{--                    <li><a href="{{config('app.url')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Analytics">Sertifikat, Jadwal dan Lainnya</span></a></li>--}}
        {{--                </ul>--}}
        {{--            </div>--}}
        {{--        </li>--}}
        <li class="bold"><a class="waves-effect waves-cyan " href="{{route('home')}}"><i class="material-icons">dashboard</i><span class="menu-title" data-i18n="Mail">Dashboard</span></a>

        <li class="navigation-header"><a class="navigation-header-text">Konfigurasi</a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="{{route('faq.kategori')}}"><i class="material-icons">mail_outline</i><span class="menu-title" data-i18n="Mail">Kategori FAQ</span></a>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="{{route('faq.deskripsi')}}"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="Mail">Deskripsi FAQ</span></a>
        </li>


    </ul>
    <div class="navigation-background"></div>
    <a class="sidenav-trigger btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
<!-- END: SideNav-->
