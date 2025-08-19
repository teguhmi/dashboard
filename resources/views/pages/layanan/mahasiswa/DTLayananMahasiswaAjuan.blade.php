@if(!empty($dataLayanan))
{{--                    <div class="col s12">--}}
    <div class="container">
                                    <div class="col s12">
            <div class="section section-data-tables">
                <div id="button-trigger" class="card card card-default scrollspy">
                    <div class="card-content">
                        <h4 class="card-title">Data Permohonan Layanan</h4>
                        <div class="col s12">
                            <table id="data-table-simple" class="display">
                                <thead>
                                <tr>
                                    <th>Jenis Layanan</th>
                                    <th>Tanggal Pengajuan</th>
                                    {{--                                    <th hidden>No</th>--}}
                                    {{--                                                <th>Nomor HP</th>--}}
                                    {{--                                                <th>Alamat Email</th>--}}
                                    <th>Informasi Ajuan</th>
                                    <th>Jawaban</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach($dataLayanan as $data)
                                <tr>
                                    <td> {{$data->keterangan}}</td>
                                    <td>{{$data->user_date_create}}</td>
                                    {{--                                    <td class="center-align" hidden >{{$no++}}</td>--}}
                                    {{--                                                    <td>--}}
                                        {{--                                                        @if (Auth::check())--}}
                                        {{--                                                            {{$data->handphone}}--}}
                                        {{--                                                        @else--}}
                                        {{--                                                            @if(strlen($data->handphone) > 4)--}}
                                        {{--                                                                {{str_repeat('*', strlen($data->handphone) - 4) . substr($data->handphone, -4)}}--}}
                                        {{--                                                            @else--}}
                                        {{--                                                                ---}}
                                        {{--                                                            @endif--}}
                                        {{--                                                        @endif--}}
                                        {{--                                                    </td>--}}
                                    {{--                                                    <td>--}}
                                        {{--                                                        @if (Auth::check())--}}
                                        {{--                                                            {{$data->email}}--}}
                                        {{--                                                        @else--}}
                                        {{--                                                            {{str_repeat('*', strlen($data->email) - 9) . substr($data->email, -17)}}--}}
                                        {{--                                                        @endif--}}
                                        {{--                                                    </td>--}}
                                    <td>{{$data->keluhan}}</td>
                                    <td>{{$data->jawaban}}</td>
                                    <td>{{$data->status}}</td>
                                    <td>
                                        @php
                                            $timestamp = strtotime($data->user_date_create);
                                        @endphp
                                        @if($data->status == 'baru'  )
                                        <a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-amber"
                                           href="{{route('mahasiswa.hapus', ['id' => Crypt::encrypt($data->id),'jenis' =>'hapus']) }}"
                                           onclick="return confirm('Hapus Pengajuan ?');"><i
                                                class="material-icons">delete_forever</i>
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
    @endif
