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

                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Pelayanan Administrasi Akademik</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('dashboardlayanan')}}">Layanan</a></li>
                                <li class="breadcrumb-item"><a href="{{route('layanan.laporan')}}">Laporan - Form ISO</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    @include('panels.bannerinfo')
                    <div id="report" class="card card-tabs">
                        <div class="card-content">
                            <div class="card-title">
                                <p><strong>Laporan Berdasarkan Tanggal</strong></p>
                                <hr>
                                <br>

                                <form role="form" method="POST" action="{{ route('layanan.laporan.iso.search') }}" id="form">
                                    @csrf
                                    <div class="row">
                                        <br>
                                        <div class="col s12 m4 l4" id="st">
                                            <label for="st">Status</label>
                                            <select class="select2 browser-default" name="iso" id="iso">
                                                <option value="rk20" @if(!empty($jenis))@if($jenis == "rk20") selected @endif @endif >JJ03-RK02-RII.0</option>
                                                <option value="rk21" @if(!empty($jenis))@if($jenis == "rk21") selected @endif @endif >JJ03-RK02-RII.1</option>
                                                <option value="rk60" @if(!empty($jenis))@if($jenis == "rk60") selected @endif @endif >JJ03-RK06-RII.0</option>
                                                <option value="rk61" @if(!empty($jenis))@if($jenis == "rk61") selected @endif @endif >JJ03-RK06-RII.1</option>

                                            </select>
                                        </div>
                                        <div class="col s6 m2" id="awal">
                                            <label for="tanggal_akhir">Tanggal Awal</label>
                                            <input id="tanggal_awal" name="tanggal_awal" type="text" required value=@if(!empty($awal)) {{$awal}} @endif>
                                        </div>
                                        <div class="col s6 m2 l2" id="akhir">
                                            <label for="tanggal_akhir">Tanggal Akhir</label>
                                            <input id="tanggal_akhir" name="tanggal_akhir" type="text" required value=@if(!empty($akhir)) {{$akhir}} @endif>
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
            @if(!empty($jenis))
                @if($jenis == 'rk20')
                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col s6 m6 l6">
                                            <h4 class="card-title">Laporan Layanan JJ03-RK02-RII.0 Periode Tanggal @if(!empty($awal)) {{strftime("%d %B %Y", strtotime($awal))}} @endif s/d @if(!empty($akhir)) {{strftime("%d %B %Y", strtotime($akhir))}} @endif</h4>
                                        </div>
                                        <div class="col s6 m6 l6">
                                            <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1 right" target="_blank"
                                               href="{{route ('layanan.laporan.iso.pdf', ['id1'=> Crypt::encrypt($jenis), 'id2'=> $awal, 'id3' =>$akhir]) }}">Cetak PDF
                                            </a>
                                        </div>
                                        <div class="row">
                                            <div class="col s12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                    <tr>
                                                        <td align="center" width="1%">No</td>
                                                        <td align="center" width="5%">Tanggal</td>
                                                        <td align="center" width="3%">No Keluhan</td>
                                                        <td align="center" width="4%">Asal (Nama/NIM/Instansi)</td>
                                                        <td align="center" width="15%">Isi Keluhan</td>
                                                        <td align="center" width="5%">PJ Keluhan</td>
                                                        <td align="center" width="4%">Target Selesai</td>
                                                        <td align="center" width="15%">Penyelesaian</td>
                                                        <td align="center" width="5%">Tanggal Selesai</td>
                                                        <td align="center" width="2%">Status</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php $no = 1;@endphp
                                                    @if (!empty($sql))
                                                        @foreach($sql as $data)
                                                            <tr height="40px" valign="top">
                                                                <td align="center" width="1%">{{$no++}}</td>
                                                                <td align="center" width="5%">{{$data->tanggal}}</td>
                                                                <td width="3%">{{$data->id_deskripsi}}</td>
                                                                <td width="4%">{{$data->nim}} <br>{{$data->nama}}</td>
                                                                <td width="15%">{{$data->deskripsi}}</td>
                                                                <td width="5%">{{$data->nama_pj}}</td>
                                                                <td width="4%"></td>
                                                                <td width="15%">{{$data->jawaban}}</td>
                                                                {{--                <td>{{strftime("%d %B %Y", strtotime($data->jawaban_user_date))}}</td>--}}
                                                                <td align="center" width="5%">{{$data->jawaban_user_date}}</td>
                                                                <td align="center" width="2%">{{$data->nama_status}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if($jenis == 'rk21')
                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col s6 m6 l6">
                                            <h4 class="card-title">Laporan Layanan JJ03-RK02-RII.1 Periode Tanggal @if(!empty($awal)) {{strftime("%d %B %Y", strtotime($awal))}} @endif s/d @if(!empty($akhir)) {{strftime("%d %B %Y", strtotime($akhir))}} @endif</h4></h4>
                                        </div>
                                        <div class="col s6 m6 l6">
                                            <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1 right" target="_blank"
                                               href="{{route ('layanan.laporan.iso.pdf', ['id1'=> Crypt::encrypt($jenis), 'id2'=> $awal, 'id3' =>$akhir]) }}">Cetak PDF
                                            </a>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                    <tr>
                                                        <td align="center" width="2%">No</td>
                                                        <td align="center" width="2%">Tanggal</td>
                                                        <td align="center" width="3%">No Keluhan</td>
                                                        <td align="center" width="4%">Asal (Nama/NIM/Instansi)</td>
                                                        <td align="center" width="10%">Isi Keluhan</td>
                                                        <td align="center" width="5%">PJ Keluhan</td>
                                                        <td align="center" width="4%">Target Selesai</td>
                                                        <td align="center" width="10%">Penyelesaian</td>
                                                        <td align="center" width="5%">Tanggal Selesai</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php $no = 1;@endphp
                                                    @if (!empty($sql))
                                                        @foreach($sql as $data)
                                                            <tr height="40px" valign="top">
                                                                <td align="center">{{$no++}}</td>
                                                                <td align="center">{{$data->tanggal}}</td>
                                                                <td>{{$data->id_deskripsi}}</td>
                                                                <td>
                                                                    {{$data->nama_asal}}<br> {{$data->nim}} <br>{{$data->nama}}
                                                                </td>
                                                                <td>{{$data->deskripsi}}</td>
                                                                <td>{{$data->nama_pj}}</td>
                                                                <td></td>
                                                                <td>{{$data->jawaban}}</td>
                                                                {{--                <td>{{strftime("%d %B %Y", strtotime($data->jawaban_user_date))}}</td>--}}
                                                                <td align="center">{{$data->jawaban_user_date}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if($jenis == 'rk60')
                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col s6 m6 l6">
                                            <h4 class="card-title">Laporan Layanan JJ03-RK06-RII.0 Periode Tanggal @if(!empty($awal)) {{strftime("%d %B %Y", strtotime($awal))}} @endif s/d @if(!empty($akhir)) {{strftime("%d %B %Y", strtotime($akhir))}} @endif</h4></h4>
                                        </div>
                                        <div class="col s6 m6 l6">
                                            <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1 right" target="_blank"
                                               href="{{route ('layanan.laporan.iso.pdf', ['id1'=> Crypt::encrypt($jenis), 'id2'=> $awal, 'id3' =>$akhir]) }}">Cetak PDF
                                            </a>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                    <tr>
                                                        <td align="center" width="2%">No</td>
                                                        <td align="center" width="8%">Tanggal</td>
                                                        <td align="center" width="3%">No Keluhan</td>
                                                        <td align="center" width="8%">Asal (Nama/NIM/Instansi)</td>
                                                        <td align="center" width="16%">Permintaan Layanan/Isi Keluhan</td>
                                                        <td align="center" width="5%">PJ Terkait</td>
                                                        <td align="center" width="4%">Target Selesai</td>
                                                        <td align="center" width="16%">Penyelesaian</td>
                                                        <td align="center" width="8%">Tanggal Selesai</td>
                                                        <td align="center" width="4%">Asal Keluhan</td>
                                                        <td align="center" width="4%">Status</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php $no = 1;@endphp
                                                    @if (!empty($sql))
                                                        @foreach($sql as $data)
                                                            <tr height="40px" valign="top">
                                                                <td align="center">{{$no++}}</td>
                                                                <td align="center">{{$data->tanggal}}</td>
                                                                <td>{{$data->id_deskripsi}}</td>
                                                                <td>{{$data->nim}} <br>{{$data->nama}}</td>
                                                                <td>{{$data->deskripsi}}</td>
                                                                <td>{{$data->nama_pj}}</td>
                                                                <td></td>
                                                                <td>{{$data->jawaban}}</td>
                                                                <td align="center">{{$data->jawaban_user_date}}</td>
                                                                <td align="center">{{$data->nama_asal}}</td>
                                                                <td align="center">{{$data->nama_status}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if($jenis == 'rk61')
                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col s6 m6 l6">
                                            <h4 class="card-title">Laporan Layanan JJ03-RK06-RII.1 Periode Tanggal @if(!empty($awal)) {{strftime("%d %B %Y", strtotime($awal))}} @endif s/d @if(!empty($akhir)) {{strftime("%d %B %Y", strtotime($akhir))}} @endif</h4>
                                        </div>
                                        <div class="col s6 m6 l6">
                                            <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1 right" target="_blank"
                                               href="{{route ('layanan.laporan.iso.pdf', ['id1'=> Crypt::encrypt($jenis), 'id2'=> $awal, 'id3' =>$akhir]) }}">Cetak PDF
                                            </a>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                    <tr>
                                                        <td align="center" width="2%">No</td>
                                                        <td align="center" width="8%">Tanggal</td>
                                                        <td align="center" width="8%">(Nama/NIM/Instansi)</td>
                                                        <td align="center" width="16%">Permintaan Layanan/Isi Keluhan</td>
                                                        <td align="center" width="4%">Proses Layanan</td>
                                                        <td align="center" width="5%">Penyelesaian</td>
                                                        <td align="center" width="8%">Tanggal Selesai</td>
                                                        <td align="center" width="10%">Nama</td>
                                                        <td align="center" width="8%">Paraf</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php $no = 1;@endphp
                                                    @if (!empty($sql))
                                                        @foreach($sql as $data)
                                                            <tr height="40px" valign="top">
                                                                <td align="center">{{$no++}}</td>
                                                                <td align="center">{{$data->tanggal}}</td>
                                                                <td>{{$data->nim}} <br>{{$data->nama}}</td>
                                                                <td>{{$data->deskripsi}}</td>
                                                                <td>{{$data->nama_status}}</td>
                                                                <td>{{$data->jawaban}}</td>
                                                                <td align="center">{{$data->jawaban_user_date}}</td>
                                                                <td>{{$data->jawaban_user_create}}</td>
                                                                <td></td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script src="../../../app-assets/js/scripts/data-tables.js"></script>
    <script src="../../../app-assets/js/jquery.maskedinput.js"></script>
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
