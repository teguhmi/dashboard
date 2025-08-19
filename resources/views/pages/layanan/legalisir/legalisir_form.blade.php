@extends('pages.dashboardlayanan')
@section('head')
    <link rel="stylesheet" href="../../../app-assets/vendors/select2/select2.min.css" type="text/css">
    <link rel="stylesheet" href="../../../app-assets/vendors/select2/select2-materialize.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/form-select2.css">
@endsection
@section('content')
    <div id="main">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-2" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6 breadcrumbs-left">
                        <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Legalisir</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('dashboardlayanan')}}">Layanan</a></li>
                            <li class="breadcrumb-item"><a href="{{route('legalisir.index')}}">Form Legalisir</a></li>
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
                <div class="row">
                    <div class="col s12 m6 l6">
                        <div class="row">
                            <div id="Form-advance" class="card card card-default scrollspy">
                                <div class="card-content">
                                    <h4 class="card-title">Form Layanan Legalisir</h4>
                                    <form role="form" method="get" action="{{ route('legalisir.index') }}" id="form">
                                        @csrf
                                        <div class="row">
                                            <div class="input-field col s12 m6 l6">
                                                <label for="nim">NIM</label>
                                                <input placeholder="" name='nim' id='nim' type="text" maxlength="9" required autofocus>
                                            </div>
                                            <div class="input-field col s6 m6 l2">
                                                <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Lihat Data
                                                    <i class="material-icons right">send</i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    @if(!empty($DPMahasiswa))
                                        <div id="Form-advance" class="card card card-default scrollspy">
                                            <div class="card-content">
                                                <h4 class="card-title">Data Mahasiswa
                                                </h4>
                                                <div class="row">
                                                    <div class="col s12">
                                                        <table>
                                                            @foreach($DPMahasiswa as $data)
                                                                <tbody>
                                                                <tr>
                                                                    <td width="25%">NIM</td>
                                                                    <td width="1%">:</td>
                                                                    <td width="100%">{{$data->nim}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama Mahasiswa</td>
                                                                    <td>:</td>
                                                                    <td>{{$data->nama_mahasiswa}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Tanggal Lahir</td>
                                                                    <td>:</td>
                                                                    <td>{{$data->tempat_lahir_mahasiswa}}, {{$data->tanggal_lahir_mahasiswa}} </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>UPBJJ</td>
                                                                    <td>:</td>
                                                                    <td>{{$data->kode_upbjj}} / {{$data->nama_upbjj}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Program Studi</td>
                                                                    <td>:</td>
                                                                    <td>{{$data->nama_program_studi}}</td>
                                                                </tr>
                                                                @if(!empty($yudisium))
                                                                    @foreach($yudisium as $data)
                                                                        <tr>
                                                                            <td>Nomor SK Rektor</td>
                                                                            <td>:</td>
                                                                            <td>{{$data->nomor_sk_rektor}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Nomor Ijazah</td>
                                                                            <td>:</td>
                                                                            <td>{{$data->no_ijazah_d}}</td>
                                                                        </tr>
                                                                        @if(!empty($data->no_ijazah_a))
                                                                            <tr>
                                                                                <td>Nomor Ijazah Akta</td>
                                                                                <td>:</td>
                                                                                <td>{{$data->no_ijazah_a}}</td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                                </tbody>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!empty($lip))
                        <div class="col s12 l6 m6">
                            <div class="card">
                                <div id="button-trigger" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <div class="col s12">
                                            <h4 class="card-title">Data LIP Legalisir</h4>
                                        </div>
                                        <div class="row">
                                            <form role="form" method="post" action="{{ route('legalisir.simpan') }}" id="form">
                                                @csrf
                                                @if(!empty($DPMahasiswa))
                                                    <input type="hidden" name="nim" value="{{$DPMahasiswa[0]->nim}}">
                                                @endif
                                                <div id="view-select2">
                                                    <div class="col m12 s12 l12">
                                                        <div class="input-field">
                                                            <select class="select2 browser-default" name="lip" id="lip" required>
                                                                <option value="" disabled selected>Pilih LIP yang akan digunakan</option>
                                                                @foreach($lip as $data)
                                                                    <option value="{{$data->nobilling}}">{{$data->nobilling}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        {{--                                                        <div class="row">--}}
                                                        {{--                                                            <div class="col s12 l6 m6">--}}
                                                        {{--                                                                <label for="bayar_data">Status Bank</label>--}}
                                                        {{--                                                                <input type="text" name="statusbank" id="statusbank" readonly value="">--}}
                                                        {{--                                                            </div>--}}
                                                        {{--                                                            <div class="col s12 l6 m6">--}}
                                                        {{--                                                                <label for="bayar_data">Total Bayar</label>--}}
                                                        {{--                                                                <input type="text" name="totalbayar" id="totalbayar" readonly value="">--}}
                                                        {{--                                                            </div>--}}
                                                        {{--                                                        </div>--}}
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <button class="waves-effect waves-light btn gradient-45deg-green-teal" type="submit" name="action">Simpan Data
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
                        @if(!empty($transaksi))
                            <div class="col s12 l6 m6">
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col s12">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td>Nota</td>
                                                        <td>Nomor Billing</td>
                                                        <td>Opsi</td>
                                                    </tr>
                                                    @foreach($transaksi as $data)
                                                        <tr>
                                                            <td width="1$"> {{$data->id_nota}}</td>
                                                            <td>{{$data->nomor_billing}}</td>
                                                            <td width="1%">
                                                                <a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-indigo-light-blue"
                                                                   href="{{route('legalisir.cetak', ['id' => Crypt::encrypt($data->id)]) }}" target="_blank"><i class="material-icons">print</i>
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
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="../../../app-assets/js/scripts/data-tables.js"></script>
    <script src="../../../app-assets/js/jquery.maskedinput.js"></script>
    <script src="../../../app-assets/vendors/select2/select2.full.min.js"></script>
    <script src="../../../app-assets/js/scripts/form-select2.js"></script>
    <script type="text/javascript">
        $("#lip").change(function () {
            var lip = $('#lip').val();
            $('#totalbayar').val("");
            $('#statusbank').val("");
            $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: "{{ route('legalisir.lip') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    lip: lip,
                },
                success: function (response) {
                    console.log(response);
                    $('#totalbayar').val(response["totalbayar"]);
                    $('#statusbank').val(response["statusbank"]);
                }
            });
        });
    </script>
@endsection

