@extends('pages.dashboardujian')
@section('head')

@endsection
<!-- Form with validation -->

@section('content')
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-2" id="breadcrumbs-wrapper">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Administrasi Numpang Ujian Keluar</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('dashboardlayanan')}}">Layanan</a></li>
                            <li class="breadcrumb-item"><a href="{{route('ujian.numpangkeluar')}}">Numpang Ujian</a></li>
                        </ol>
                    </div>
                </div>
            </div>
            @include('panels.bannerinfo')
            @if(empty($DPMahasiswa))
                <div class="col s12 m4 l4">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <div id="basic-form" class="card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">Menumpang Ujian Keluar</h4>
                                        <form role="form" method="post" action="{{route('ujian.numpangkeluar.cari')}}" id="form">
                                            @csrf
                                            <div class="row">
                                                <div class="input-field col s12 ">
                                                    <input type="text" id="nim" name="nim" maxlength="9" class="angka" placeholder="" required>
                                                    <span class="error" style="color: red; display: none">* Masukkan angka (0 - 9)</span>
                                                    <label for="nim">NIM</label>
                                                </div>

                                                <div class="input-field col s12">
                                                    <button class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb-2">Cari
                                                        <i class="material-icons left">send</i>
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
            @endif
            {{--        </div>--}}
            @if(!empty($DPMahasiswa))
                <div class="col s12">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <div id="basic-form" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">Data Mahasiswa</h4>
                                        <div class="row">
                                            <div class="col s12">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td width="25%">NIM</td>
                                                        <td width="1%">:</td>
                                                        <td width="100%">{{$DPMahasiswa['nim']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Mahasiswa</td>
                                                        <td>:</td>
                                                        <td>{{$DPMahasiswa['nama_mahasiswa']}}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>UPBJJ</td>
                                                        <td>:</td>
                                                        <td>{{$DPMahasiswa['kode_upbjj']}} / {{$DPMahasiswa['nama_upbjj']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Program Studi</td>
                                                        <td>:</td>
                                                        <td>{{$DPMahasiswa['nama_program_studi']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a class="waves-effect waves-light btn gradient-45deg-green-teal"
                                                               href="{{route('ujian.numpangkeluar')}}">Buat Baru
                                                            </a>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
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
                <div class="row">
                    <div class="col s12 m12 l6">
                        <div class="container">
                            <div class="row">
                                <div class="col s12">
                                    <div id="basic-form" class="card card-default scrollspy">
                                        <div class="card-content">
                                            <h4 class="card-title">Lokasi Ujian Tujuan</h4>
                                            <form role="form" method="post" action="{{route('ujian.simpantpu')}}" id="form">
                                                @csrf
                                                <div class="row">
                                                    <div class="col s12 m4 l4">
                                                        <input type="hidden" name="nim" id="nim" value="{{$DPMahasiswa['nim']}}">
                                                        <input type="hidden" name="masa" id="masa" value="{{$masa}}">
                                                        <input type="hidden" name="jenis" id="jenis" value="keluar">
                                                        <label for="upbjj">UPBJJ Tujuan</label>
                                                        <select class="select2 browser-default" name="upbjj" id="upbjj">
                                                            <option value='' disabled selected></option>
                                                            @if (!empty($upbjj))
                                                                @foreach ($upbjj->data->dataUpbjj as $data)
                                                                    <option value="{{$data->kode_upbjj}}"> {{$data->nama_upbjj}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col s12 m4 l4">
                                                        <label for="tpu">Tempat Ujian</label>
                                                        <select class="select2 browser-default" name="tpu" id="tpu" required>
                                                            <option value='' disabled selected>Pilih UPBJJ terlebih dahulu</option>

                                                        </select>
                                                    </div>
                                                    <div class="col s12 m4 l4">
                                                        <label for="hari">Hari Ujian</label>
                                                        <select class="select2 browser-default" name="hari" id="hari" required>
                                                            <option value='' disabled selected></option>
                                                            <option value="1"> Pertama</option>
                                                            <option value="2"> Kedua</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <button class=" col s12 m2 l2 waves-effect waves-light btn gradient-45deg-green-teal right btn-small " type="submit">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @if(!empty($tpu))
                                        <div id="basic-form" class="card card-default scrollspy">
                                            <div class="card-content">

                                                <table>
                                                    <thead>
                                                    <tr>
                                                        <th>UPBJJ Tujuan</th>
                                                        <th>Hari</th>
                                                        <th>Tempat Ujian</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($tpu as $item)
                                                        <tr>
                                                            <td class="td">{{$item->kode_upbjj_ujian_tujuan}} / {{$item->nama_upbjj_ujian_tujuan}}</td>
                                                            <td class="td">{{$item->hari}}</td>
                                                            <td class="td">{{$item->kode_tempat_ujian_tujuan}} / {{$item->nama_wilayah_ujian_tujuan}}</td>
                                                            <td>
                                                                <a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-amber"
                                                                   href="{{route ('ujian.numpangkeluar.deltpu', ['id1' => Crypt::encrypt($DPMahasiswa['nim']),'id2' => Crypt::encrypt($item->id)])}}"
                                                                   onclick="return confirm('Hapus Seluruh Matakuliah ?');"> <i class="material-icons">delete_forever</i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m12 l6">
                        <div id="basic-form" class="card card card-default scrollspy">
                            <div class="card-content">
                                <h4 class="card-title">Data Matakuliah</h4>
                                <a class="waves-effect waves-light btn gradient-45deg-green-teal right btn-small "
                                   href="{{route('ujian.numpangkeluar.getd20an', ['id' => Crypt::encrypt($DPMahasiswa['nim'])]) }}">Ambil Matakuliah
                                </a>
                                @if(empty($getnomorsurat))
                                    <a class="waves-effect waves-light btn gradient-45deg-green-teal gradient-shadow modal-trigger btn-small"
                                       href="#myModal">Nomor Surat
                                    </a>
                                @else
                                    <a class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb- left btn-small "
                                       href="{{route('ujian.numpangkeluar.cetaksurat', ['id1' => Crypt::encrypt($DPMahasiswa['nim']),'id2' => Crypt::encrypt($masa)]) }}" target="_blank">Cetak Surat
                                    </a>
                                    <a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 modal-trigger btn-small"
                                       href="#myModal">Perbaiki Data
                                    </a>
                                @endif
                                <div class="row">
                                    @if(!empty($sql))
                                        <div class="col s12">

                                            <table class="display">
                                                <thead>
                                                <tr>
                                                    <th>Hari</th>
                                                    <th>Kode Matakuliah</th>
                                                    <th>Jam Ujian</th>
                                                    <th>Opsi</th>


                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach($sql as $item)
                                                    <tr>
                                                        <td style="width: 50px;text-align: center">{{$item->hari}}</td>

                                                        <td class="td">{{$item->kode_mtk}}</td>
                                                        <td class="td">{{$item->jam_ujian}}</td>
                                                        <td>
                                                            <a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-amber"
                                                               href="{{route ('ujian.numpangkeluar.deld20an', ['id1' => Crypt::encrypt($DPMahasiswa['nim']),'id2' => Crypt::encrypt($item->id)])}}"
                                                               onclick="return confirm('Hapus Seluruh Matakuliah ?');"> <i class="material-icons">delete_forever</i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div id="myModal" class="modal">
        <form method="POST" action="{{route('ujian.simpannomorsurat')}}" id="form">
            @csrf
            <div class="modal-content">
                @if(!empty($sql))
                    <input type='hidden' id="nim" name="nim" value="{{$DPMahasiswa['nim']}}"/>
                    <input type='hidden' id="masa" name="masa" value="{{$masa}}"/>
                    <input type="hidden" id="ids" name="ids" value="@if(!empty($getnomorsurat)) {{$getnomorsurat[0]->id}} @endif" >
                    <div class="col s12">
                        <div class="row">
                            <div class="col s4 m4 l4">
                                <label for="nomor"> Masukkan Nomor Surat</label><br>
                                <input type="text" id="nomor" name="nomor" maxlength="20" value="@if(!empty($getnomorsurat)) {{strtok(substr($getnomorsurat[0]->nomor_surat,2),'/')}}@endif" required>
                            </div>
                            @if(!empty($nomorunit))
                                <div class="col s8 m8 l8">
                                    <label for="unit"> Klasifikasi Suratt</label><br>
                                    <input type="text" id="unit" name="unit" value="{{$nomorunit[0]->sub_unit}}{{date("Y")}}" readonly>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="row">
                            <div class="col s4 m4 l4">
                                <label for="hp"> Masukkan Nomor Handphone</label><br>
                                <input type="text" id="hp" name="hp" value="@if(!empty($getnomorsurat)) {{$getnomorsurat[0]->nomor_handphone}} @endif" maxlength="20">
                            </div>
                            <div class="col s6 m4 l4">  <label for="email"> Masukkan Email</label><br>
                                <input type="text" id="email" name="email" value="@if(!empty($getnomorsurat)) {{$getnomorsurat[0]->email}} @endif" maxlength="50">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white modal-close" data-dismiss="modal">Close
                </button>
                <button type="submit" class="btn btn-primary"> Simpan</button>
            </div>
        </form>
    </div>
@endsection
@section('script')

    <script type="text/javascript">
        $(function () {

            $("#upbjj").change(function () {
                var id_upbjj = $('#upbjj').val();
                if (id_upbjj > 0) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('ujian.caritpu') }}",
                        cache: false,
                        data: {
                            _token: "{{ csrf_token() }}",
                            idupbjj: id_upbjj
                        },
                        success: function (respond) {
                            $("#tpu").html(respond);

                        }
                    })

                }
            });

        });
    </script>
@endsection
