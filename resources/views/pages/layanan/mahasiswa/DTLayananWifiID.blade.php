@if(!empty($sql))
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="section section-data-tables">
                <div id="button-trigger" class="card card card-default scrollspy">
                    <div class="card-content">
                        <h4 class="card-title">Proses Layanan WIfi.id - Status = {{$sql[0]->status}}</h4>
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
                                        <th>Password</th>
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
                                            <td>
                                                @if(empty($data->id_wa))
                                                    @if(!empty($data->password))
                                                        {{--                                                                @if(config('app.kode_upbjj' == '44'))--}}
                                                        <a class="btn cyan waves-effect waves-light gradient-45deg-indigo-light-blue"
                                                           href="{{route('layanan.wifiID.proses', ['nim' => Crypt::encrypt($data->nim),'jenis' => 'wa']) }}">
                                                            Kirim WA
                                                        </a>

                                                        {{--                                                                @endif--}}
                                                    @else
                                                        {{$data->handphone}}
                                                    @endif
                                                @else
                                                    <a class="btn cyan waves-effect waves-light gradient-45deg-indigo-light-blue">
                                                        WA Terkirim
                                                    </a>
                                                @endif
                                            </td>
                                            {{--                                                    <a href="https://api.whatsapp.com/send?phone=62{{substr($data->handphone, 1)}}" target="_blank"> Kirim Pesan</a></td>--}}
                                            <td>{{$data->email}}</td>
                                            <td>
                                                @if(!empty($data->password))
                                                    {{$data->password}}
                                                @else
                                                    <a class="btn cyan waves-effect waves-light gradient-45deg-indigo-light-blue"
                                                       href="{{route('layanan.wifiID.proses', ['nim' => Crypt::encrypt($data->nim),'jenis' => 'pass']) }}">
                                                        Buat Password
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($data->id_wa))
                                                    <a class="btn cyan waves-effect waves-light gradient-45deg-indigo-light-blue">
                                                        Selesai
                                                    </a>
                                                @else
                                                    <a class="btn cyan waves-effect waves-light gradient-45deg-indigo-light-blue">
                                                        {{$data->status}}
                                                    </a>
                                                @endif
                                            </td>
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
    </div>
@endif
