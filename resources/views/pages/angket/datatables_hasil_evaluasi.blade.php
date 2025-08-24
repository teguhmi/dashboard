@if(!empty($data_array))
    {{--    <div class="col s12 m12 l12">--}}
    {{--        <div class="section section-data-tables">--}}
    <div id="basic-form" class="card card-default scrollspy">
        <div class="card-content">
            <h4 class="card-title">Hasil Evaluasi Tutorial TTM/Tuweb masa {{$data_array[0]->masa}}
            <div class="col s1 float-right">
                <a class="float-right waves-effect waves-light btn gradient-45deg-green-teal box-shadow-none border-round mr-1 mb-1"
                   href="">Excel
                </a>
            </div>
            </h4>
            <div class="row">
                <div class="col s12">
                    <table id="page-length-option" class="display" style="width: 100%">
                        <thead>
                        <tr class="center">
                            <th class="center">Nama Tutor</th>
                            <th class="center" style="width: 1%">ID Tutor</th>
                            <th class="center">Matakuliah</th>
                            <th class="center" style="width: 1%">Nilai</th>
                            <th class="center">Hasil Penilaian</th>
                            <th class="center">Rekomendasi</th>
                            <th class="center">Saran</th>
                            {{--                                                <th style="width: 1%" class="center">Masa</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach($data_array as $data)
                            <tr>
                                <td>{{$data->nama_lengkap}}</td>
                                <td>{{$data->id_tutor}}</td>
                                <td>{{$data->kode_matakuliah}} / {{$data->nama_matakuliah}}</td>
                                <td>{{$data->nilai_etm}}</td>
                                <td>{{$data->hasil}}</td>
                                <td>{{$data->rekomendasi}}</td>
                                <td>{{$data->saran}}</td>
                                {{--                                                    <td>{{$data->masa}}</td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif
