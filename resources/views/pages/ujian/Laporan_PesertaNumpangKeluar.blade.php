@extends('pages.dashboardujian')
@section('head')

@endsection

@section('content')
    <div id="main">
        <div class="row">
            <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m10 l10 breadcrumbs-left">
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Laporan Mahasiswa Numpang Ujian</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('dashboardlayanan')}}">Layanan</a></li>
                                <li class="breadcrumb-item"><a href="{{route('ujian.laporannumpang')}}">Laporan Numpang Ujian</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @include('panels.bannerinfo')
            <div class="section section-data-tables">
                <div class="col s12">
                    {{--        <div class="container">--}}
                    <div class="row">
                        <div class="col s12">
                            <div id="basic-form" class="card card-default scrollspy">
                                <div class="card-content">
                                    <h4 class="card-title">Laporan Peserta Ujian</h4>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col s12">
                                            <form role="form" method="post" action="{{route('ujian.laporannumpang.cari')}}" id="form">
                                                @csrf

                                                <div class="row">
                                                    <div class="col s6 m12 l12">
                                                        <label>
                                                            <input name="radio" type="radio" value="jumlah" checked/>
                                                            <span>Jumlah Matakuliah</span>
                                                        </label>
                                                        <label>
                                                            <input name="radio" type="radio" value="daftar">
                                                            <span>Daftar Mahasiswa</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row margin">
                                                    <div class="input-field col s6 m4 l2">
                                                        <p for="id">Masa Ujian</p>
                                                        <input placeholder="" name="id" id="id" type="text" maxlength="9" autofocus>
                                                        <input name="jenis" id="jenis" type="hidden" value="@if(!empty($jenis)) {{$jenis}} @endif">
                                                        {{--                                                        <span style="font-size: smaller">Masukkan data pencarian berupa Masa Ujian</span>--}}
                                                    </div>
                                                    @if(!empty('jenis'))
                                                        @if($jenis == 'jumlahmtk')
                                                            <div class="input-field col s6 m4 l10">
                                                                <p for="upbjj">UPBJJ</p>
                                                                <select class="select2 browser-default" name="upbjj" id="upbjj">
                                                                    <option value='' disabled selected></option>
                                                                    @if (!empty($upbjj))
                                                                        @foreach ($upbjj->data->dataUpbjj as $data)
                                                                            <option value="{{$data->kode_upbjj}}"> {{$data->nama_upbjj}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                                <button class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb-2">Cari</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(!empty($jenis) || !empty($r))
                            @if($jenis== 'daftarnumpang')
                                @include('pages.ujian.DataTableDaftarPesertaNumpang')
                            @endif
                            @if($jenis== 'jumlahmtk' && $r != 'daftar')
                                @include('pages.ujian.DataTableJumlahMatakuliah')
                            @endif
                            @if($jenis == 'jumlahmtk' && $r =='daftar')
                                @include('pages.ujian.DataTableDaftarPesertaNumpang_mtk')
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{'../../../app-assets/js/scripts/data-tables.js'}}"></script>
@endsection
