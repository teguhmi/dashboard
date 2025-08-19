<table id="data-table-simple" class="display">
    <thead>
    <tr>
        <th>Masa</th>
        <th width="5%">NIM</th>
        <th width="20%">Nama Mahasiswa</th>
        <th>Hari</th>
        <th>Tanggal Mulai</th>
        <th>Jam</th>
        <th>Nama Tutor</th>
        <th>Matakuliah</th>
        <th>Link</th>
        <th>Kelas</th>
        <th>Aksi</th>

    </tr>
    </thead>
    <tbody>

    @if(!empty($data_mhs))
        @foreach($data_mhs as $data)
            <tr>
                <td align='left'>{{ $data['masa'] }} </td>
                <td align='left'>{{ $data['nim'] }} </td>
                <td align='left'>{{ $data['nama_mahasiswa'] }} </td>
                <td align='left'>{{$data['nama_hari']}}  </td>
                <td align='left'>{{ $data['tanggal_mulai'] }} </td>
                <td align='left'>{{ $data['jam']}} </td>
                <td align='left'>{{ $data['nama_tutor'] }} </td>
                <td align='center'>{{ $data['kode_matakuliah'] }} </td>
                {{--                                                                <td align='left'>{{ $datatelepon }} </td>--}}
                <td align='left'>
                    @if(empty($data['link']))
                        <a>{{ $data['lokasi'] }}</a>
                    @else
                        <a href="{{ $data['link'] }}">{{ $data['link'] }}</a>
                    @endif
                </td>
                <td align="center" width="5%"><a href="{{ route('ttm.jadwal.kelas', ['id1' => Crypt::encrypt($data['masa']),'id2' => Crypt::encrypt($data['id_kelas']),'id3' => $data['id_tutorial']])}}"> {{$data['id_kelas']}} </a></td>
                <td></td>
                {{--                                                                <td align="center">--}}
                {{--                                                                    <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1"--}}
                {{--                                                                       href="{{ secure_url(URL::route ('angketetm', ['id1' => Crypt::encrypt($data['id_kelas']),'id2' => Crypt::encrypt($data['nim']),'id3' =>Crypt::encrypt($data['id_tutor'])]--}}
                {{--                                                                                                                                          ))}}">Isi Angket--}}
                {{--                                                                    </a>--}}
                {{--                                                                </td>--}}
            </tr>
        @endforeach
    @endif
    @if(!empty($data_tutor))
        @foreach($data_tutor as $data)
            <tr>
                <td align='left'>{{ $data['masa'] }} </td>
                <td align='center'>{{ $data['kode_matakuliah'] }} </td>
                <td align='left'>{{ $data['nama_tutor'] }} </td>
                {{--                                                                <td align='left'>{{ $data->telepon }} </td>--}}
                <td align='left'>{{ $data['tanggal_mulai'] }} </td>
                <td align='left'> {{$data['nama_hari']}}

                </td>
                <td align='left'>{{ $data['jam']}} </td>
                <td align='left'>
                    @if(empty($data['link']))
                        <a>{{ $data['lokasi'] }}</a>
                    @else
                        <a href="{{ $data['link'] }}">{{ $data['link'] }}</a>
                    @endif
                </td>

                {{--                                                                <td align="center" width="5%"><a href="{{ route('jadwal.tutorial.idtutorial', ['id' => Crypt::encrypt($data->kelas),'idtutorial' => $data->idtutorial])}}"> {{$data->kelas}} </a></td>--}}

                <td></td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
