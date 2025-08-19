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
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Pelayanan Administrasi Akademik 1</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboardlayanan')}}">Layanan</a></li>
                                <li class="breadcrumb-item"><a href="{{route('layanan.laporan')}}">Laporan  Peragaan Data Layanan</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <div id="report" class="card card-tabs">
                        <div class="card-content">
                            <div class="card-title">
                                <div class="row">
                                    {{--                                    <div class="col s12 m12 l12">--}}
                                    {{--                                        <h4 class="card-title">Layanan Administrasi Akademik</h4>--}}
                                    {{--                                        <hr>--}}
                                    {{--                                    </div>--}}
                                    <div class="col s12">
                                        <p>Pilih laporan berdasarkan </p>
                                        <hr>

                                        <p>

                                            <label>
                                                <input name="radio" type="radio" checked/>
                                                <span>Laporan Berdasarkan Tanggal</span>
                                            </label>
                                        </p>
                                        <label>
                                            <input name="radio" type="radio"/>
                                            <span>Laporan Berdasarkan Bulan</span>
                                        </label>
                                        <br>
                                        <label>
                                            <input name="radio" type="radio"/>
                                            <span>Laporan Berdasarkan Tahun</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--            </div>--}}
                {{--        </div>--}}
                {{--            </div>--}}
                {{--        <div class="row">--}}
                <div class="col s12 m12 l12">
                    <div class="section section-data-tables">
                        <div id="button-trigger" class="card card card-default scrollspy">
                            <div class="card-content">
                                <h4 class="card-title">Layanan dan Keluhan</h4>
                                <div class="row">
                                    <div class="col s12">
                                        {{--                                    <h4 class="card-title">Data Sertifikat</h4>--}}
                                        <table id="page-length-option" class="display">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th width="15%">Identitas Pelanggan</th>
                                                <th width="30%">Deskripsi</th>
                                                <th>PJ</th>
                                                <th>Target Selesai</th>
                                                <th>Penyelesaian</th>
                                                <th>No Layanan</th>
                                                <th>Status</th>
                                                <th>Tanggal Selesai</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach($query as $data)
                                                <tr>
                                                    <td width="1%">{{$no++}}</td>
                                                    <td>{{$data->tanggal}}</td>
                                                    @if ($data->nim > 0 )
                                                        <td>{{$data->nim}} / {{$data->nama}}</td>
                                                    @else
                                                        <td>{{$data->nama}}</td>
                                                    @endif
                                                    <td>{{$data->deskripsi}}</td>
                                                    <td>{{$data->nama_pj}}</td>
                                                    <td>{{$data->target_selesai}}</td>
                                                    <td>{{$data->jawaban}}</td>
                                                    <td>{{$data->id_deskripsi}}</td>
                                                    <td>{{$data->nama_status}}</td>
                                                    <td>{{$data->jawaban_user_date}}</td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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
@section('script')
    <script src="../../../app-assets/js/scripts/data-tables.js"></script>
@endsection
