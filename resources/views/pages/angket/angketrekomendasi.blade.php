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
{{--                <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">--}}
                    <!-- Search for small screen-->
                    <div class="container">
                        <div class="row">
                            <div class="col s10 m6 l6 breadcrumbs-left">
                                <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Angket</span></h5>
                                <ol class="breadcrumbs mb-0">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                    </li>
                                    {{--                                    <li class="breadcrumb-item"><a href="{{route('angket.rekomendasi')}}">Rekomendasi</a>                                    </li>--}}
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @include('panels.bannerinfo')
                @if(!empty($query))
                    <div class="col s12 m6 l6">
                        <div id="data" class="card card-tabs">
                            <div class="card-content">
                                <div class="card-title">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h4 class="card-title center">Rekomendasi Tutor</h4>

                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="input-field col s12 m12 l12">
                                        <label for="nim">Nama Tutor</label>
                                        <input placeholder="" name="tutor" id="tutor" type="text" value="{{$query[0]->idtutor }} / {{$query[0]->nama_tutor}} " readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m12 l12">
                                        <label for="nim">Kelas / Kode Matakuliah / Nama Matakuliah</label>
                                        <input placeholder="" name="matakuliah" id="matakuliah" type="text" value="{{$query[0]->kelas}} / {{$query[0]->kode_mtk}} / {{$query[0]->nama_mtk}}" readonly>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s4 m4 l4">
                                        <label for="nama">UPBJJ-UT</label>
                                        <input placeholder="" name="nama_upbjj" id="nama_upbjj" type="text" value="{{config('app.upbjj')}}" readonly>
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

                                        <button class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1 right"
                                                onclick="goBack()">Kembali
                                        </button>
                                        <script> function goBack() {
                                                window.history.back();
                                            }</script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l6">
                        <div class="card card-tabs">
                            <div class="card-content">
                                <div class="card-title">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <h4 class="card-title center">Rekomendasi Tutor Berdasarkan Angket Tutorial</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <table>
                                            <tr>
                                                <td width="40%">Angket Evaluasi Tutor oleh Mahasiswa</td>
                                                <td>
                                                    <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1 right "
                                                       target="blank" href="{{route('angket.rekomendasi',
                                                        [
                                                            'id1'=> Crypt::encrypt($query[0]->masa),
                                                            'id2'=> Crypt::encrypt($query[0]->idtutor),
                                                            'id3'=> Crypt::encrypt($query[0]->kode_mtk),
                                                            'id4' => 'dataetm']) }}">Lihat Data
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Angket Evaluasi Tutor oleh {{config('app.upbjj')}}</td>
                                                <hr>
                                                <td>
                                                    <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1 right " target="blank"
                                                       href="{{route('angket.rekomendasi',
                                                            [
                                                                 'id1'=> Crypt::encrypt($query[0]->masa),
                                                                 'id2'=> Crypt::encrypt($query[0]->idtutor),
                                                                 'id3'=> Crypt::encrypt($query[0]->kode_mtk),
                                                                 'id4' => 'dataetu'
                                                            ]) }}">Lihat Data
                                                    </a>
                                                    @if ((Auth::check() &&  (Auth::user()->hakakses == 'admin' ) ||(Auth::check() && (Auth::user()->hakakses == 'pjb'))))
                                                        <a class="waves-effect waves-light btn gradient-45deg-brown-brownbox-shadow-none border-round mr-1 mb-1 right "
                                                           href="{{route('angket.rekomendasi',
                                                                [
                                                                    'id1'=> Crypt::encrypt($query[0]->masa),
                                                                    'id2'=> Crypt::encrypt($query[0]->idtutor),
                                                                    'id3'=> Crypt::encrypt($query[0]->kode_mtk),
                                                                    'id4' => 'hapusetu'
                                                                ]) }}">Hapus ETU
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Rekomendasi Tutor {{config('app.upbjj')}}</td>
                                                <td>
                                                    <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1 right "
                                                       target="blank" href="{{route('angket.rekomendasi',
                                                            [
                                                                'id1'=> Crypt::encrypt($query[0]->masa) ,
                                                                'id2'=> Crypt::encrypt($query[0]->idtutor) ,
                                                                'id3'=> Crypt::encrypt($query[0]->kode_mtk) ,
                                                                'id4' => 'datarekomendasi']) }}">Lihat Data
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col s12">
                                        <label for="saran"><strong>Saran</strong></label>
                                        <input type=text id="saran" name="saran" maxlength="200" value="{{$saran}}" readonly>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="card card-tabs">
                                <div class="card-content">
                                    <div class="card-title">
                                        <label class="card-title center">Rekomendasi Status Tutor Berdasarkan Hasil Evaluasi Mahasiswa dan {{config('app.upbjj')}}</label>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <table class="bordered" width="100%">
                                                <thead>
                                                <tr>
                                                    <th class="center" width="1%">No</th>
                                                    <th class="center" >Nama Tutor</th>
                                                    <th class="center" >Matakuliah</th>
                                                    <th class="center" width="11%">Hasil Evaluasi Tutor oleh Mahasiswa</th>
                                                    <th class="center" width="11%">Hasil Evaluasi Tutor oleh UPBJJ</th>
                                                    <th class="center" width="20%">Tindak Lanjut</th>
                                                </tr>
                                                </thead>
                                                @php $no = 1;@endphp
                                                <tbody>
                                                <tr>
                                                    <td class="center" >{{$no++}}</td>
                                                    <td>{{$query[0]->nama_tutor}}</td>
                                                    <td>{{$query[0]->kode_mtk}} - {{$query[0]->nama_mtk}}</td>
                                                    <td class="center">{{$total}}</td>
                                                    <td>{{$hasil}}</td>
                                                    <td>{{$rekomendasi}}</td>
                                                </tr>
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
