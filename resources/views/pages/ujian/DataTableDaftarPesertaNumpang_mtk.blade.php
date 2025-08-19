@if(!empty($sql))
    <div class="col s12">
        <div id="basic-form" class="card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title">Daftar Mahasiswa Numpang Ujian Masa {{$sql[0]->masa}} Tujuan {{$sql[0]->nama_upbjj_ujian_tujuan}} </h4>
                <div class="row">
                    <div class="col s12">
                        <br>
                        <a class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb- left btn-small "
                           href="{{route('ujian.laporannumpang.pdf', ['masa' => Crypt::encrypt($sql[0]->masa),'t' => Crypt::encrypt($sql[0]->kode_upbjj_ujian_tujuan)]) }}" target="_blank">Cetak Daftar
                        </a>
                        <table id="page-length-option" class="display">
                            <thead>
                            <tr>
{{--                                <th>No</th>--}}
{{--                                <th>Masa</th>--}}
                                <th>Hari</th>
                                <th>lokasi_ujian</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                {{--                                            <th>tujuan</th>--}}
                                <th>Jam 1</th>
                                <th>Jam 2</th>
                                <th>Jam 3</th>
                                <th>Jam 4</th>
                                <th>Jam 5</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $no = 1
                            @endphp
                            @foreach($sql as $item)
                                <tr>
{{--                                    <td>{{$no++}}</td>--}}
{{--                                    <td>{{$item->masa}}</td>--}}
                                    <td> {{$item->hari}}</td>
                                    <td> {{$item->nama_wilayah_ujian_tujuan}}</td>
                                    <td>{{$item->nim}}</td>
                                    <td>{{$item->nama_mahasiswa}}</td>
                                    {{--                                    <td>--}}
                                    {{--                                        @php--}}
                                    {{--                                            $nim = $item->nim;--}}
                                    {{--                                            $nama = (new App\Http\Controllers\srs\QuerySRSController)->getdpbynim($nim);--}}
                                    {{--                                            echo $nama['nama_mahasiswa'];--}}
                                    {{--                                        @endphp--}}
                                    {{--                                    </td>--}}
                                    {{--                                                <td> {{$item->kode_upbjj_ujian_tujuan}} / {{$item->nama_upbjj_ujian_tujuan}}</td>--}}

                                    <td> {{$item->kode_mtk_1}}</td>
                                    <td> {{$item->kode_mtk_2}}</td>
                                    <td> {{$item->kode_mtk_3}}</td>
                                    <td> {{$item->kode_mtk_4}}</td>
                                    <td> {{$item->kode_mtk_5}}</td>
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
