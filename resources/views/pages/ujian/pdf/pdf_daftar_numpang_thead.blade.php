<thead>
<tr>
    <th colspan="7">Daftar Peserta Numpang Ujian Masa  {{strtoupper($item->masa)}} <br>
        {{config('app.upbjj')}}
        <br>

    </th>
</tr>

<tr>
    <td colspan="7" style="width: 20%">Lokasi Ujian :&nbsp;{{$item->kode_tempat_ujian_tujuan}} / {{$item->nama_wilayah_ujian_tujuan}}</td>
</tr>
<tr>
    <td colspan="7" style="width: 20%">Hari :&nbsp;{{$item->hari}}</td>
</tr>

<tr class="b">
    <th class="b" style="text-align: center">NIM</th>
    <th class="b" style="width: 70%;">Nama Mahasiswa</th>
    <th class="b" style="width: 10%">Jam 1</th>
    <th class="b" style="width: 10%">Jam 2</th>
    <th class="b" style="width: 10%">Jam 3</th>
    <th class="b" style="width: 10%">Jam 4</th>
    <th class="b" style="width: 10%">Jam 5</th>
</tr>
</thead>
