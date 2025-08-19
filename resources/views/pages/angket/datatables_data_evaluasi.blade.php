@if(!empty($array))
    {{--    <div class="col s12 m12 l12">--}}
    {{--        <div class="section section-data-tables">--}}
    <div id="basic-form" class="card card-default scrollspy">
        <div class="card-content">
            <h4 class="card-title">Data Evaluasi Tutorial TTM/Tuweb masa {{$masa}}</h4>
            <div class="row">
                <div class="col s12">
                    <table id="data-table-simple" class="display" style="width: 100%">
                        <thead>
                        <tr class="center">
                            <th class="center" style="width: 40%">Nama Tutor</th>
                            <th class="center" style="width: 1%">ID Tutor</th>
                            <th class="center" style="width: 40%">Matakuliah</th>
                            <th class="center" style="width: 10%">ETM</th>
                            <th class="center" style="width: 10%">ETU</th>
                            {{--                                                <th style="width: 1%" class="center">Masa</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach($array as $data)
                            @php
                                $idtutor = $data['idtutor'] ?? '';
                                $masa = $data['masa']?? '';
                                $kodemtk = $data['kodemtk'] ?? '';
                                $etm = $data['etm'] ?? '';
                                $cekjadwal = \App\Models\angket\angketEvaluasiModel::get_jadwal_ttm($masa,$idtutor,$kodemtk);
                                $cekhasil = \App\Models\angket\angketEvaluasiModel::get_hasil_etu($masa,$idtutor,$kodemtk);
                            @endphp

                            @if(!empty($cekjadwal))
                                <tr>
                                    <td>{{$data['nama_lengkap']?? ''}}</td>
                                    <td>{{$data['idtutor']?? ''}}</td>
                                    <td>{{$data['kodemtk']?? ''}} / {{$data['nama_matakuliah']?? ''}}</td>

                                    <td class="center">
                                        @if ($etm < 5)
                                            <i class="material-icons">block</i>
                                        @else
                                            <a class="mb-3 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow" target="blank"
                                               href="{{route('angket.rekomendasi',[
                                                                        'id1' => Crypt::encrypt($data['masa'] ?? ''),
                                                                        'id2' => Crypt::encrypt($data['idtutor']?? ''),
                                                                        'id3' =>Crypt::encrypt($data['kodemtk']?? ''),
                                                                        'id4' => 'dataetm'
                                                                    ])}}">
                                                <i class="material-icons">print</i>
                                            </a>
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if ($etm >= 5)
                                            @if(!empty($cekhasil))
                                                <a title="" class="mb-3 btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow" target="blank"
                                                   href=" {{route('angket.rekomendasi',['id1' => Crypt::encrypt($masa),'id2' => Crypt::encrypt($idtutor),'id3' =>Crypt::encrypt($kodemtk),'id4' => 'rekomendasi'])}}"><i class="material-icons">search</i>
                                                </a>
                                            @else
                                                <a class="waves-effect waves-light btn gradient-45deg-cyan-light-green box-shadow-none border-round mr-1 mb-1"
                                                   href=" {{route('angketetu',['id1' => Crypt::encrypt($masa),'id2' => Crypt::encrypt($idtutor),'id3' =>Crypt::encrypt($kodemtk),'id4' => 'angketetu'])}}"> Isi ETU
                                                </a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endif

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--        </div>--}}
    {{--    </div>--}}
@endif
