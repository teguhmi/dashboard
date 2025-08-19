@if(!empty($sql))
<div class="col s12 m12 l12">
    <div class="section section-data-tables">
        <div id="button-trigger" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title">Proses Layanan KTM</h4>
                <div class="row">
                    <div class="col s12">
                        {{--                                    <h4 class="card-title">Data Sertifikat</h4>--}}
                        <table id="page-length-option" class="display">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Nomor HP</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach($sql as $data)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$data->nim}}</td>
                                <td>{{$data->nama_mahasiswa}}</td>
                                <td>{{$data->handphone}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->status}}</td>
                                <td></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
