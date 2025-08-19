@extends('pages.dashboardlayanan')
@section('head')

@endsection
@section('content')

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-2" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6 breadcrumbs-left">
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Data Layanan</span>
                            </h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('dashboardlayanan')}}">Layanan</a></li>
                                <li class="breadcrumb-item"><a href="{{route('layanan.data.asal')}}">Data Layanan</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @include('panels.bannerinfo')
            <div class="col s12">
                <div class="container">
                    <div class="card">
                        <div class="card-content">
                            <p class="caption mb-0">
                                <a class="waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1 modal-trigger"
                                   data-toggle="modal" href="{{route('layanan.formulir')}}">Tambah Data
                                </a>
                                <a class="waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1 right"
                                   data-toggle="modal" href="{{route('layanan.deskripsi.index')}}">Refresh
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Length Options -->
            @if(!empty($dp))
                <div class="col s12 m12 l12">
                    <div class="container">
                        <div class="section section-data-tables">
                            <div id="button-trigger" class="card card card-default scrollspy">
                                <div class="card-content">
                                    <h4 class="card-title">Daftar Layanan Belum ada Deskripsi</h4>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table id="data-table-simple" class="display">
                                                <thead>
                                                <tr>
                                                    <th width="1%">No</th>
                                                    <th width="20%">Nama</th>
                                                    <th width="10%">Telepon</th>
                                                    <th width="20%">Nama Pembuat</th>
                                                    <th width="10%">Tanggal</th>
                                                    <th width="1%">Opsi</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach($dp as $data)
                                                    <tr>
                                                        <td>{{$no++}}</td>
                                                        <td>{{$data->nama}}</td>
                                                        <td>{{$data->telepon}}</td>
                                                        <td>{{$data->user_create}}</td>
                                                        <td>{{$data->user_date_create}}</td>

                                                        <td width="1%">
                                                            <a class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb-2"
                                                               href="{{route ('layanan.formulir.refresh', ['id_data_dp'=> $data->id_data_dp],'/refresh') }}"><i
                                                                    class="material-icons"></i> Ubah
                                                            </a>
                                                        </td>
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
            @endif
            @if(!empty($deskripsi))
                <div class="col s12 m12 l12">
                    <div class="container">
                        <div class="section section-data-tables">
                            <div id="button-trigger" class="card card card-default scrollspy">
                                <div class="card-content">
                                    <h4 class="card-title">Layanan dan Keluhan</h4>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table id="page-length-option" class="display">
                                                <thead>
                                                <tr>
                                                    {{--                                                    <th width="1%">No</th>--}}
                                                    <th width="5%">Status</th>
                                                    <th width="10%">Kategori</th>
                                                    <th width="10%">Disposisi</th>
                                                    <th width="10%">Nama User</th>
                                                    <th width="5%">Tanggal</th>
                                                    <th width="40%">Deskripsi Layanan</th>
                                                    <th width="%">Akar Permasalahan</th>
                                                    <th width="%">Jawaban</th>
                                                    {{--                                                    <th width="1%">Opsi</th>--}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach($deskripsi as $data)
                                                    <tr>
                                                        {{--                                                        <td>{{$no++}}</td>--}}
                                                        <td width="1%">
                                                            <a class="waves-effect waves-light btn {{$data->icon}} z-depth-4 mr-1 mb-2"
                                                               href="{{route ('layanan.deskripsi.index_edit', ['id1'=> Crypt::encrypt($data->id_deskripsi) , 'id2' => Crypt::encrypt($data->id_data_dp)],'/editdeskripsi') }}"><i
                                                                    class="material-icons"></i>{{$data->nama_status}}
                                                            </a>
                                                        </td>
                                                        <td>{{$data->nama_kategori}}</td>
                                                        <td>{{$data->nama_pj}}</td>
                                                        <td>{{$data->deskripsi_user_create}}</td>
                                                        <td>{{strftime("%d-%m-%Y", strtotime($data->deskripsi_user_date))}}</td>
                                                        <td>{{$data->deskripsi}}</td>
                                                        <td>{{$data->penyebab}}</td>
                                                        <td>{{$data->jawaban}}</td>
                                                        {{--                                                        <td>{{$data->nama_status}}</td>--}}
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
            @endif
        </div>
    </div>

@endsection
@section('script')
    <!-- BEGIN PAGE VENDOR JS-->
    {{--    <script src="../../../app-assets/vendors/formatter/jquery.formatter.min.js"></script>--}}
    {{--    <script src="../../../app-assets/js/scripts/form-masks.js"></script>--}}
    <script src="{{url('app-assets/js/scripts/data-tables.js')}}"></script>
    <script type="text/javascript">
        function edit(id_pj, nama_pj) {
            $('#id_pj').val(id_pj);
            $('#nama_pj').val(nama_pj);
        }
    </script>
@endsection
