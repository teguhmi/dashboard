@extends('pages.dashboardsertifikat')
@section('head')

@endsection

@section('content')

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
                                <li class="breadcrumb-item"><a>Cari</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        @include('panels.bannerinfo')
        <!-- Select -->
            <div class="row">
                <div class="col s12">
                    <div class="container">
                        <div class="section">
                            <div class="card">
                                <div class="card-content">
                                    <a class="waves-effect waves-light btn gradient-45deg-indigo-blue box-shadow-none border-round mr-1 mb-1 right"
                                       href="{{secure_url('storage/format_sertifikat.xlsx')}}" download>Contoh File
                                    </a>
                                    <button class="waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1 right modal-trigger" href="#import">Import Peserta</button>
                                    <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1 right modal-trigger" href="#peserta">Tambah Peserta</button>
                                    <p class="caption">Catatan: Gunakan menu ini untuk menambahkan peserta..</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <div id="select" class="card card-tabs">
                                        <div class="card-content">
                                            <div class="card-title">
                                                <div class="row">
                                                    <div class="col s12 m6 l10">
                                                        <h4 class="card-title">Select</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="view-select">
                                                <form role="form" method="POST" action="{{ route('sertifikat.import.select') }}" id="form">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <select name="option" id="option">
                                                                <option value="" disabled selected>Jenis Kegiatan</option>
                                                                @if (!empty($getSertifikat))
                                                                    @foreach ($getSertifikat as $data)
                                                                        <option value="{{$data->id_sertifikat}}"
                                                                            {{ $id_sertifikat  == $data->id_sertifikat ? 'selected="selected"' : '' }}>{{$data->jenis_kegiatan}} : {{$data->nama_kegiatan}} </option>
                                                                    @endforeach

                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <button class="waves-effect waves-light  btn gradient-45deg-green-teal box-shadow-none border-round mr-1 mb-1 right" type="submit" name="action">Lihat Data
                                                                    <i class="material-icons right">send</i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(!empty($hasil))
                    <div class="col s12">
                        <div class="container">
                            <div class="section section-data-tables">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <div id="button-trigger" class="card card card-default scrollspy">
                                            <div class="card-content">
                                                <h4 class="card-title">Data Sertifikat</h4>
                                                <div class="row">
                                                    <div class="col s12">
                                                        <table id="page-length-option" class="display">
                                                            <thead>
                                                            <tr>
                                                                {{--                                                            <th>No</th>--}}
                                                                <th>Nama</th>
                                                                <th>Jenis Kegiatan</th>
                                                                <th>Judul / Nama Kegiatan</th>
                                                                {{--                                                    <th>Institusi</th>--}}
                                                                <th>Sebagi</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @php
                                                                $no = 1;
                                                            @endphp
                                                            @foreach($hasil as $data)
                                                                <tr>
                                                                    {{--                                                                <td width="1%">{{$no++}}</td>--}}
                                                                    <td width="20%">{{$data->nama}}</td>
                                                                    <td>{{$data->jenis_kegiatan}}</td>
                                                                    <td>{{$data->nama_kegiatan}}</td>
                                                                    {{--                                                        <td width="15%">{{$data->institusi}}</td>--}}
                                                                    <td width="5%">{{$data->sebagai}}</td>
                                                                    <td>
                                                                        <a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-indigo-light-blue"
                                                                           href="{{route('sertifikat.pdf', ['id' => Crypt::encrypt($data->id)],'/pdf') }}" target="_blank"><i class="material-icons">print</i>
                                                                        </a>
                                                                        @auth
                                                                            <a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-amber"
                                                                               href="{{route ('sertifikat.hapus.peserta', ['id' => Crypt::encrypt($data->id),'id_sertifikat'=> Crypt::encrypt($data->id_sertifikat)],'/hapuspeserta') }}"
                                                                               onclick="return confirm('Hapus Data Peserta {{$data->nama}} ?');"><i class="material-icons">delete_forever</i>
                                                                            </a>
                                                                            {{--                                                                <a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-amber"--}}
                                                                            {{--                                                                   href="{{route('sertifikat.pdf', ['id' => Crypt::encrypt($data->id)],'/pdf') }}" target="_blank"><i class="material-icons">edit</i>--}}
                                                                            {{--                                                                </a>--}}
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
        </div>
    </div>

    <!-- Modal Import -->
    <div id="import" class="modal">
        <form action="{{ route('sertifikat.excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <p>Pilih file yang akan di unggah</p>
                <div class="file-field input-field">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" name="file" required>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-action modal-close waves-effect waves-light btn gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1 ">Tutup</button>
                <button type="submit" class="modal-action modal-close waves-effect waves-light btn gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1 ">Import</button>
            </div>
        </form>
    </div>
    <!-- End Modal Import -->

    <!-- Modal peserta -->
    <div id="peserta" class="modal">
        <form action="{{ route('sertifikat.new.peserta') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Form with placeholder -->
            <div class="modal-content">
                <div class="col s12 m12 l6">
                    {{--                    <div id="placeholder" class="card card card-default scrollspy">--}}
                    <div class="card-content">
                        <h4 class="card-title">Data Peserta</h4>
                        <div class="row">
                            <div class="input-field col s12">
                                <select name="id_sertifikat" id="id_sertifikat" required>
                                    <option value="" disabled selected>Jenis Kegiatan</option>
                                    @if (!empty($getSertifikat))
                                        @foreach ($getSertifikat as $data)
                                            <option value="{{$data->id_sertifikat}}"
                                                {{ $id_sertifikat  == $data->id_sertifikat ? 'selected="selected"' : '' }}>{{$data->jenis_kegiatan}} : {{$data->nama_kegiatan}} </option>
                                        @endforeach

                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m3 s12">
                                <label for="nim">NIM</label>
                                <input placeholder="NIM mahasiswa UT" id="nim" name="nim" type="text">
                            </div>
                            <div class="input-field col m9 s12">
                                <input placeholder="Perhatikan ejaan penulisan, akan tercetak pada sertifikat" id="nama" name="nama" type="text" required>
                                <label for="nama">Nama Peserta</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m4 s12">
                                <label for="institusi">Nama Institusi</label>
                                <input placeholder="Institusi" id="institusi" name="institusi" type="text">
                            </div>
                            <div class="input-field col m4 s12">
                                <label for="hp">Nomor Handphone</label>
                                <input placeholder="Nomor HP" id="hp" name="hp" type="text">
                            </div>
                            <div class="input-field col m4 s12">
                                <select name="sebagai" id="sebagai" required>
                                    <option value="" disabled selected>Sebagai?</option>
                                    <option value="PESERTA">PESERTA</option>
                                    <option value="PANITIA">PANITIA</option>
                                    <option value="NARASUMBER">NARASUMBER</option>
                                    <option value="PENYAJI">PENYAJI</option>
                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- End Modal peserta -->
@endsection
@section('script')

    <script>
        $('#peserta').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        });

        $("#nim").keyup(function () {
            var id = $('#nim').val();
            var length = this.value.length;
            if (length >= 9) {
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: "{{ secure_url('/srs/GetDP') }}",
                    data: {_token: "{{ csrf_token() }}", nim: id},
                    success: function (result) {
                        $('.modal-content #nama').prop('readonly', true); //disable
                        $('.modal-content #nama').val(result.nama_mahasiswa);

                    }
                })
            }
            if (length < 9) {
                $('.modal-content #nama').prop('readonly', false); //disable
                $('.modal-content #nama').val('');
            }
        });
    </script>
    <script src="{{url('app-assets/js/scripts/data-tables.js')}}"></script>
    <script src="{{url('app-assets/js/scripts/advance-ui-modals.js')}}"></script>
@endsection
