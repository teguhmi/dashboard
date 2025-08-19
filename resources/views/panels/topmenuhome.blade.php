<nav class="white hide-on-med-and-down" id="horizontal-nav">
    <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down" id="ul-horizontal-nav" data-menu="menu-navigation">
            <li><a class="dropdown-menu" href="Javascript:void(0)" data-target="DashboardDropdown"><i class="material-icons">dashboard</i><span><span class="dropdown-title" data-i18n="Dashboard">Dashboard</span><i class="material-icons right">keyboard_arrow_down</i></span></a>
                <ul class="dropdown-content dropdown-horizontal-list" id="DashboardDropdown">
                    <li data-menu=""><a href="https://www.ut.ac.id"><span data-i18n="Modern">Website Universitas Terbuka</span></a>
                    </li>
                    <li data-menu=""><a href="{{config('app.web_upbjj')}}"><span data-i18n="eCommerce">Website {{config('app.upbjj')}}</span></a>
                    </li>
                    <li data-menu=""><a href="https://sia.ut.ac.id"><span data-i18n="Analytics">Website Mahasiswa / Calon mahasiswa</span></a>
                    </li>
                    <li data-menu=""><a href="{{config('app.url')}}"><span data-i18n="Analytics">Sertifikat, Jadwal dan Lainnya</span></a>
                    </li>
                </ul>
            </li>
            @if (    (Auth::check() && (Auth::user()->hakakses == 'admin'))    )
                <li><a class="dropdown-menu" href="Javascript:void(0)" data-target="PageDropdown"><i class="material-icons">content_paste</i><span><span class="dropdown-title" data-i18n="Pages">Pengguna</span><i class="material-icons right">keyboard_arrow_down</i></span></a>
                    <ul class="dropdown-content dropdown-horizontal-list" id="PageDropdown">
                        <li data-menu=""><a href="{{route('register')}}"><span data-i18n="Modern">Registrasi Pengguna</span></a>
                        </li>
                        <li data-menu=""><a href="{{route('user.data')}}"><span data-i18n="eCommerce">Daftar Pengguna</span></a>
                        </li>


                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>
