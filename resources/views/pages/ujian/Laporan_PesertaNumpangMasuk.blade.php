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
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Laporan Numpang Ujian Masuk</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('dashboardlayanan')}}">Layanan</a></li>
                                <li class="breadcrumb-item"><a href="{{route('ujian.laporannumpang')}}">Laporan Numpang Ujian Masuk</a></li>
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
                                    <h4 class="card-title">Laporan Peserta Menumpang Ujian {{config('app.upbjj')}}</h4>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col s12">
                                            <form role="form" method="post" action="{{route('ujian.laporannumpangmasuk.cari')}}" id="form">
                                                @csrf

{{--                                                <div class="row">--}}
{{--                                                    <div class="col s6 m12 l12">--}}
{{--                                                        <label>--}}
{{--                                                            <input name="radio" type="radio" value="jumlah" checked/>--}}
{{--                                                            <span>Jumlah Matakuliah</span>--}}
{{--                                                        </label>--}}
{{--                                                        <label>--}}
{{--                                                            <input name="radio" type="radio" value="daftar">--}}
{{--                                                            <span>Daftar Mahasiswa</span>--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <br>--}}
                                                <div class="row">
                                                    @if(!empty($masa))
                                                        <div class="col s12 m4 l4">
                                                            <label for="masa">Masa</label>
                                                            <select class="select2 browser-default" name="masa" id="masa">
                                                                <option value='' disabled selected></option>
                                                                @foreach ($masa as $row)
                                                                    <option value="{{$row->masa}}"> {{$row->masa}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    @endif
                                                    <div class="col s12 m4 l4">
                                                        <label for="tgl_awal">Tanggal Awal</label>
                                                        <input placeholder="" id="tgl_awal" name="tgl_awal" type="text" class="datepicker" required>
                                                    </div>
                                                    <div class="col s12 m4 l4">
                                                        <label for="tgl_akhir">Tanggal Akhir</label>
                                                        <input placeholder="" id="tgl_akhir" name="tgl_akhir" type="text" class="datepicker" required>
                                                    </div>
                                                </div>
                                                <button class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb-2">Cari</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <div class="col s12">--}}
                                @include('pages.ujian.DataTableJumlahMatakuliahUjianMasuk')
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{'../../../app-assets/js/scripts/data-tables.js'}}"></script>
    $(".datepicker").datepicker({
    format: "yyyy-mm-dd"
    });
@endsection
