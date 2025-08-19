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
{{--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">--}}

    <style type="text/css">
        @page {

            margin: 0cm 1cm 1cm 1cm;

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

        body {
            font-family: "Times New Roman", Times, serif;
            /*margin-top: 1cm;*/
            /*margin-left: 4cm;*/
            /*margin-right: 1cm;*/
            /*margin-bottom: 0.5cm;*/
        }

        .tg {

            border-collapse: collapse;
            border-spacing: 0;
            border-color: #000000;
            width: 100%;
        }

        .foot {
            border-collapse: collapse;
            border-spacing: 0;
            border-color: #000000;
            width: 100%;


        }
        .foot td {
            font-size: small;
            /*padding: 6px;*/
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            /*border-color: #ccc;*/
            color: #333;
            background-color: #fff;
        }

        /*row		*/
        .tg td {
            font-size: small;
            padding: 6px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            /*border-color: #ccc;*/
            /*color: #333;*/
            background-color: #fff;
            /*text-align: center;*/
            vertical-align: top;
        }

        /*thead*/
        .tg th {
            font-size: 14px;
            font-weight: normal;
            padding: 5px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            /*border-color: #000000;*/
            /*color: #333;*/
            background-color: #FFFFFF;
            text-align: center
        }

        table {
            page-break-inside: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;

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
@if(!empty($query))
    @foreach($query as $row)
        <body>
        <br>
        <p align="center">Rekomendasi Status Tutor Berdasarkan Hasil Evaluasi Mahasiswa dan {{config('app.upbjj')}}</p>
        <table width="100%">
            <tr style="height: 18px;font-size: small">
                <td width="15%">Nama UPBJJ</td>
                <td width="1%">:</td>
                <td>{{config('app.upbjj')}}</td>
            </tr>
            <tr style="height: 18px;font-size: small">
                <td>Masa Registrasi</td>
                <td>:</td>
                <td>{{$row->masa}}</td>
            </tr>
            <tr style="height: 18px;font-size: small">
                <td>Pokjar</td>
                <td>:</td>
                <td></td>
            </tr>
        </table>
        @break
        @endforeach

        <br>
        <table class="tg">
            <thead>
            <tr>
                <th width="1%">No</th>
                <th>Nama Tutor</th>
                <th>Matakuliah</th>
                <th width="11%">Hasil Evaluasi Tutor oleh Mahasiswa</th>
                <th width="11%">Hasil Evaluasi Tutor oleh UPBJJ</th>
                <th width="20%">Tindak Lanjut</th>
            </tr>
            </thead>
            @php $no = 1;@endphp
            <tbody>
            <tr>
                <td>{{$no++}}</td>
                <td>{{$query[0]->nama_tutor}}</td>
                <td>{{$query[0]->kode_mtk}} - {{$query[0]->nama_mtk}}</td>
                <td style="text-align: center">{{$total}}</td>
                <td>{{$hasil}}</td>
                <td>{{$rekomendasi}}</td>
            </tr>
            </tbody>
        </table>
        <br>
        <table class="foot">
            <tbody>
            <tr>
                <td style="width: 10%; height: 18px;">Tanggal Input:</td>
                <td style="width: 10%; height: 18px;">Nama Penginput:</td>
                <td style="width: 10%; height: 18px;">Nama Validator</td>
            </tr>
            <tr>
                <td style="width: 14.9148%; height: 70px; text-align: center;" rowspan="4">&nbsp;</td>
                <td style="width: 19.6023%; height: 20px;">&nbsp;</td>
                <td style="width: 15.4829%; height: 20px;">&nbsp;</td>
            </tr>
            <tr>
                <td style="width: 10%;">&nbsp;NIP</td>
                <td style="width: 10%;">&nbsp;NIP</td>
            </tr>
            <tr>
                <td style="width: 10%; height: 18px;">Tanda Tangan</td>
                <td style="width: 10%; height: 18px;">Tanda Tangan</td>
            </tr>
            <tr style="height: 51px;">
                <td style="width: 10%; height: 18px;">&nbsp;</td>
                <td style="width: 10%; height: 20px;">&nbsp;</td>
            </tr>

            </tbody>
        </table>

        </body>
@endif
