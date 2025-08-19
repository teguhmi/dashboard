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
                        <div class="col s10 m6 l2">
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Form Layanan</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('dashboardlayanan')}}">Layanan</a></li>
                                <li class="breadcrumb-item"><a href="#">Formulir Layanan</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @include('panels.bannerinfo')
        </div>
    </div>
    <div class="col s12 m12 l12">
        <div class="container">
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
                                <div class="input-field col s6 m2 l2">
                                    <button class="waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1 modal-trigger"
                                            data-toggle="modal" href="#kegiatanmodal">Deskripsi Layanan
                                    </button>
                                </div>
                            @else
                                <button class="waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1" type="submit" name="action">Simpan Data
                                    <i class="material-icons right">send</i>
                                </button>
                            @endif
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
