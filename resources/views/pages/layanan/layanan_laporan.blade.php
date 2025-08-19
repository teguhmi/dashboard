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
                                <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Pelayanan Administrasi Akademik</span></h5>
                                <ol class="breadcrumbs mb-0">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('dashboardlayanan')}}">Layanan</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('layanan.laporan')}}">Laporan - Peragaan Data Layanan</a></li>
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
                                <p><strong>Laporan Berdasarkan Tanggal</strong></p>
                                <hr>
                                <br>
                                <div class="row">
                                    <div class="col s6 m12 l12">
                                        <label>
                                            <input name="radio" type="radio" value="tanggal" checked/>
                                            <span>Berdasarkan Tanggal</span>
                                        </label>
                                        <label>
                                            <input name="radio" type="radio" value="status">
                                            <span>Berdasarkan Status</span>
                                        </label>
                                    </div>
                                </div>
                                <form role="form" method="POST" action="{{ route('layanan.laporan.search') }}" id="form">
                                    @csrf
                                    <div class="row">
                                        <br>
                                        <div class="col s6 m2" id="awal">
                                            <input id="tanggal_awal" name="tanggal_awal" type="text">
                                            <label for="tanggal_akhir">Tanggal Awal</label>
                                        </div>
                                        <div class="col s6 m2 l2" id="akhir">
                                            <input id="tanggal_akhir" name="tanggal_akhir" type="text">
                                            <label for="tanggal_akhir">Tanggal Akhir</label>
                                        </div>
                                        <div class="col s12 m12 l12" id="st" hidden>
                                            <label for="st">Status</label>
                                            <select class="select2 browser-default" name="status" id="status">
                                                <option value="" disabled selected></option>
                                                @if (!empty($datastatus))
                                                    @foreach ($datastatus as $data)
                                                        <option value="{{$data->id_status}}"> {{$data->nama_status}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col s6 m2 l2" id="akhir">
                                            <button class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1" type="submit">
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
            @if(!empty($sql))
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
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                                <th>Penanggung Jawab</th>
                                                <th width="15%">Identitas Pelanggan</th>
                                                <th width="30%">Deskripsi</th>
                                                <th>Target Selesai</th>
                                                {{--                                                <th width="30%">Penyelesaian</th>--}}
                                                <th>Tanggal Selesai</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($sql as $data)
                                                <tr>
                                                    <td width="1%">
                                                        <a class="waves-effect waves-light btn {{$data->icon}}  z-depth-4 mr-1 mb-2"
                                                           href="{{route ('layanan.deskripsi.index_edit', ['id1'=> Crypt::encrypt($data->id_deskripsi) , 'id2' => Crypt::encrypt($data->id_data_dp)],'/editdeskripsi') }}"><i
                                                                class="material-icons"></i>{{$data->nama_status}}
                                                        </a>
                                                    </td>
                                                    <td>{{$data->tanggal}}</td>
                                                    <td>{{$data->nama_pj}}</td>
                                                    @if ($data->nim > 0 )
                                                        <td>{{$data->nim}} / {{$data->nama}}</td>
                                                    @else
                                                        <td>{{$data->nama}}</td>
                                                    @endif
                                                    <td>{{$data->deskripsi}}</td>
                                                    <td>{{$data->target_selesai}}</td>
                                                    {{--                                                    <td>{{$data->jawaban}}</td>--}}
                                                    <td>{{$data->status_user_date}}</td>

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
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script src="../../../app-assets/js/scripts/data-tables.js"></script>
    <script src="../../../app-assets/js/jquery.maskedinput.js"></script>
    {{--    public/app-assets/js/jquery.maskedinput.js--}}
    <script type="text/javascript">
        $('input[type="radio"]').click(function () {
            var inputValue = $(this).attr("value");
            if (inputValue == "status") {
                $("#awal").hide();
                $("#akhir").hide();
                $("#st").show();

            } else {
                $("#awal").show();
                $("#akhir").show();
                $("#st").hide();
            }
        });
        jQuery(function ($) {
            $("#tanggal_awal").mask("9999-99-99", {placeholder: "____-__-__"});
            $("#tanggal_akhir").mask("9999-99-99", {placeholder: "____-__-__"});
        });

    </script>
@endsection
