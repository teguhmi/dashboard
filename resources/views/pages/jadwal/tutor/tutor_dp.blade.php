@extends('pages.dashboardjadwal')
@section('head')
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
            <div class="container">
                <div class="row">
                    <div class="col s12 ">
                        <div id="Form-advance" class="card card card-default scrollspy">
                            <div class="card-content">
                                <h4 class="card-title">Data Tutor</h4>
                                <form role="form" method="GET" action="{{ route('tutor.dp') }}" id="form">
                                    @csrf
                                    <div class="row">
                                        @if (\Illuminate\Support\Facades\Auth::check())
                                            <div class="input-field col s12 m6 l2">
                                                <label for="id">Masukkan ID Tutor</label>
                                                <input placeholder="" name='id' type="text">
                                            </div>
                                        @else
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
                                        @endif
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
                @if(!empty($DPtutor))
                    <div class="col s12 m6 l6">
                        <div id="Form-advance" class="card card card-default scrollspy">
                            <div class="card-content">
                                <h4 class="card-title">Data Tutor</h4>
                                <div class="row">
                                    <div class="col s12">
                                        <table>
                                                <tbody>
                                                <tr>
                                                    <td width="25%">ID Tutor</td>
                                                    <td width="1%">:</td>
                                                    <td width="100%">{{$DPtutor['id_tutor']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Tutor</td>
                                                    <td>:</td>
                                                    <td>{{$DPtutor['nama_lengkap']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>NIK</td>
                                                    <td>:</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Golongan</td>
                                                    <td>:</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>NPWP</td>
                                                    <td>:</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Bank</td>
                                                    <td>:</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>No. Rekening</td>
                                                    <td>:</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Telepon</td>
                                                    <td>:</td>
                                                    <td>{{$DPtutor['telepon']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Keterangan</td>
                                                    <td>:</td>
                                                    <td></td>
                                                </tr>

                                                </tbody>
                                        </table>
                                    </div>
                                    @include('pages.jadwal.tutor.t_pendidikantutor')
                                    @include('pages.jadwal.tutor.t_matakuliahampu')

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!empty($kelas))
                    <div class="col s12 l6 m6">
                        <div class="card">
                            <div id="button-trigger" class="card card card-default scrollspy">
                                <div class="card-content">
                                    <div class="col s12">
                                        <h4 class="card-title">Kelas Tutorial</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col s12">
                                            <table id="data-table-simple" class="display" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="5%">Masa</th>
                                                    <th width="5%">Kode mtk</th>
                                                    <th width="50%">Nama Matakuliah</th>
                                                    {{--                                                        <th>Masa</th>--}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($kelas as $data)
                                                    <tr>
                                                        <td>{{$data['masa']}}</td>
                                                        <td>{{$data['kode_matakuliah']}}</td>
                                                        <td>{{$data['nama_matakuliah']}}</td>
                                                        {{--                                                            <td>{{$data->masa}}</td>--}}
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
@endsection
@section('script')
    <script src="../../../app-assets/js/scripts/data-tables.js"></script>
    <script src="../../../app-assets/js/jquery.maskedinput.js"></script>
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
    </script>
@endsection
