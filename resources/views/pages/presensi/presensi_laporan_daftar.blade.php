@extends('pages.dashboardpresensi')
@section('head')

@endsection
<!-- Form with validation -->

@section('content')
    <div id="main">
        <div class="row">
            <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6 breadcrumbs-left">
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Presensi Kegiatan</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('presensi.dashboard')}}">Presensi</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('presensi.laporan.daftar')}}">Daftar Peserta</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @include('panels.bannerinfo')
            <div class="col s12">
                <div class="container">
                    <div class="card">
                        <div class="card-content"><h4 class="card-title">Jenis Kegiatan {{config('app.upbjj')}}</h4>
                            <form role="form" method="POST" action="{{ route('presensi.laporan.daftar.cari') }}" id="form">
                                @csrf
                                <div class="row tooltipped" data-position="center" data-tooltip="Pilih jenis kegiatan">
                                    <div class="input-field col s12">
                                        <select name="id" id="id">
                                            <option value="" disabled selected>Pilih Jenis Kegiatan</option>
                                            @if (!empty($getKegiatanAll))
                                                @foreach ($getKegiatanAll as $data)
                                                    <option value="{{$data->id_kegiatan}}"> {{$data->nama_kegiatan}} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input type="hidden" value="daftar" name="jenis" id="jenis">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="waves-effect waves-light  btn gradient-45deg-green-teal box-shadow-none border-round mr-1 mb-1 " type="submit" name="action">Lihat Peserta
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($DaftarPeserta))
                <div class="col s12">
                    <div class="container">
                        <div class="section section-data-tables">
                            <div class="card">
                                <div id="button-trigger" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <div class="col s11">
                                            <h4 class="card-title">Data Peserta | {{$DaftarPeserta[0]->nama_kegiatan}}</h4>
                                        </div>
                                        @if ((Auth::check()))
                                            <div class="col s1 float-right">
                                                <a class="float-right waves-effect waves-light btn gradient-45deg-green-teal box-shadow-none border-round mr-1 mb-1"
                                                   href="{{route('presensi.laporan.daftar.excel', ['id' => Crypt::encrypt($DaftarPeserta[0]->id_kegiatan)]) }}">Excel
                                                </a>
                                            </div>
                                        @endif
                                        <p></p>
                                        <div class="row">
                                            <div class="col s12">
                                                <hr>
                                                <table id="page-length-option" class="display">
                                                    <br>
                                                    <thead>
                                                    <tr>
                                                        {{--                                                        <th>No</th>--}}
                                                        <th>Nama</th>
                                                        <th>NIM</th>
                                                        <th>Program Studi</th>
                                                        @auth
                                                            <th> Nomor Telepon</th>
                                                        @endauth
                                                        <th>Institusi</th>
                                                        <th>Jam Presensi</th>
                                                        @auth()
                                                            <th>Option</th>
                                                        @endauth
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @foreach($DaftarPeserta as $data)
                                                        <tr>
                                                            {{--                                                            <td width="2%">{{$no++}}</td>--}}
                                                            <td width="25%">{{$data->nama}}</td>
                                                            <td width="10%">{{$data->nim}}</td>
                                                            <td width="25%">{{$data->nama_program_studi}}</td>
                                                            @auth
                                                                <td width="10%"> {{$data->telepon}}</td>
                                                            @endauth
                                                            <td width="25%">{{$data->institusi}}</td>
                                                            <td width="10%">{{$data->user_date_create}}</td>
                                                           @auth()
                                                                <td>
                                                                    <a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-amber"
                                                                       href="{{route('presensi.laporan.hapus.peserta', ['id' => Crypt::encrypt($data->id_presensi)]) }}"><i class="material-icons">delete_forever</i>
                                                                    </a>
                                                                </td>
                                                            @endauth
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
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script src="{{url('app-assets/js/scripts/data-tables.js')}}"></script>

@endsection
