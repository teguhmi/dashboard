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
                                            <h4 class="card-title center">Angket Evaluasi Tutor Oleh Mahasiswa</h4>
                                            <h1 class="card-title center">Masa Registrasi </h1>

                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col s12 m12 l12 text">
                                         <span>  Demi meningkatkan kualitas tutorial, kami akan sangat menghargai jika Anda bersedia menilai tutor kami sesuai dengan pernyataan karakteristik tutor berikut. Kami harap, penilaian Anda dibatasi hanya
                                            pada masa registrasi sebagaimana tercantum di atas
                                    </span>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="input-field col s12 m12 l12">
                                            <label for="nim">Nama Tutor</label>
                                            <input placeholder="" name="tutor" id="tutor" type="text" value="{{$kelas->data[0]->id_tutor}} / {{$nama_tutor}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m12 l12">
                                        <label for="nim">Kelas / Kode Matakuliah / Nama Matakuliah</label>
                                        <input name="matakuliah" id="matakuliah" type="text" value="{{$kelas->data[0]->id_kelas}} / {{$kelas->data[0]->kode_matakuliah}} / {{$kelas->data[0]->nama_matakuliah}}" readonly>

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
                                           href="{{ secure_url(URL::route ('jadwal.tutorial.home', ['id' => Crypt::encrypt($nim)]))}}">Batalkan Pengisian Angket
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col s12">
                            <div id="radio-buttons" class="card card-tabs">
                                <div class="card-content">
                                    <div class="card-title">
                                        {{--                                    <div class="row">--}}
                                        {{--                                        <div class="col s12 m6 l10">--}}
                                        {{--                                            <h4 class="card-title">Angket Evaluasi Tutor Oleh Mahasiswa</h4>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                    </div>
                                    <form role="form" method="POST" action="{{ route('angketetmsimpan') }}" id="form">
                                        @csrf
                                        <div id="angket">
                                            <input type="hidden" name="kelas" value="{{$kelas->data[0]->id_kelas}}">
                                            <input type="hidden" name="nim" value="{{$nim}}">
                                            <input type="hidden" name="masa" value="{{$kelas->data[0]->masa}}">
                                            <input type="hidden" name="nama_tutor" value="{{$nama_tutor}}">
                                            @if(!empty($data))
                                                @foreach($data as $row)
                                                    <table class="striped">
                                                        <tbody>
                                                        <tr>
                                                            <input name="nomor_soal_{{$row->nomor}}" type="hidden" value="{{$row->nomor}}"/>
                                                            <td width="5%">{{$row->nomor}}</td>
                                                            <td colspan="4">{{$row->pertanyaan}}</td>
                                                        </tr>
                                                        @if(!empty($pola))
                                                            <tr>
                                                                <td></td>
                                                                <td align="left" width="20px">
                                                                    <p class="mb-3">
                                                                        <label>
                                                                            <input name="jawaban_{{$row->nomor}}" type="radio" value="{{$pola[0]->key}}" required/><span> {{$pola[0]->keterangan}}</span>
                                                                        </label>
                                                                    </p>
                                                                </td>
                                                                <td align="left" width="15px">
                                                                    <p class="mb-1">
                                                                        <label>
                                                                            <input name="jawaban_{{$row->nomor}}" type="radio" value="{{$pola[1]->key}}" required/><span> {{$pola[1]->keterangan}}</span>
                                                                        </label></p>
                                                                </td>
                                                                <td align="left" width="15px">
                                                                    <p class="mb-1">
                                                                        <label>
                                                                            <input name="jawaban_{{$row->nomor}}" type="radio" value="{{$pola[2]->key}}" required/><span> {{$pola[2]->keterangan}}</span>
                                                                        </label>
                                                                    </p>
                                                                </td>
                                                                <td align="left" width="15px">
                                                                    <p class="mb-1">
                                                                        <label>
                                                                            <input name="jawaban_{{$row->nomor}}" type="radio" value="{{$pola[3]->key}}" required/><span> {{$pola[3]->keterangan}}</span>
                                                                        </label>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button class="waves-effect waves-light  btn gradient-45deg-green-teal box-shadow-none border-round mr-1 mb-1 " type="submit">
                                            Simpan Data
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </form>
                                    <table>
                                        <tr>
                                            <td width="97%" valign="top" align="center" colspan="5" style="border-style: none; border-width: medium">
                                                <div class="well" style="text-align: center;">
                                                    <i> <span style="font-family: Arial; font-size: small; "><b>Terima Kasih Atas Waktu dan Masukan yang anda berikan,Semua masukan yang anda berikan
                                                        akan kami terima sebagai sarana bagi kami untuk meningkatkan kulaitas pelanan kami</b> </span> </i>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('script')
            <script src="../../../app-assets/js/scripts/form-elements.js"></script>
@endsection
