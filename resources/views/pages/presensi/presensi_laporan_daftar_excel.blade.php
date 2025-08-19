<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Presensi Kegiatan </title>
</head>


<body>
<table align="center" style="font-size: 10pt;" cellpadding="1" cellspacing="0">
    <tr>
        <td colspan="9" align="center" style="font-size: 10pt;"><b>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</b></td>
    </tr>
    <tr>
        <td colspan="9" align="center"><b>UNIVERSITAS TERBUKA</b></td>
    </tr>
    <tr>
        <td colspan="9" style="font-size: 10;" align="center">Jalan Cabe Raya, Pondok Cabe, Pamulang, Tangerang Selatan 15418</td>
    </tr>
    <tr>
        <td colspan="9" style="font-size: 10;" align="center">Telepon: 021-7490941 (Hunting), <font color="blue">&nbsp;www.ut.ac.id</font></td>
    </tr>

</table>


<table id="data-table-simple" class="display">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIM</th>
        @auth
            <th> Nomor Telepon</th>
        @endauth
        <th>Institusi</th>
        <th>Jam Presensi</th>
    </tr>
    </thead>
    <tbody>

    @php
        $no = 1;
    @endphp
    @foreach($DaftarPeserta as $data)
        <tr>
            <td width="2%">{{$no++}}</td>
            <td width="25%">{{$data->nama}}</td>
            <td width="25%">{{$data->nim}}</td>
            @auth
                <td width="10%"> {{$data->telepon}}</td>
            @endauth
            <td width="25%">{{$data->institusi}}</td>
            <td width="10%">{{$data->user_date_create}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
