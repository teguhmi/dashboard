@extends('pages.dashboardlayanan')
@section('content')
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-2" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0">
                                <span>Layanan dan Keluhan {{config('app.upbjj')}}</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('dashboardlayanan')}}">Layanan</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12">
                <div class="container">
                    <div class="section">
                        <div class="card">
                            <div class="card-content">
                                <div class="row" id="gradient-Analytics">
                                    <div class="col s12 m6 l3 card-width">
                                        <div
                                            class="card row gradient-45deg-deep-orange-orange gradient-shadow white-text padding-4 mt-5">
                                            <div class="col s7 m7">
                                                <i class="material-icons background-round mt-5 mb-5">add_shopping_cart</i>
                                                <p>Baru</p>
                                            </div>
                                            <div class="col s5 m5 right-align">
                                                <br>
                                                <h5 class="mb-0 white-text">{{$tiket[0]->baru}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3 card-width">
                                        <div
                                            class="card row gradient-45deg-blue-indigo gradient-shadow white-text padding-4 mt-5">
                                            <div class="col s7 m7">
                                                <i class="material-icons background-round mt-5 mb-5">perm_identity</i>
                                                <p>Dalam Proses</p>
                                            </div>
                                            <div class="col s5 m5 right-align">
                                                <br>
                                                <h5 class="mb-0 white-text">{{$tiket[0]->proses}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3 card-width">
                                        <div
                                            class="card row gradient-45deg-purple-deep-orange gradient-shadow white-text padding-4 mt-5">
                                            <div class="col s7 m7">
                                                <i class="material-icons background-round mt-5 mb-5">timeline</i>
                                                <p>Terjawab</p>
                                            </div>
                                            <div class="col s5 m5 right-align">
                                                <br>
                                                <h5 class="mb-0 white-text">{{$tiket[0]->terjawab}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3 card-width">
                                        <div
                                            class="card row gradient-45deg-purple-deep-purple gradient-shadow white-text padding-4 mt-5">
                                            <div class="col s7 m7">
                                                <i class="material-icons background-round mt-5 mb-5">attach_money</i>
                                                <p>Selesai</p>
                                            </div>
                                            <div class="col s5 m5 right-align">
                                                <br>
                                                <h5 class="mb-0 white-text">{{$tiket[0]->selesai}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <!--Basic Card-->
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col s12 m6 l3">
                                    <div class="card gradient-45deg-light-blue-cyan gradient-shadow">
                                        <div class="card-content white-text">
                                            <span class="card-title">Legalisir</span>
                                            <p>
                                                Layanan Legalisir
                                            </p>
                                            @if(!empty($ip))
                                                {{$ip}}
                                            @endif
                                        </div>
                                        <div class="card-action">
                                            <a href="{{route('legalisir.index')}}"
                                               class="waves-effect waves-light btn gradient-45deg-red-pink">Buka
                                                Aplikasi</a>
                                        </div>
                                    </div>
                                </div>
                                @if(config('app.kode_upbjj') == '44')
                                    <div class="col s12 m6 l3">
                                        <div class="card gradient-45deg-indigo-light-blue gradient-shadow">
                                            <div class="card-content white-text">
                                                <span class="card-title">Layanan Mahasiswa</span>
                                                <p>
                                                    Layanan eKTM
                                                </p>
                                            </div>
                                            <div class="card-action">
                                                <a href="{{route('layanan.ktm')}}" class="waves-effect waves-light btn gradient-45deg-red-pink">Buka
                                                    Aplikasi</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{--                                <div class="col s12 m6 l3">--}}
                                {{--                                    <div class="card gradient-45deg-cyan-light-green gradient-shadow">--}}
                                {{--                                        <div class="card-content white-text">--}}
                                {{--                                            <span class="card-title">Layanan WiFi.id</span>--}}
                                {{--                                            <p>--}}
                                {{--                                                Layanan wifi.id--}}
                                {{--                                            </p>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="card-action">--}}
                                {{--                                            <a href="{{route('layanan.wifiID')}}" class="waves-effect waves-light btn gradient-45deg-red-pink">Buka--}}
                                {{--                                                Aplikasi</a>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <div class="col s12 m6 l3">
                                    <div class="card gradient-45deg-orange-amber gradient-shadow">
                                        <div class="card-content white-text">
                                            <span class="card-title">Layanan Mahasiswa</span>
                                            <p>
                                                Numpang Ujian
                                            </p>
                                        </div>
                                        <div class="card-action">
                                            <a href="{{route('ujian.numpangkeluar')}}" class="waves-effect waves-light btn gradient-45deg-red-pink">Buka
                                                Aplikasi</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m6 l3">
                                    <div class="card gradient-45deg-cyan-light-green gradient-shadow">
                                        <div class="card-content white-text">
                                            <span class="card-title">Layanan Mahasiswa</span>
                                            <p>
                                                Aduan Mahasiswa
                                            </p>
                                        </div>
                                        <div class="card-action">
                                            <a href="{{route('helpdesk.aduan')}}" class="waves-effect waves-light btn gradient-45deg-red-pink">Buka
                                                Aplikasi</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
