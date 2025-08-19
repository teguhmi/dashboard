@extends('pages.dashboardlayanan')
@section('head')

@endsection
<!-- Form with validation -->

@section('content')
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-2" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="col s12 m12 l12">
                    <div class="container">
                        <div class="row">
                            <div class="col s10 m6 l6">
                                <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Pelayanan Administrasi Akademik</span>
                                </h5>
                                <ol class="breadcrumbs mb-0">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('dashboardlayanan')}}">Layanan</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('layanan.laporan')}}">Laporan -
                                            Peragaan Data Layanan</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div id="report" class="card card-tabs">
                        <div class="card-content">
                            <div class="card-title">
                                <p><strong>Data Permohonan @if(!empty($jenis))
                                            {{$jenis}}
                                        @endif {{config('app.upbjj')}}</strong></p>
                                {{--                                <hr>--}}
                                {{--                                <br>--}}
                                {{--                                <div class="row">--}}
                                {{--                                    <div class="col s6 m12 l12">--}}
                                {{--                                        <label>--}}
                                {{--                                            <input name="radio" type="radio" value="status" checked>--}}
                                {{--                                            <span>Berdasarkan Status</span>--}}
                                {{--                                        </label>--}}
                                {{--                                        <label>--}}
                                {{--                                            <input name="radio" type="radio" value="tanggal" />--}}
                                {{--                                            <span>Berdasarkan Tanggal</span>--}}
                                {{--                                        </label>--}}

                                {{--                                    </div>--}}
                            </div>
                            <form role="form" method="get" action="{{ route('layanan.wifiID') }}" id="form">
                                @csrf
                                <div class="row">
                                    <br>
                                    <div class="col s12 m12 l12" id="st">
                                        <input type="hidden" value="wifiID" name="jenis">
                                        <label for="status"></label>
                                        <select class="select2 browser-default" name="status" id="status">
                                            <option value="baru">Baru</option>
                                            <option value="proses">Dalam Proses</option>
                                            <option value="selesai">Selesai</option>
                                        </select>
                                    </div>
                                    {{--                                        <div class="col s6 m2" id="awal" hidden>--}}
                                    {{--                                            <input id="tanggal_awal" name="tanggal_awal" type="text">--}}
                                    {{--                                            <label for="tanggal_akhir">Tanggal Awal</label>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="col s6 m2 l2" id="akhir" hidden>--}}
                                    {{--                                            <input id="tanggal_akhir" name="tanggal_akhir" type="text">--}}
                                    {{--                                            <label for="tanggal_akhir">Tanggal Akhir</label>--}}
                                    {{--                                        </div>--}}

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col s6 m2 l2" id="akhir">
                                        <button
                                            class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1"
                                            type="submit">
                                            Cari Data
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      @include('pages.layanan.mahasiswa.DTLayananWifiID')
    </div>
@endsection
@section('script')
    <script src="../../../app-assets/js/scripts/data-tables.js"></script>
@endsection
