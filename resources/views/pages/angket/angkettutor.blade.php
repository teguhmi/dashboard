@extends('pages.dashboardjadwal')
@section('head')

@endsection
@section('content')

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6 breadcrumbs-left">
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Data Tutorial</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('angket.tutor')}}">Data Kelas Tutor</a>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @include('panels.bannerinfo')

            <div class="col s12">
                <div class="container">
                    <div class="section section-data-tables">
                        <div id="button-trigger" class="card card card-default scrollspy">
                            <div class="card-content">
                                <h4 class="card-title">Data Kelas Tutor </h4>
                                <form role="form" method="POST" action="{{ route('angket.tutor.cari') }}" id="form">
                                    @csrf
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="col s12 m4 l4">
                                                <label for="jenis"> Pencarian berdasarkan</label>
                                                <select class="select2 browser-default" name="jenis" id="jenis">
                                                    <option value="idnamatutor" @if(!empty($jenis))@if($jenis == "idnamatutor") selected @endif @endif >ID Tutor / Nama Tutor</option>
                                                    <option value="masa" @if(!empty($jenis))@if($jenis == "masa") selected @endif @endif >Masa</option>
                                                    <option value="matakuliah" @if(!empty($jenis))@if($jenis == "matakuliah") selected @endif @endif >Kode Matakuliah</option>
                                                </select>

                                            </div>

                                            <div class="input-field col s12 m8 l8">
                                                <label for="id">Masukkan kata kunci </label>
                                                <input placeholder="" name='id' type="text" value="">

                                            </div>
                                            <div class="input-field col s12">
                                                <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Cari Jadwal
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
            <!-- Page Length Options -->
            @if(!empty($data_array))
                <div class="col s12 m12 l12">
                    <div class="section section-data-tables">
                        <div id="button-trigger" class="card card card-default scrollspy">
                            <div class="card-content">
                                <h4 class="card-title">Data Tutorial</h4>
                                <div class="row">
                                    @if($jenis == 'masa' || $jenis === 'idnamatutor')
                                        @if($jenis == 'idnamatutor')
                                            <div class="col s12 m12 l12">
                                                <hr>
                                                <div class="row">
                                                    <div class="input-field col s12 m12 l12">
                                                        <label for="tutor">Nama Tutor</label>
                                                        <input placeholder="" name="tutor" id="tutor" type="text" value="{{$data_array[0]['id_tutor'] }} / {{$data_array[0]['nama_lengkap']}} " readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col s12 m12 l12">
                                            <table id="page-length-option" class="display" border="1">
                                                <thead>
                                                <tr class="center">
                                                    <th width="1%" class="center">Masa</th>
                                                    @if($jenis == 'masa')
                                                        <th width="20%" class="center">Nama Tutor</th>
                                                        <th width="5%" class="center">ID Tutor</th>
                                                    @endif
                                                    <th width="5%">ID Tutorial</th>
                                                    <th width="50%" class="center">Matakuliah</th>
                                                    @if($jenis != 'masa')
                                                        <th width="8%" class="center">ETM</th>
                                                        <th width="8%" class="center">ETU</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach($data_array as $data)
                                                    <tr>
                                                        @if($jenis != 'masa')
                                                            @php
                                                                $idtutor = $data['id_tutor'];
                                                                $masa = $data['masa'];
                                                                $kodemtk = $data['kode_matakuliah'];
                                                                $ceketm = \App\Models\angket\angketTutorModel::getETMByKelas_1($masa,$idtutor,$kodemtk);
                                                                $ceketu = \App\Models\angket\angketTutorModel::getETUByKelas_1($masa,$idtutor,$kodemtk);

                                                            @endphp
                                                        @endif
                                                        {{--                                                        <td>{{$no++}}</td>--}}
                                                        <td>{{$data['masa']}}</td>
                                                        @if($jenis === 'masa')
                                                            <td>{{$data['nama_lengkap']}}</td>
                                                            <td>{{$data['id_tutor']}}</td>
                                                        @endif
                                                        <td>{{$data['id_tutorial']}}</td>
                                                        <td>{{$data['kode_matakuliah']}} / {{$data['nama_matakuliah']}}</td>
                                                        @if($jenis != 'masa')
                                                            <td class="center">
                                                                @if (empty($ceketm))
                                                                    <a> Belum Ada ETM </a>
                                                                @else
                                                                    @if(count($ceketm) >= 5)
                                                                        <a class="mb-3 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow" target="blank" href="{{route('angket.rekomendasi',[
                                                                        'id1' => Crypt::encrypt($data['masa']),
                                                                        'id2' => Crypt::encrypt($data['id_tutor']),
                                                                        'id3' =>Crypt::encrypt($data['kode_matakuliah']),
                                                                        'id4' => 'dataetm'
                                                                    ])}}">
                                                                            <i class="material-icons">print</i>
                                                                        </a>
                                                                    @else
                                                                        <a> Belum memenuhi kriteria Penilaian</a>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td class="center">
                                                                @if ((Auth::check() &&  (Auth::user()->hakakses == 'admin' ))
                                                                        || (Auth::check() && (Auth::user()->hakakses == 'bblba'))
                                                                        || (Auth::check() && (Auth::user()->hakakses == 'pjw')) )
                                                                    @if(count($ceketm) >= 5)
                                                                        @if (empty($ceketu) && !empty($ceketm))
                                                                            <a class="waves-effect waves-light btn gradient-45deg-cyan-light-green box-shadow-none border-round mr-1 mb-1"
                                                                               href=" {{route('angketetu',[
                                                                        'id1' => Crypt::encrypt($data['masa']),
                                                                        'id2' => Crypt::encrypt($data['id_tutor']),
                                                                        'id3' =>Crypt::encrypt($data['kode_matakuliah']),
                                                                        'id4' => 'angketetu'
                                                                    ])}}"> Isi ETU
                                                                            </a>
                                                                        @elseif(!empty($ceketu ) && !empty($ceketm))
                                                                            <a title="" class="mb-3 btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow" target="blank"
                                                                               href=" {{route('angket.rekomendasi',[
                                                                        'id1' => Crypt::encrypt($data['masa']),
                                                                        'id2' => Crypt::encrypt($data['id_tutor']),
                                                                        'id3' =>Crypt::encrypt($data['kode_matakuliah']),
                                                                        'id4' => 'rekomendasi'
                                                                    ])}}">
                                                                                <i class="material-icons">search</i>
                                                                            </a>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                    @if($jenis == 'matakuliah')
                                            <div class="col s12 m12 l12">
                                                <hr>
                                                <div class="row">
                                                    <div class="input-field col s12 m12 l12">
                                                        <label for="tutor">Matakuliah</label>
                                                        <input placeholder="" name="tutor" id="tutor" type="text" value="{{$data_array[0]['kode_matakuliah']}} / {{$data_array[0]['nama_matakuliah']}} " readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="col s12 m12 l12">
                                            <table id="page-length-option" class="display">
                                                <thead>
                                                <tr class="center">
                                                    <th>Nama Tutor</th>
                                                    <th>ID Tutor</th>
                                                    <th>ID Tutorial</th>
                                                    <th>Masa</th>
                                                    <th>Kelas</th>
{{--                                                    <th>Matakuliah</th>--}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach($data_array as $data)
                                                    <tr>
                                                        <td>{{$data['nama_lengkap']}}</td>
                                                        <td>{{$data['id_tutor']}}</td>
                                                        <td>{{$data['id_tutorial']}}</td>
                                                        <td>{{$data['masa']}}</td>
                                                        <td>{{$data['kelas']}}</td>
{{--                                                        <td>{{$data['kode_matakuliah']}} / {{$data['nama_matakuliah']}}</td>--}}
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
@endsection
@section('script')
    <script src="{{url('app-assets/js/scripts/data-tables.js')}}"></script>

@endsection
