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
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Form Layanan</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('dashboardlayanan')}}">Layanan</a></li>
                                <li class="breadcrumb-item"><a href="#">Deskripsi Layanan dan Keluhan</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @include('panels.bannerinfo')

            <div class="col s12 m12 l12">
                {{--                <div class="container">--}}
                <div id="Form-advance" class="card card card-default scrollspy">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12">
                                <h4 class="card-title">Deskripsi Layanan dan Keluhan</h4>
                            </div>
                            <div class="col s12 m12 l12">

                                <a class="waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1 modal-trigger right"
                                   data-toggle="modal" href="{{route('layanan.deskripsi.index')}}">Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    {{--                </div>--}}
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div id="Fixed-width-tabs" class="card card card-default scrollspy">
                                {{--                                <div class="card-content">--}}
                                {{--                            <h4 class="card-title">Daftar Layanan dan Keluhan Pelanggan</h4>--}}
                                {{--                                    <div class="row">--}}
                                <div class="col s12">
                                    <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
                                        <li class="tab"><a href="#dp">Data Pelanggan</a></li>
                                        <li class="tab"><a class="active" href="#deskripsi">Deskripsi</a></li>
                                        <li class="tab"><a href="#penyebab">Akar Permasalahan</a></li>
                                        <li class="tab"><a href="#jawaban">Jawaban</a></li>
                                    </ul>
                                </div>
                                <div class=“tab-content">
                                    <div id="dp" class="col s12">
                                        <div id="Form-advance" class="card card card-default scrollspy">
                                            <div class="card-content">
                                                <h4 class="card-title">Formulir Layanan dan Keluhan</h4>
                                                <form role="form" method="POST" action="{{ route('layanan.formulir.input') }}" id="form">
                                                    @csrf
                                                    <div class="row">
                                                        <div id="view-select">
                                                            <div class="input-field col s12 m6 l6">
                                                                <h7>Sumber Layanan</h7>
                                                                <select class="select2 browser-default validate" name="asal" id="asal" required>
                                                                    <option value="" disabled selected></option>
                                                                    @if (!empty($asal))
                                                                        @foreach ($asal as $data)
                                                                            <option value="{{$data->id_asal}}"
                                                                                    @if(!empty($dp))
                                                                                    @if($data->id_asal == $dp[0]->id_asal) selected
                                                                                @endif
                                                                                @endif> {{$data->nama_asal}}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="input-field col s12 m6 l6">
                                                                <h7>Kelompok Pelanggan</h7>
                                                                <select class="select2 browser-default" name="kl_kp" id="kl_kp" required>
                                                                    <option value="" disabled selected></option>
                                                                    @if (!empty($kp))
                                                                        @foreach ($kp as $data)
                                                                            <option value="{{$data->id_kp}}" @if(!empty($dp))@if($data->id_kp == $dp[0]->id_kp) selected @endif @endif > {{$data->nama_kp}} </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12 m2 l2">
                                                            <label for="nim">NIM</label>
                                                            <input placeholder="" name="nim" id="nim" type="text" maxlength="9" value="@if(!empty($dp)) {{$dp[0]->nim}}@endif">
                                                            <input placeholder="" name="id_data_dp" id="id_data_dp" type="hidden" value="@if(!empty($dp)) {{$dp[0]->id_data_dp}}@endif">
                                                        </div>
                                                        <div class="input-field col s12 m7 l7">
                                                            <label for="nama">Nama</label>
                                                            <input placeholder="" name="nama" id="nama" type="text" value="@if(!empty($dp)) {{$dp[0]->nama}}@endif" required>
                                                        </div>
                                                        <div class="input-field col s12 m3 l3">
                                                            <label for="upbjj">UPBJJ</label>
                                                            <input placeholder="" name="nama_upbjj" id="nama_upbjj" type="text" value="@if(!empty($dp)) {{$dp[0]->nama_upbjj}}@endif" readonly>
                                                            <input placeholder="" name="kode_upbjj" id="kode_upbjj" type="hidden" value="@if(!empty($dp)) {{$dp[0]->kode_upbjj}}@endif">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12 m6 l6">
                                                            <label for="id">Nomor Telepon</label>
                                                            <input placeholder="" name='telepon' type="text" maxlength="20" value="@if(!empty($dp)) {{$dp[0]->telepon}}@endif">
                                                        </div>
                                                        <div class="input-field col s12 m6 l6">
                                                            <label for="id">email</label>
                                                            <input placeholder="" name='email' type="email" maxlength="30" value="@if(!empty($dp)) {{$dp[0]->email}}@endif">
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        @if(!empty($dp[0]->id_data_dp))
                                                            <div class="input-field col s6 m2 l2">
                                                                <button class="waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1" type="submit" name="action">Update Data
                                                                    <i class="material-icons right">send</i>
                                                                </button>
                                                            </div>
                                                        @else
                                                            <button class="waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1" type="submit" name="action">Simpan Data
                                                                <i class="material-icons right">send</i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="deskripsi" class="col s12">
                                        <div id="Form-advance" class="card card card-default scrollspy">
                                            <div class="card-content">
                                                @if(empty($deskripsi[0]->deskripsi))
                                                    <button class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb-2 modal-trigger"
                                                            data-toggle="modal" href="#modalupdate" onclick="edit('{{Crypt::encrypt($deskripsi[0]->id_deskripsi)}}','deskripsi', '{{$deskripsi[0]->deskripsi}}','1')">
                                                        <i class="material-icons"></i>Menambahkan Deskripsi
                                                    </button>
                                                @else
                                                    @if(!empty($deskripsi[0]->deskripsi))
                                                        <p class="mt-2 mb-2">
                                                            {{$deskripsi[0]->deskripsi}}
                                                        </p>
                                                        <br>
                                                        <br>
                                                        <hr>
                                                        <button class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb-2 modal-trigger"
                                                                data-toggle="modal" href="#modalupdate" onclick="edit('{{Crypt::encrypt($deskripsi[0]->id_deskripsi)}}','deskripsi', '{{$deskripsi[0]->deskripsi}}','{{$deskripsi[0]->id_status}}')">
                                                            <i class="material-icons"></i>Ubah Deskripsi
                                                        </button>

                                                        @if(!empty($deskripsi[0]->deskripsi_user_create))
                                                            <table>
                                                                <tr>
                                                                    <td>Nama Petugas : {{$deskripsi[0]->deskripsi_user_create}}
                                                                        <br> Tanggal : {{$deskripsi[0]->deskripsi_user_date}}
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div id="penyebab" class="col s12">
                                        <div id="Form-advance" class="card card card-default scrollspy">
                                            <div class="card-content">
                                                @if(empty($deskripsi[0]->penyebab))
                                                    <button class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb-2 modal-trigger"
                                                            data-toggle="modal" href="#modalupdate" onclick="edit('{{Crypt::encrypt($deskripsi[0]->id_deskripsi)}}','penyebab','{{$deskripsi[0]->penyebab}}','2')">
                                                        <i class="material-icons"></i>Menambahkan Keterangan Penyebab
                                                    </button>

                                                @else
                                                    @if(!empty($deskripsi[0]->penyebab))
                                                        <p class="mt-2 mb-2">
                                                            {{$deskripsi[0]->penyebab}}
                                                        </p>
                                                        <br>
                                                        <br>
                                                        <hr>
                                                        <button class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb-2 modal-trigger"
                                                                data-toggle="modal" href="#modalupdate" onclick="edit('{{  Crypt::encrypt($deskripsi[0]->id_deskripsi)}}','penyebab', '{{$deskripsi[0]->penyebab}}','{{$deskripsi[0]->id_status}}')">
                                                            <i class="material-icons"></i>Ubah Penyebab
                                                        </button>
                                                        @if(!empty($deskripsi[0]->penyebab_user_create))
                                                            <table>
                                                                <tr>
                                                                    <td>Nama Petugas : {{$deskripsi[0]->penyebab_user_create}}
                                                                        <br> Tanggal : {{$deskripsi[0]->penyebab_user_date}}
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div id="jawaban" class="col s12">
                                        <div id="Form-advance" class="card card card-default scrollspy">
                                            <div class="card-content">
                                                @if(empty($deskripsi[0]->jawaban))
                                                    <button class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb-2 modal-trigger"
                                                            data-toggle="modal" href="#modalupdate" onclick="edit('{{  Crypt::encrypt($deskripsi[0]->id_deskripsi)}}','jawaban','{{$deskripsi[0]->jawaban}}','3')">
                                                        <i class="material-icons"></i>Menambahkan Jawaban
                                                    </button>
                                                @else
                                                    @if(!empty($deskripsi[0]->jawaban))
                                                        <p class="mt-2 mb-2">
                                                            {{$deskripsi[0]->jawaban}}
                                                        </p>
                                                        <br>
                                                        <br>
                                                        <hr>
                                                        <button class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb-2 modal-trigger"
                                                                data-toggle="modal" href="#modalupdate" onclick="edit('{{  Crypt::encrypt($deskripsi[0]->id_deskripsi)}}','jawaban', '{{$deskripsi[0]->jawaban}}','{{$deskripsi[0]->id_status}}')">
                                                            <i class="material-icons"></i>Ubah Jawaban
                                                        </button>
                                                        @if(!empty($deskripsi[0]->jawaban_user_create))
                                                            <table>
                                                                <tr>
                                                                    <td>Nama Petugas : {{$deskripsi[0]->jawaban_user_create}}
                                                                        <br> Tanggal : {{$deskripsi[0]->jawaban_user_date}}
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col s12 m12 l12">
                            <a title="Mengubah Status menjadi selesai" class="waves-effect waves-light btn gradient-45deg-green-pink z-depth-4 mr-1 mb-2 modal-trigger right"
                               href="{{route ('layanan.deskripsi.updatestatus', ['id1'=> Crypt::encrypt($deskripsi[0]->id_deskripsi)],'/editstatus') }}"
                               onclick="return confirm('Selesaikan tiket ini? {{$deskripsi[0]->deskripsi}}  ?');">
                                <i class="material-icons"></i>Klik saya jika tiket ini telah selesai
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalupdate" class="modal">
        <div class="modal-content">
            <div class="col s12">
                <div class="container">
                    <div class="card">
                        <div id="Form-advance" class="card card card-default scrollspy">
                            <div class="card-content">
                                <h4 class="card-title">Keterangan
                                    <label id="lblName"></label>
                                </h4>
                                <form role="form" method="POST" action="{{ route('layanan.deskripsi.update') }}" id="form">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s12">
                                            {{--<label id = 'status'>Nama Penanggung Jawab</label>--}}
                                            <input placeholder="" type="text" maxlength="200" id="keterangan" name="keterangan">
                                            <input type="hidden" id="id1" name="id1">
                                            <input type="hidden" id="id2" name="id2">
                                            <input type="hidden" id="id3" name="id3">
                                            <input type="hidden" id="id4" name="id4">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Simpan
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
@endsection
@section('script')
    <script type="text/javascript">

        var url = window.location.href;
        var activeTab = url.substring(url.indexOf("#") + 1);
        $(".tabs").removeClass("active in");

        $("#" + activeTab).addClass("active in");

        $('a[href="#' + activeTab + '"]').tab('show');


        function edit(id1, id2, id3, id4) {
            $('#id1').val(id1);
            $('#id2').val(id2);
            $('#lblName').text(id2);
            $('#keterangan').val(id3);
            $('#id3').val(id3);
            $('#id4').val(id4);
        }
    </script>


@endsection
