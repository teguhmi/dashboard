<table>
    <tr>
        <td width="10%">Masa</td>
        <td width="1%">:</td>
        <td>{{$data_mhs[0]['masa']}}</td>
    </tr>
    <tr>
        <td>NIM</td>
        <td>:</td>
        <td>{{$data_mhs[0]['nim']}} / {{$data_mhs[0]['nama_mahasiswa']}}</td>
    </tr>
</table>
<br>
<table id="data-table-simple" class="display">
    <thead>
    <tr>
        {{--        <th>Masa</th>--}}
        {{--        <th width="5%">NIM</th>--}}
        {{--        <th width="20%">Nama Mahasiswa</th>--}}
        <th>Nama Tutor</th>
        <th>Matakuliah</th>
        <th>Hari</th>
        <th>Tanggal Mulai</th>
        <th>Jam</th>
        <th>lokasi</th>
        <th>Link</th>
        <th>Kelas</th>
        @auth
            <th>Status</th>
        @endauth
        @if(substr($data_mhs[0]['id_kelas'],9,2) == config('app.kode_upbjj'))
            <th>Aksi</th>
        @endif
    </tr>
    </thead>
    <tbody>

    @if(!empty($data_mhs))
        @foreach($data_mhs as $data)
            @php
                $masa =  $data['masa'];
                $nim = $data['nim'];
                $kodemtk = $data['kode_matakuliah'];
                $idkelas = $data['id_kelas'];
                $jenis = '1';
                $cekangket = App\Models\angket\angketetmModel::cekjawaban($idkelas, $nim, $jenis, $masa);

            @endphp
            <tr>
                {{--                <td>{{ $data['masa'] }} </td>--}}
                {{--                <td>{{ $data['nim'] }} </td>--}}
                {{--                <td>{{ $data['nama_mahasiswa'] }} </td>--}}
                <td>{{ $data['nama_tutor'] }} </td>
                <td>{{ $data['kode_matakuliah'] }} / {{ $data['nama_matakuliah']}} </td>
                <td>{{ $data['nama_hari']}}  </td>
                <td>{{ $data['tanggal_mulai'] }} </td>
                <td>{{ $data['jam']}} </td>
                {{--                                                                <td>{{ $datatelepon }} </td>--}}
                <td>{{ $data['lokasi'] }}</td>
                <td>
                    {{--                    @if(empty($data['link']))--}}
                    {{--                        <a>{{ $data['lokasi'] }}</a>--}}
                    {{--                    @else--}}
                    <a href="{{ $data['link'] }}">{{ $data['link'] }}</a>
                    {{--                    @endif--}}
                </td>
                <td style="text-align: center"><a href="{{ route('ttm.jadwal.kelas', ['id1' => Crypt::encrypt($data['masa']),'id2' => Crypt::encrypt($data['id_kelas']),'id3' => $data['id_tutorial']])}}"> {{$data['id_kelas']}} </a></td>
                @auth
                    <td style="text-align: center">{{ $data['status'] }} </td>
                @endauth
                <td style="text-align: center">
                    @php
                        $buka = date(\Carbon\Carbon::createFromFormat('d/m/Y', $data['tanggal_mulai'])->addDays(35)->format('d/m/Y'));
                        $date = \Carbon\Carbon::now('Asia/Jakarta')->format('d/m/Y');;
                    @endphp

{{--                    @if( $date > $buka )--}}
                        @if(empty($cekangket))
                            @if(substr($data['id_kelas'],9,2) == config('app.kode_upbjj'))
                                <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1" target="_blank"
                                   href="{{ route ('angketetm', ['id1' => Crypt::encrypt($data['id_kelas']),'id2' => Crypt::encrypt($data['nim']),'id3' =>Crypt::encrypt($data['masa']),'id4' =>  $data['nama_tutor']])}}">Isi Angket
                                </a>
                            @endif
                        @else
                            Sudah Isi Angket
                        @endif
{{--                    @endif--}}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
