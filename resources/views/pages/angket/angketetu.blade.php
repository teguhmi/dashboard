@extends('pages.dashboardjadwal')
@section('head')
    <style>
        div.text {
            /*margin-left: 2cm;*/
            /*margin-right: 2cm;*/
            line-height: 1em;
            text-align: justify;
            font-size: 10pt;
        }

        centertext {
            /*height: 80px;*/
            /*width: 160px;*/
            text-align: center;
            vertical-align: middle;
        }
    </style>
@endsection
<!-- Form with validation -->

@section('content')
    <div id="main">
        <div class="row">
            <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
                @include('panels.bannerinfo')
                <div class="col s12">
                    @if(!empty($kelas))
                        <div id="data" class="card card-tabs">
                            <div class="card-content">
                                <div class="card-title">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h4 class="card-title center">Angket Evaluasi Tutor Oleh UPBJJ</h4>
                                            <h1 class="card-title center">Masa Registrasi </h1>

                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="input-field col s12 m12 l12">
                                            <label for="nim">Nama Tutor</label>
                                            <input placeholder="" name="tutor" id="tutor" type="text" value="{{$kelas['idtutor']}} / {{$kelas['nama_tutor']}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m12 l12">
                                        <label for="nim">Kelas / Kode Matakuliah / Nama Matakuliah</label>
                                        <input name="matakuliah" id="matakuliah" type="text" value="{{$kelas['kelas']}} / {{$kelas['kode_mtk']}} / {{$kelas['nama_mtk']}}" readonly>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s4 m4 l4">
                                        <label for="nama">UPBJJ-UT</label>
                                        <input placeholder="" name="nama_upbjj" id="nama_upbjj" type="text" value="{{config('app.kode_upbjj')}} / {{config('app.upbjj')}}" readonly>
                                    </div>

                                    <div class="input-field col s4 m4 l4">
                                        <label for="upbjj">Kabupaten</label>
                                        <input placeholder="" name="kabupaten" id="kabupaten" type="text" value="" readonly>
                                    </div>
                                    <div class="input-field col s4 m4 l4">
                                        <label for="upbjj">Pokjar</label>
                                        <input placeholder="" name="pokjar" id="pokjar" type="text" value="" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6 m6 l6 right">
                                        <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1 right"
                                           href="{{route('angket.reload', [
                                                'id' =>Crypt::encrypt($kelas['masa'])
                                                ])}}">Batalkan Pengisian Angket
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div id="radio-buttons" class="card card-tabs">
                                    <div class="card-content">
                                        <form role="form" method="POST" action="{{ route('angketetusimpan') }}" id="form">
                                            @csrf
                                            <div id="angket">
                                                <input type="hidden" name="kelas" value="{{$kelas['kelas']}}">
                                                <input type="hidden" name="idtutor" value="{{$kelas['idtutor']}}">
                                                <input type="hidden" name="idtutorial" value="{{$kelas['idtutorial']}}">
                                                <input type="hidden" name="masa" value="{{$kelas['masa']}}">
                                                <input type="hidden" name="nama_tutor" value="{{$kelas['nama_tutor']}}">
                                                <input type="hidden" name="kode_mtk" value="{{$kelas['kode_mtk']}}">
                                                <input type="hidden" name="nama_mtk" value="{{$kelas['nama_mtk']}}">
                                                @if(!empty($data))
                                                    <table class="bordered">
                                                        <thead>

                                                        <tr>
                                                            <td rowspan="2" class="center" width="2">Nomor</td>
                                                            <td rowspan="2" class="center" width="80%">Aspek</td>
                                                            <td colspan="2" rowspan="1" class="center" width="20%">Terpenuhi</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:center">YA</td>
                                                            <td style="text-align:center">Tidak</td>
                                                        </tr>
                                                        </thead>
                                                        @foreach($data as $row)
                                                            <tbody>
                                                            <tr>
                                                                <input name="nomor_soal_{{$row->nomor}}" type="hidden" value="{{$row->nomor}}"/>
                                                                <td class="center">{{$row->nomor}}</td>
                                                                <td>{{$row->pertanyaan}}</td>
                                                                @if(!empty($pola))
                                                                    <td width="20px">
                                                                        <p class="mb-3 center">
                                                                            <label>
                                                                                <input name="jawaban_{{$row->nomor}}" type="radio" value="{{$pola[1]->key}}" required/><span></span>
                                                                            </label>
                                                                        </p>
                                                                    </td>
                                                                    <td class="center" width="15px">
                                                                        <p class="mb-1" center>
                                                                            <label>
                                                                                <input name="jawaban_{{$row->nomor}}" type="radio" value="{{$pola[0]->key}}" required/><span></span>
                                                                            </label></p>
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                            </tbody>
                                                        @endforeach
                                                    </table>
                                                @endif
                                                <br>
                                                <div class="row">
                                                    <div class="input-field col s12 m12 l12">
                                                        <h5 for="nama">
                                                            <saran>Saran</saran>
                                                        </h5>
                                                        <input placeholder="" name="saran" id="saran" type="text">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s12 m12 l12">
                                                    <button class="waves-effect waves-light  btn gradient-45deg-green-teal box-shadow-none border-round mr-1 mb-1 " type="submit">
                                                        Simpan Data<i class="material-icons right">send</i>
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="../../../app-assets/js/scripts/form-elements.js"></script>
@endsection
