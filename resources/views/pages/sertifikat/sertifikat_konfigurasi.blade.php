@extends('pages.dashboardsertifikat')
@section('head')

@endsection

@section('content')

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6 breadcrumbs-left">
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Sertifikat</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('sertifikat.dashboard')}}">Sertifikat</a>
                                </li>
                                <li class="breadcrumb-item"><a>Konfigurasi</a>
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
                        <div class="card-content">
                            <p class="caption mb-0">


                                <button class="waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1 modal-trigger"
                                        href="#kegiatanmodal" onclick="baru()">Tambah Kegiatan
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Length Options -->
        @if(!empty($getSertifikat))
            {{--            <div class="row">--}}
            <div class="col s12">
                <div class="container">
                    <div class="section section-data-tables">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div id="button-trigger" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">Data Sertifikat
                                        </h4>
                                        <div class="row">
                                            <div class="col s12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                    <tr>
                                                        <th width="2%">Jenis Kegiatan</th>
                                                        <th width="30%">Nama Kegiatan</th>
                                                        <th width="5%">ID Sertifikat</th>
                                                        <th width="5%">XY Nama</th>
                                                        <th width="5%">XY Sebagai</th>
                                                        <th>Warna</th>
                                                        <th>Unggah File</th>
                                                        <th>File Depan</th>
                                                        <th>File Belakang</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp

                                                    @foreach($getSertifikat as $data)
                                                        <tr>
                                                            <td>{{$data->jenis_kegiatan}}</td>
                                                            <td>{{$data->nama_kegiatan}}</td>
                                                            <td align="center">{{$data->id_sertifikat}}</td>
                                                            <td>{{$data->xy_nama}}</td>
                                                            <td>{{$data->xy_sebagai}}</td>
                                                            <td>{{$data->color}}</td>
                                                            <td>
                                                                <button title="Unggah File template {{ $data->nama_kegiatan}}" class="mb-6 btn-floating waves-effect gradient-45deg-purple-light-blue modal-trigger"
                                                                        href="#uploadtemplate" onclick="uploadtemplate('{{Crypt::encrypt($data->id_sertifikat)}}')">
                                                                    <i class="material-icons">cloud_upload</i>
                                                                </button>
                                                            </td>
                                                            <td>
                                                                @if($data->nama_file_1 > 0)
                                                                    @if (file_exists(public_path('storage/template_seminar/' . $data->nama_file_1)))
                                                                        <a title="Melihat File Template" class="mb-6 btn-floating waves-effect gradient-45deg-purple-light-blue"
                                                                           href="{{route ('sertifikat.preview', ['id1' => Crypt::encrypt($data->nama_file_1), 'id2' =>'sertifikattemplate']) }}">
                                                                            <i class="material-icons">visibility</i>
                                                                        </a>
                                                                        <a title="Menghapus File Sisi Depan" class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-amber"
                                                                           href="{{route ('sertifikat.hapusfilesertifikat', ['id1' => Crypt::encrypt($data->id_sertifikat)
                                                                        , 'id2' =>Crypt::encrypt($data->nama_file_1)
                                                                        , 'id3' =>'file_1'])
                                                                        , '/hapusfilesertifikat' }}"
                                                                           onclick="return confirm('Hapus File Sisi Depan ?');">
                                                                            <i class="material-icons">delete_forever</i>
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($data->nama_file_2 > 0)
                                                                    @if (file_exists(public_path('storage/template_seminar/' . $data->nama_file_2)))
                                                                        <a title="Melihat File Template" class="mb-6 btn-floating waves-effect gradient-45deg-purple-light-blue"
                                                                           href="{{route ('sertifikat.preview', ['id1' => Crypt::encrypt($data->nama_file_2), 'id2' =>'sertifikattemplate']) }}">
                                                                            <i class="material-icons">visibility</i>
                                                                        </a>
                                                                        <a title="Menghapus File Sisi Depan" class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-amber"
                                                                           href="{{route ('sertifikat.hapusfilesertifikat', ['id1' => Crypt::encrypt($data->id_sertifikat)
                                                                        , 'id2' =>Crypt::encrypt($data->nama_file_2)
                                                                        , 'id3' =>'file_2'])
                                                                        , '/hapusfilesertifikat' }}"
                                                                           onclick="return confirm('Hapus File Sisi Belakang ?');">
                                                                            <i class="material-icons">delete_forever</i>
                                                                        </a>

                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @auth
                                                                    <a title="Menghapus Data {{ $data->nama_kegiatan}} " class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-amber"
                                                                       href="{{route ('sertifikat.hapus.conf', ['id_sertifikat'=> Crypt::encrypt($data->id_sertifikat)],'/hapusconf') }}"
                                                                       onclick="return confirm('Hapus Kegiatan {{$data->nama_kegiatan}} ?');"><i class="material-icons">delete_forever</i>
                                                                    </a>
                                                                    <button title="Merubah Data {{ $data->nama_kegiatan}}" class=" mb-6 btn-floating waves-effect waves-light gradient-45deg-blue-grey-blue modal-trigger"
                                                                            href="#kegiatanmodal" onclick="edit('{{ $data->id_sertifikat}}'
                                                                        ,'{{ $data->jenis_kegiatan}}'
                                                                        ,'{{ $data->nama_kegiatan}}'
                                                                        ,'{{ $data->xy_nama}}'
                                                                        ,'{{$data->xy_sebagai}}'
                                                                        ,'{{$data->color}}'
                                                                        )"><i class="material-icons">edit</i>
                                                                    </button>
                                                                @endauth
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
                </div>
            </div>
        @endif
    </div>
    @include('pages.sertifikat.sertifikat_konfigurasi_input_modal')

@endsection
@section('script')


    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('app-assets/vendors/formatter/jquery.formatter.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/form-masks.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/data-tables.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/advance-ui-modals.js')}}"></script>
    <script type="text/javascript">

        function edit(id_sertifikat, jenis_kegiatan, nama_kegiatan, xy_nama, xy_sebagai, warna) {
            $('#id_sertifikat').val(id_sertifikat);
            $('#jenis_kegiatan').val(jenis_kegiatan);
            $('#nama_kegiatan').val(nama_kegiatan);
            $('#xy_nama').val(xy_nama);
            $('#xy_sebagai').val(xy_sebagai);
            $('#warna').val(warna);
        }

        function baru() {
            $('#id_sertifikat').val('');
            $('#jenis_kegiatan').val('');
            $('#nama_kegiatan').val('');
            $('#xy_nama').val('');
            $('#xy_sebagai').val('');
            $('#warna').val('');
        }

        function uploadtemplate(id_sertifikat) {
            $('#mid_sertifikat').val(id_sertifikat);
        }


        $('#kegiatanmodal').on('hidden.bs.modal', function () {
            $('#kegiatanmodal form')[0].reset();
        });
    </script>
@endsection
