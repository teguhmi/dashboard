@if(!empty($pendidikantutor))
    <div class="col s12 m12 l12">
        <div id="Form-advance" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title">Pendididikan Tutor</h4>
                <div class="row">
                    <div class="col s12">
                        <table>
                            <tbody>
                            <tr>
                                <td colspan="3" style="font-weight: bold;text-align: center">Perguruan Tinggi</td>
                            </tr>
                            @foreach($pendidikantutor as $data)
                                <tr>
                                    <td>{{$data['nama_perguruan_tinggi']}}</td>
                                    <td>{{$data['nama_pendidikan_akhir']}}</td>
                                    <td>{{$data['bidang_studi']}}</td>
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
