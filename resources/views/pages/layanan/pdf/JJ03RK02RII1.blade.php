<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Aplikasi {{config('app.upbjj')}}">
    <meta name="keywords" content="sertifikat, Universitas Terbuka, {{config('app.upbjj')}}">
    <meta name="author" content="teguhmi">
    <title>{{ config('app.name') }} | {{ config('app.upbjj') }} - Making Higher Education Open to All</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style type="text/css">
        @page {
            margin: 1cm 1cm 1cm 4cm;

        }

        header {
            text-align: center;
            margin: 0 auto;
            padding: 0px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 0cm;
            /** Extra personal styles **/
            background-color: #FFFFFF;
            color: black;
            text-align: left;
            line-height: 0cm;
        }

        /*body {*/
        /*    margin-top: 1cm;*/
        /*    margin-left: 4cm;*/
        /*    margin-right: 1cm;*/
        /*    margin-bottom: 0.5cm;*/
        /*}*/

        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            border-color: #000000;
            width: 100%;
        }

        /*row		*/
        .tg td {
            font-family: "Times New Roman";
            font-size: 14px;
            padding: 6px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: #ccc;
            color: #333;
            background-color: #fff;
        }

        /*thead*/
        .tg th {
            font-family: "Times New Roman";
            font-size: 14px;
            font-weight: normal;
            padding: 5px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: #000000;
            color: #333;
            background-color: #FFFFFF;
            text-align: center
        }

        table {
            page-break-inside: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }

        thead {
            display: table-header-group
        }

        tfoot {
            display: table-footer-group
        }
    </style>

    {{--    <header>--}}
    {{--        <h2><strong>Daftar Keluhan {{config('app.upbjj')}}</strong></h2>--}}
    {{--    </header>--}}
</head>
<body>
<table class="tg">
    <thead>
    <tr height="30px">
        <td colspan="10" align="center">
            <h2>
                <strong>
                    REKAP KELUHAN {{strtoupper(config('app.upbjj'))}}<br>
                    PER TANGGAL {{strftime("%d %B %Y", strtotime($awal))}} s/d {{strftime("%d %B %Y", strtotime($akhir))}}<br>
                </strong>
            </h2>
        </td>
    </tr>
    <tr height="30px">
        <td align="center" width="2%">No</td>
        <td align="center" width="5%">Tanggal</td>
        <td align="center" width="3%">No Keluhan</td>
        <td align="center" width="4%">Asal (Nama/NIM/Instansi)</td>
        <td align="center" width="20%">Isi Keluhan</td>
        <td align="center" width="5%">PJ Keluhan</td>
        <td align="center" width="4%">Target Selesai</td>
        <td align="center" width="20%">Penyelesaian</td>
        <td align="center" width="5%">Tanggal Selesai</td>
    </tr>
    </thead>
    <tbody>
    @php $no = 1;@endphp
    @if (!empty($sql))

        @foreach($sql as $data)
            <tr height="40px" valign="top">
                <td align="center">{{$no++}}</td>
                <td align="center">{{$data->tanggal}}</td>
                <td align="center">{{$data->id_deskripsi}}</td>
                <td>
                    {{$data->nama_asal}}<br> {{$data->nim}} <br>{{$data->nama}}
                </td>
                <td>{{$data->deskripsi}}</td>
                <td>{{$data->nama_pj}}</td>
                <td></td>
                <td>{{$data->jawaban}}</td>
                {{--                <td>{{strftime("%d %B %Y", strtotime($data->jawaban_user_date))}}</td>--}}
                <td align="center">{{$data->jawaban_user_date}}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
</body>
</html>
