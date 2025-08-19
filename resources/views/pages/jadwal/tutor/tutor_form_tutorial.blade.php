@extends('pages.dashboardjadwal')
@section('head')
    <link rel="stylesheet" href="{{asset('app-assets/vendors/select2/select2.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{asset('app-assets/vendors/select2/select2-materialize.css') }}" type="text/css">
    <link rel="stylesheet" href="{{asset('app-assets/css/pages/form-select2.css') }}" type="text/css">
@endsection
@section('content')
    <div id="main">
        <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6 breadcrumbs-left">
                        <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Jadwal</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('jadwal.tutorial')}}">Tutorial</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @include('panels.bannerinfo')
            @if(!empty($pesan))
                <div class="col s12">
                    <div class="container">
                        <div class="col s12 m12 l12">
                            <div class="card-alert card gradient-45deg-red-pink ">
                                <div class="card-content white-text">
                                    <p style="text-align:center">
                                        <i class="material-icons">check </i> {{$pesan}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="container">
                @if(empty($DPtutor))
                    <div class="row">
                        <div class="col s12 ">
                            <div id="Form-advance" class="card card card-default scrollspy">
                                <div class="card-content">
                                    <h4 class="card-title">Form Pengajuan Matakuliah</h4>
                                    <form role="form" method="get" action="{{ route('tutor.formtutorial') }}" id="form">
                                        @csrf
                                        <div class="row">
                                            <div class="input-field col s12 m6 l2">
                                                <label for="id">Masukkan ID Tutor</label>
                                                <input placeholder="" name='id' type="text">
                                            </div>
                                            <div class="input-field col s12 m6 l2">
                                                <label for="id">Tanggal Lahir</label>
                                                <input placeholder="" name='tanggal_lahir' id='tanggal_lahir' type="text">
                                            </div>
                                            <div class="input-field col s12 m6 l2">
                                                <label>Captcha</label>
                                                <input placeholder="" name="captcha" id="captcha" type="text" required>
                                                <span><small>masukkan hasil penjumlahan </small></span>
                                                @if ($errors->has('captcha'))
                                                    <br>
                                                    <span> <strong>{{ $errors->first('captcha') }}</strong></span>
                                                @endif
                                            </div>
                                            <div class="input-field col s6 m6 l2">
                                                <div id="captcha">
                                                    <span> <?=captcha_img();?></span>
                                                    <button type="button" class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange" class="reload" id="reload">
                                                        <i class="material-icons">refresh</i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="input-field col s6 m6 l2">
                                                <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Lihat Data
                                                    <i class="material-icons right">send</i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!empty($DPtutor))
                    <div class="col s12 m6 l6">
                        <div id="Form-advance" class="card card card-default scrollspy">
                            <div class="card-content">

                                <h4 class="card-title">Data Tutor</h4>
                                <div class="row">
                                    <div class="col s12">
                                        <table>
                                            @foreach($DPtutor as $data)
                                                <tbody>
                                                <tr>
                                                    <td width="25%">ID Tutor</td>
                                                    <td width="1%">:</td>
                                                    <td width="100%">{{$data->idtutor}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Tutor</td>
                                                    <td>:</td>
                                                    <td>{{$data->namalengkap}}</td>
                                                </tr>
                                                <tr>
                                                    <td>NIK</td>
                                                    <td>:</td>
                                                    <td>{{$data->noidentitas}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Golongan</td>
                                                    <td>:</td>
                                                    <td>{{$data->golongan}}</td>
                                                </tr>
                                                <tr>
                                                    <td>NPWP</td>
                                                    <td>:</td>
                                                    <td>{{$data->npwp}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Bank</td>
                                                    <td>:</td>
                                                    <td>{{$data->nama_bank}}</td>
                                                </tr>
                                                <tr>
                                                    <td>No. Rekening</td>
                                                    <td>:</td>
                                                    <td>{{$data->norekening}}</td>
                                                </tr>

                                                <tr>
                                                    <td>Telepon</td>
                                                    <td>:</td>
                                                    <td>{{$data->telepon}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Keterangan</td>
                                                    <td>:</td>
                                                    <td>{{$data->keterangan}}</td>
                                                </tr>
                                                </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                    @include('pages.jadwal.tutor.t_pendidikantutor')
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!empty($matakuliahampu))
                    <div class="col s12 l6 m6">
                        <div class="card">
                            <div id="button-trigger" class="card card card-default scrollspy">
                                <div class="card-content">
                                    <div class="col s12">
                                        <h4 class="card-title">Pengajuan Matakuliah Masa @if(!empty($masa)) {{$masa}}  @endif </h4>
                                    </div>
                                    <div class="row">
                                        <form role="form" method="get" action="{{ route('tutor.formtutorial_simpan') }}" id="form">
                                            @if(!empty($DPtutor))
                                                <input type="hidden" name="id" value="{{Crypt::encrypt($DPtutor[0]->idtutor)}}">
                                            @endif
                                            @if(!empty($masa))
                                                <input type="hidden" name="masa" value="{{$masa}}">
                                            @endif
                                            <div id="view-select2">
                                                <div class="col m12 s12 l12">
                                                    <div class="input-field">
                                                        <select class="select2 browser-default" name="mtk" required>
                                                            <option value="" disabled selected>Pilih Matakuliah</option>
                                                            @foreach($matakuliahampu as $data)
                                                                <option value="{{$data->kode_mtk}}">{{$data->kode_mtk}} - {{$data->nama_mtk}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <button class="waves-effect waves-light btn gradient-45deg-green-teal" type="submit" name="action">Proses Matakuliah
                                                                <i class="material-icons right">send</i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!empty($ajuanmatakuliah))
                    <div class="col s12 l6 m6">
                        <div class="card">
                            <div id="button-trigger" class="card card card-default scrollspy">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col s12">
                                            <a class="waves-effect waves-light btn gradient-45deg-green-teal right"
                                               href="{{route('tutor.formtutorial_pdf', ['id' => Crypt::encrypt($ajuanmatakuliah[0]->idtutor),'masa' => Crypt::encrypt($ajuanmatakuliah[0]->masa), 't' => 'pdf' ]) }}" target="_blank">Cetak Form
                                            </a>
                                            <td>
                                                <a class="waves-effect waves-light btn gradient-45deg-purple-light-blue modal-trigger"
                                                   href="#uploadtemplate" onclick="uploadtemplate('{{Crypt::encrypt($ajuanmatakuliah[0]->idtutor)}}','{{Crypt::encrypt($ajuanmatakuliah[0]->masa)}}')">Unggah Berkas
                                                </a>
                                            </td>
{{--                                            @if(file_exists('storage/berkas_tutor/' . $masa . '/' .$masa .$id .'pdf'))--}}
                                            <td>
                                                <a class="waves-effect waves-light btn gradient-45deg-blue-grey-blue-grey"
                                                   href="{{route('tutor.formtutorial_pdf', ['id' => Crypt::encrypt($ajuanmatakuliah[0]->idtutor),'masa' => Crypt::encrypt($ajuanmatakuliah[0]->masa), 't' => 'view' ]) }}" target="_blank">Lihat File
                                                </a>
                                            </td>
{{--                                            @endif--}}
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th width="15%">Kode mtk</th>
                                                    <th>Nama Matakuliah</th>
                                                    <th>Opsi</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($ajuanmatakuliah as $data)
                                                    <tr>
                                                        <td>{{$data->kode_mtk}}</td>
                                                        <td>{{$data->nama_matakuliah}}</td>
                                                        @if(!empty($DPtutor))
                                                            <td>
                                                                <a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-amber"
                                                                   href="{{route('tutor.formtutorial_hapus', ['idmtk' => Crypt::encrypt($data->id),'id' =>Crypt::encrypt($DPtutor[0]->idtutor)]) }}"
                                                                   onclick="return confirm('Hapus Matakuliah ?');"><i class="material-icons">delete_forever</i>
                                                                </a>
                                                            </td>
                                                        @endif
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
    </div>
    <div id="uploadtemplate" class="modal">
        <div class="modal-content">
            <div class="col s12 m6 l6">
                <p class="card-title">Upload File Sertifikat</p>
                <form role="form" method="POST" action="{{route('tutor.formtutorial_upload')}}" id="form" files="true" enctype="multipart/form-data">
                    @csrf
                    <input id="mid" name="mid" type="hidden">
                    <input id="mmasa" name="mmasa" type="hidden">
                    <div class="row">
                        <div class="col m12 s12 file-field input-field">
                            <div class="btn float-left">
                                <span>File</span>
                                <input type="file" name="file_1" id="file_1">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" required>
                                <span>Pilih file yang akan di unggah</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
                {{--            </div>--}}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('app-assets/js/scripts/data-tables.js')}}"></script>
    <script src="{{asset('app-assets/js/jquery.maskedinput.js')}}"></script>
    <script src="{{asset('app-assets/vendors/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/form-select2.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/advance-ui-modals.js')}}"></script>
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
        jQuery(function ($) {
            $("#tanggal_lahir").mask("99/99/9999", {placeholder: "__/__/____"});
        });
        function uploadtemplate(id,masa) {
            $('#mid').val(id);
            $('#mmasa').val(masa);
        }
    </script>
@endsection
