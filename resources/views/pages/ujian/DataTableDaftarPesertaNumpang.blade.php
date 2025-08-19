@if(!empty($sql))
    <div class="col s12">
        <div id="basic-form" class="card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title">Daftfar Mahasiswa Numpang Keluar</h4>
                <div class="row">
                    <div class="col s12">
                        <table id="page-length-option" class="display">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Masa</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>tujuan</th>
                                <th>lokasi_ujian</th>
                                <th>nomor_surat</th>
                                <th>Petugas</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $no = 1
                            @endphp
                            @foreach($sql as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$item->masa}}</td>
                                    <td>{{$item->nim}}</td>
                                    <td>
                                        @php
                                            $nim = $item->nim;
                                            $nama = (new App\Http\Controllers\srs\QuerySRSController)->getdpbynim($nim);
                                            echo $nama['nama_mahasiswa'];
                                        @endphp
                                    </td>
                                    <td> {{$item->kode_upbjj_ujian_tujuan}} / {{$item->nama_upbjj_ujian_tujuan}}</td>
                                    <td> {{$item->nama_wilayah_ujian_tujuan}}</td>
                                    <td> {{$item->nomor_surat}}</td>
                                    <td> {{$item->user_create}}</td>
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
