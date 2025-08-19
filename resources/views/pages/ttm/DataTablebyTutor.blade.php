<table>
    <tr>
        <td width="10%">Masa</td>
        <td width="1%">:</td>
        <td>{{$data_tutor[0]['masa']}}</td>
    </tr>
    <tr>
        <td>Tutor</td>
        <td>:</td>
        <td>{{$data_tutor[0]['id_tutor']}} / {{$data_tutor[0]['nama_tutor']}}</td>
    </tr>

</table>

<table id="data-table-simple" class="display">
    <thead>
    <tr>
        {{--        <th>Masa</th>--}}
        {{--        <th width="20%">Nama Tutor</th>--}}
        <th width="2%">Matakuliah 1</th>
        <th>Hari</th>
        <th>Tanggal Mulai</th>
        <th>Jam</th>
        <th>lokasi</th>
        <th>Link</th>
        <th>Kelas</th>
        <th>Status</th>

    </tr>
    </thead>
    <tbody>
    @if(!empty($data_tutor))
        @foreach($data_tutor as $data)
            <tr>
                {{--                <td align='left'>{{ $data['masa'] }} </td>--}}
                {{--                <td align='left'>{{ $data['nama_tutor'] }} </td>--}}
                <td align='center'>{{ $data['kode_matakuliah'] }} / {{ $data['nama_matakuliah'] }}  </td>
                <td align='left'> {{$data['nama_hari']}}
                <td align='left'>{{ $data['tanggal_mulai'] }} </td>
                <td align='left'>{{ $data['jam']}} </td>
                <td align='left'>{{ $data['lokasi'] }}</td>
                <td><a href="{{ $data['link'] }}">{{ $data['link'] }}</a></td>
                <td align="center" width="5%"><a href="{{ route('ttm.jadwal.kelas', ['id1' => Crypt::encrypt($data['masa']),'id2' => Crypt::encrypt($data['id_kelas']),'id3' => $data['id_tutorial']])}}"> {{$data['id_kelas']}} </a></td>
                <td>{{ $data['status'] }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
