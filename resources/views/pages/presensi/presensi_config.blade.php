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
                                <li class="breadcrumb-item"><a href="{{route('presensi.dashboard')}}">presensi</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('presensi.conf')}}">Jadwal Kegiatan</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @include('panels.bannerinfo')
            @if(empty($getDataKonfigurasi))
                <div class="col s12">
                    <div class="container">
                        <div class="card">
                            <div class="card-content">
                                <p class="caption mb-0">
                                    <button class="waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1 modal-trigger"
                                            data-toggle="modal" href="#kegiatanmodal">Tambah Kegiatan
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($getDataKonfigurasi))
                <div class="col s12">
                    <div class="container">
                        <div class="section section-data-tables">
                            <div class="card">
                                <div id="button-trigger" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <div class="col s10">
                                            <h4 class="card-title">Konfigurasi Presensi</h4>
                                        </div>
                                        <div class="col s2 float-right">
                                            <button class="float-right waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1 modal-trigger"
                                                    data-toggle="modal" href="#kegiatanmodal">Tambah Kegiatan
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col s12">
                                                <hr>
                                                <table id="page-length-option" class="display">
                                                    <br>
                                                    <thead>
                                                    <tr>
                                                        {{--                                                        <th>No</th>--}}
                                                        <th>Nama Kegiatan</th>
                                                        <th>Masa</th>
                                                        <th>Tanggal Buka</th>
                                                        <th>Tanggal Tutup</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @foreach($getDataKonfigurasi as $data)
                                                        <tr>
                                                            {{--                                                            <td width="1%">{{$no++}}</td>--}}
                                                            <td width="50%">{{$data->nama_kegiatan}}</td>
                                                            <td width="1%">{{$data->masa}}</td>
                                                            <td width="10%">{{$data->tanggal_buka}}</td>
                                                            <td width="10%">{{$data->tanggal_tutup}}</td>
                                                            <td width="5%">
                                                                @auth
                                                                    <button title="Merubah Data " class=" mb-6 btn-floating waves-effect waves-light gradient-45deg-blue-grey-blue modal-trigger"
                                                                            href="#kegiatanmodal" onclick="edit('{{  Crypt::encrypt($data->id_kegiatan)}}'
                                                                        ,'{{ $data->id_jenis_kegiatan}}'
                                                                        ,'{{ $data->nama_kegiatan}}'
                                                                        ,'{{ $data->masa}}'
                                                                        ,'{{ $data->tanggal_buka}}'
                                                                        ,'{{ $data->tanggal_tutup}}'
                                                                        )"><i class="material-icons">edit</i>
                                                                    </button>
                                                                    <a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-amber"
                                                                       href="{{route('presensi.conf.delete', ['id' => Crypt::encrypt($data->id_kegiatan)]) }}"
                                                                       onclick="return confirm('Hapus Presensi ?');"><i class="material-icons">delete_forever</i>
                                                                    </a>
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
            @endif
        </div>
    </div>
    <div id="kegiatanmodal" class="modal">
        <div class="modal-dialog">
            <div class="col s12">
                <div class="container">
                    <div class="card">
                        <div id="Form-advance" class="card card card-default scrollspy">
                            <div class="card-content">
                                <h4 class="card-title">Jadwal Kegiatan</h4>
                                <br>
                                <div id="view-select">
                                    <form role="form" method="POST" action="{{ route('presensi.conf.save') }}" id="modalform">
                                        @csrf
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <select name="option" id="option" required>
                                                    <option value="" disabled selected>Jenis Kegiatan</option>
                                                    @if (!empty($getJenisKegiatanAll))
                                                        @foreach ($getJenisKegiatanAll as $data)
                                                            <option value="{{$data->id_jenis_kegiatan}}"> {{$data->jenis_kegiatan}} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="input-field col m10 s12">
                                                <label for="nama_kegiatan">Nama Kegiatan</label>
                                                <input placeholder="" name='nama_kegiatan' id='nama_kegiatan' type="text" maxlength="200" required>
                                                <input type="hidden" value="save" name="jenis" id = "jenis" >
                                                <input type="hidden" value="" name="id_kegiatan" id = "id_kegiatan" >
                                            </div>
                                            <div class="input-field col m2 s12">
                                                <label for="masa">Masa</label>
                                                <input placeholder="" name='masa' id="masa" type="text" required>
                                            </div>
                                            <div class="input-field col m3 s12">
                                                <label for="tgl_buka">Tanggal Buka</label>
                                                <input placeholder="" id="tgl_buka" name="tgl_buka" type="text" class="datepicker" required>
                                            </div>
                                            <div class="input-field col m3 s12">
                                                <label for="jam_buka">Jam Buka</label>
                                                <input placeholder="" value="" id="jam_buka" name="jam_buka" type="text" class="timepicker" required>
                                            </div>
                                            <div class="input-field col m3 s12">
                                                <label for="tgl_tutup">Tanggal Tutup</label>
                                                <input placeholder="" id="tgl_tutup" name="tgl_tutup" type="text" class="datepicker" required>
                                            </div>
                                            <div class="input-field col m3 s12">
                                                <label for="jam_tutup">Jam Tutup</label>
                                                <input placeholder="" value="" id="jam_tutup" name="jam_tutup" type="text" class="timepicker" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button class="waves-effect waves-light  btn gradient-45deg-green-teal box-shadow-none border-round mr-1 mb-1 " type="submit" name="action">Simpan Data
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
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{url('app-assets/js/scripts/data-tables.js')}}"></script>
    <script src="../../../app-assets/js/scripts/advance-ui-modals.js"></script>
    <script type="text/javascript">
        $("#reload").click(function () {
            $.ajax({
                type: "GET",
                url: "{{ route('refresh.captcha') }}",
                success: function (data) {
                    $("#captcha span").html(data.captcha);
                }
            });
        });

        $(document).ready(function () {

            $(".timepicker").timepicker({
                twelveHour: false,
            });
            $(".datepicker").datepicker({
                format: "yyyy-mm-dd"
            });
        });

        function edit(id_kegiatan, id_jenis_kegiatan, nama_kegiatan, masa, tanggal_buka, tanggal_tutup) {
            $('#id_kegiatan').val(id_kegiatan);
            $('#option').val(id_jenis_kegiatan);
            $('#nama_kegiatan').val(nama_kegiatan);
            $('#masa').val(masa);
            $('#tgl_buka').val(tanggal_buka.substring(0, 10));
            $('#jam_buka').val(tanggal_buka.substring(11, 16));
            $('#tgl_tutup').val(tanggal_tutup.substring(0, 10));
            $('#jam_tutup').val(tanggal_tutup.substring(11, 16));
            $('#jenis').val('update');
        }

        $('#kegiatanmodal').on('hidden.bs.modal', function () {
            $('#nama_kegiatan').val('');

        })

    </script>

@endsection
