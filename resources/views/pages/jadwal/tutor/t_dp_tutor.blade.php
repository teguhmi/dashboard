@if(!empty($DPtutor))
    <div class="col s12 m6 l6">
        <div id="Form-advance" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title">Data Tutor</h4>
                <div class="row">
                    <div class="col s12">
                        <table>
                            @foreach($DPtutor as $data)
                                <tbody>
                                <tr>
                                    <td width="25%">ID Tutor</td>
                                    <td width="1%">:</td>
                                    <td width="100%">{{$data->idtutor}}</td>
                                </tr>
                                <tr>
                                    <td>Nama Tutor</td>
                                    <td>:</td>
                                    <td>{{$data->namalengkap}}</td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>:</td>
                                    <td>{{$data->noidentitas}}</td>
                                </tr>
                                <tr>
                                    <td>Golongan</td>
                                    <td>:</td>
                                    <td>{{$data->golongan}}</td>
                                </tr>
                                <tr>
                                    <td>NPWP</td>
                                    <td>:</td>
                                    <td>{{$data->npwp}}</td>
                                </tr>
                                <tr>
                                    <td>Bank</td>
                                    <td>:</td>
                                    <td>{{$data->nama_bank}}</td>
                                </tr>
                                <tr>
                                    <td>No. Rekening</td>
                                    <td>:</td>
                                    <td>{{$data->norekening}}</td>
                                </tr>

                                <tr>
                                    <td>Telepon</td>
                                    <td>:</td>
                                    <td>{{$data->telepon}}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:</td>
                                    <td>{{$data->keterangan}}</td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
