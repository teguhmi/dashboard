@if(!empty($sql))
    <div class="col s12">
        <div id="basic-form" class="card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title">Daftar Peserta Numpang Ujian Masuk {{config('app.upbjj')}}</h4>
                <div class="row">
                    <div class="col s12">
                        <table id="page-length-option" class="display">
                            <thead>
                            <tr>
                                <th>Masa</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Kode TPU</th>
                                <th>Nama TPU</th>
                                <th>Kode Matakuliah</th>
                                <th>Petugas</th>
                                <th>Tanggal Input</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $no = 1
                            @endphp
                            @foreach($sql as $item)
                                <tr>
                                    <td>{{$item->masa}}</td>
                                    <td>{{$item->nim}}</td>
                                    <td>{{$item->nama_mahasiswa}}</td>
                                    <td>{{$item->kode_tpu}}</td>
                                    <td>{{$item->nama_tpu}}</td>
                                    <td>{{$item->kode_mtk}}</td>
                                    <td>{{$item->user_create}}</td>
                                    <td>{{$item->user_date_create}}</td>
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
