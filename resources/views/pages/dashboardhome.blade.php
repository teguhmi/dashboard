<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
@include('panels.horizontal.head')
<body class="horizontal-layout page-header-light horizontal-menu preload-transitions 2-columns" data-open="click" data-menu="horizontal-menu" data-col="2-columns">
@include('panels.horizontal.header')
<div id="main">
    <div class="row">
        <div class="col s12 m3 l3 centered ">
            <div class="card gradient-shadow gradient-45deg-light-blue-cyan border-radius-3 animate fadeUp">
                <div class="card-content center">
                    <a href="{{route('sertifikat.dashboard')}}">
                        <img src="../../../app-assets/images/sertifikat.png" class="width-40 border-round z-depth-5 responsive-img" alt="images"/>
                        <h5 class="white-text lighten-4">Sertifikat</h5>
                        <p class="white-text lighten-4">Sertifikat Kegiatan</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="col s12 m3 l3 centered ">
            <div class="card gradient-shadow gradient-45deg-red-pink border-radius-3 animate fadeUp">
                <div class="card-content center">
                    <a href="{{route('ttm.jadwal')}}">
                        <img src="../../../app-assets/images/tutorial.png" class="width-40 border-round z-depth-5 responsive-img" alt="image"/>
                        <h5 class="white-text lighten-4">Tutorial</h5>
                        <p class="white-text lighten-4">Kegiatan Tutorial</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="col s12 m3 l3 centered ">
            <div class="card gradient-shadow gradient-45deg-amber-amber border-radius-3 animate fadeUp">
                <div class="card-content center">
                    <a href="{{route('mahasiswa.layanan')}}">
                        <img src="../../../app-assets/images/icon/laptop.png" class="width-40 border-round z-depth-5 responsive-img" alt="image"/>
                        <h5 class="white-text lighten-4">Layanan </h5>
                        <p class="white-text lighten-4">Layanan Mahasiswa</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col s12 m3 l3 centered ">
            <div class="card gradient-shadow gradient-45deg-green-teal border-radius-3 animate fadeUp">
                <div class="card-content center">
                    <a href="{{route('presensi.dashboard')}}">
                        <img src="../../../app-assets/images/presensi.png" class="width-40 border-round z-depth-5 responsive-img" alt="image"/>
                        <h5 class="white-text lighten-4">Presensi</h5>
                        <p class="white-text lighten-4">Presensi Online</p>
                    </a>
                </div>
            </div>
        </div>
        @auth
            <div class="col s12 m3 l3 centered ">
                <div class="card gradient-shadow gradient-45deg-purple-amber border-radius-3 animate fadeUp">
                    <div class="card-content center">
                        <a href="{{route('dashboardlayanan')}}">
                            <img src="../../../app-assets/images/icon/laptop.png" class="width-40 border-round z-depth-5 responsive-img" alt="image"/>
                            <h5 class="white-text lighten-4">Layanan </h5>
                            <p class="white-text lighten-4">Layanan UT {{config('app.upbjj')}}</p>
                        </a>
                    </div>
                </div>
            </div>

        @endauth
        @if(config('app.kode_upbjj') == '44' )
            <div class="col s12 m3 l3 centered ">
                <div class="card gradient-shadow gradient-45deg-brown-brown border-radius-3 animate fadeUp">
                    <div class="card-content center">
                        <a href="{{route('faq.dashboard')}}">
                            <img src="../../../app-assets/images/icon/faq.png" class="width-40 border-round z-depth-5 responsive-img" alt="image"/>
                            <h5 class="white-text lighten-4">FAQ</h5>
                            <p class="white-text lighten-4">Frequently Asked Questions</p>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@include('panels.horizontal.footer')
@include('panels.horizontal.script')
</body>
</html>
<script>
    var botmanWidget = {
        aboutText: 'ssdsd',
        // frameEndpoint: '/iFrameUrl',
        introMessage: "✋ Hi! I'm form devel"
    };
</script>

<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
