@if(!empty($sql))
    <div class="col s12">
        <div class="section section-data-tables">
            <div id="button-trigger" class="card card card-default scrollspy">
                <div class="card-content">
                    <div class="row">
                        <div class="col col s12 ">
                            <h4 class="card-title">Data Aduan Mahasiswa Status Aduan {{strtoupper($sql[0]->status)}} Jenis Aduan {{$sql[0]->keterangan}}</h4>
                        </div>

                        <div class="col s12">
                            <table id="page-length-option" class="display">
                                <thead>
                                <tr>
                                    {{--                                                <th>No</th>--}}
                                    {{--                                                <th>Masa</th>--}}
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Nomor HP</th>
                                    <th>Email</th>
                                    @if($sql[0]->id_jenis == 3)
                                        <th>Password</th>
                                    @endif
                                    <th>Tanggal Pengajuan</th>
                                    {{--                                                <th>Status</th>--}}
                                    <th>Informasi Layanan</th>
                                    <th>Jawaban</th>
                                    <th>Opsi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($sql as $items)
                                    <tr>
                                        {{--                                                    <td>{{$no++}}</td>--}}
                                        {{--                                                    <td>{{$items->masa}}</td>--}}
                                        <td>{{$items->nim}}</td>
                                        <td>{{$items->nama_mahasiswa}}</td>
                                        <td>{{$items->handphone}}</td>
                                        <td>{{$items->email}}</td>
                                        @if($sql[0]->id_jenis == 3)
                                            <td>{{$items->password}}</td>
                                        @endif
                                        <td>{{$items->user_date_create}}</td>
                                        <td>{{$items->keluhan}}</td>
                                        <td>{{$items->jawaban}}</td>

                                        {{--                                                    <td>{{$items->status}}</td>--}}
                                        <td>
                                            {{--                                                        <a class="btn  btn-small cyan waves-effect waves-light gradient-45deg-indigo-light-blue"--}}
                                            {{--                                                           href="{{route('helpdesk.aduan.ubah', ['id' => Crypt::encrypt($items->id),'jenis' => 'selesai']) }}">--}}
                                            {{--                                                            Selesai--}}
                                            {{--                                                        </a> --}}
                                            {{--                                            <a class="btn  btn-small cyan waves-effect waves-light gradient-45deg-indigo-light-blue btn modal-trigger" href="#modal1">--}}
                                            {{--                                                {{$items->status}}--}}
                                            {{--                                            </a>--}}
                                            @if($items->id_jenis == 5)
                                                <a class="btn  btn-small cyan waves-effect waves-light gradient-45deg-indigo-light-blue"
                                                   href="{{route('ujian.numpangkeluar.reload', ['id' => Crypt::encrypt($items->nim)]) }}" target="_blank">
                                                    {{$items->status}}
                                                </a>
                                            @else
                                                <button class="btn  btn-small cyan waves-effect waves-light gradient-45deg-indigo-light-blue btn modal-trigger"
                                                        href="#modal1" onclick="edit('{{$items->id}}')">
                                                    {{$items->status}}
                                                </button>
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
@endif
