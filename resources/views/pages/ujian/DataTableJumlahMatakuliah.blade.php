@if(!empty($sql))
    <div class="col s12">
        <div id="basic-form" class="card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title">Jumlah Matakuliah</h4>
                <div class="row">
                    <div class="col s12">
                        <table id="page-length-option" class="display">
                            <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Tujuan</th>
                                <th>Lokasi</th>
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
                                    <td>{{$item->hari}}</td>
                                    <td>{{$item->kode_upbjj_ujian_tujuan}} / {{$item->nama_upbjj_ujian_tujuan}}</td>
                                    <td>{{$item->kode_tempat_ujian_tujuan}} / {{$item->nama_wilayah_ujian_tujuan}}</td>
                                    <td>{{$item->jam_1}}</td>
                                    <td>{{$item->jam_2}}</td>
                                    <td>{{$item->jam_3}}</td>
                                    <td>{{$item->jam_4}}</td>
                                    <td>{{$item->jam_5}}</td>
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
