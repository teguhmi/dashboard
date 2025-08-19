@if(!empty($matakuliahampu))
    <div class="col s12 ">
        <div id="Form-advance" class="card card card-default scrollspy">
            <div class="card-content">
                <div class="row">
                    <div class="col s12">
                        <table>
                            <tbody>
                            <tr>
                                <td colspan="2" style="font-weight: bold;text-align: center">Matakuliah Ampu</td>
                            </tr>
                            @foreach($matakuliahampu as $data)
                                <tr>
                                    <td width="1$"> {{$data['kode_matakuliah']}}</td>
                                    <td>{{$data['nama_matakuliah']}}</td>
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
