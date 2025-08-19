<table id="data-table-simple" class="display">
    <thead>
    <tr>
        <th>Masa</th>
        <th width="20%">Nama Tutor</th>
        <th width="2%">Kode Mtk</th>
        {{--                                                        <th>Telp Tutor</th>--}}
        <th>Hari</th>
        <th>Tanggal Mulai</th>
        <th>Jam</th>
        <th>Link</th>
        <th>Kelas</th>
        <th>Aksi</th>

    </tr>
    </thead>
    <tbody>
    @if(!empty($data_tutor))
        @foreach($data_tutor as $data)
            <tr>
                <td align='left'>{{ $data['masa'] }} </td>
                <td align='left'>{{ $data['nama_tutor'] }} </td>
                <td align='center'>{{ $data['kode_matakuliah'] }} </td>
                <td align='left'> {{$data['nama_hari']}}
                <td align='left'>{{ $data['tanggal_mulai'] }} </td>
                <td align='left'>{{ $data['jam']}} </td>
                <td align='left'>
                    @if(empty($data['link']))
                        <a>{{ $data['lokasi'] }}</a>
                    @else
                        <a href="{{ $data['link'] }}">{{ $data['link'] }}</a>
                    @endif
                </td>
                <td></td>
                {{--                <td align="center" width="5%"><a href="{{ route('jadwal.tutorial.idtutorial', ['id' => Crypt::encrypt($data->kelas),'idtutorial' => $data->idtutorial])}}"> {{$data->kelas}} </a></td>--}}

            </tr>
        @endforeach
    @endif
    </tbody>
</table>
