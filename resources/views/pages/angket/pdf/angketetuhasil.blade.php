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

        /*row		*/
        .tg td {
            font-size: small;
            padding: 6px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: #ccc;
            color: #333;
            background-color: #fff;
            text-align: center;
            vertical-align: center;
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
            page-break-after: auto;

        }

        thead {
            display: table-header-group
        }

        tfoot {
            display: table-footer-group
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
            border-color: #ccc;
            color: #333;
            background-color: #fff;
            text-align: center;
            vertical-align: center;
        }
    </style>

    {{--    <header>--}}
    {{--        <h2><strong>Daftar Keluhan {{config('app.upbjj')}}</strong></h2>--}}
    {{--    </header>--}}
</head>
@if(!empty($dataetu))
    @foreach($dataetu as $row)
        <body>
        <br>
        <p align="center">Pengolahan Angket Evaluasi Tutor Oleh UPBJJ <br> Masa Registrasi {{$row->masa}}</p>
        <table width="100%">
            <tr style="height: 18px;font-size: small">
                <td width="15%">Nama UPBJJ</td>
                <td>:</td>
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
            <tr style="height: 18px;font-size: small">
                <td>Nama Tutor</td>
                <td>:</td>
                <td>{{$row->idtutor}} / {{$row->nama_tutor}}</td>
            </tr>
            <tr style="height: 18px;font-size: small">
                <td>Mata Kuliah</td>
                <td>:</td>
                <td>{{$row->kode_mtk}} / {{$row->nama_mtk}}</td>
            </tr>
        </table>
        @break
        @endforeach

        <br>
        <table class="tg">
            <thead>
            <tr>
                <td rowspan="2">Nomor</td>
                <td rowspan="2">Aspek</td>
                <td colspan="2">Terpenuhi</td>
            </tr>
            <tr>

                <td style="text-align:center">YA</td>
                <td style="text-align:center">Tidak</td>
            </tr>
            </thead>
            @foreach($dataetu as $row)
                <tbody>

                <tr>
                    <td>
                        {{$row->nomor}}
                    </td>
                    <td style="text-align:left">{{$row->pertanyaan}}</td>
                    @if($row->jawaban == 1)
                        <td width="10%">&#10004;</td>
                    @else
                        <td width="10%">-</td>
                    @endif
                    @if($row->jawaban == 0)
                        <td width="10%">&#10004;</td>
                    @else
                        <td width="10%">-</td>
                    @endif
                </tr>

                <p></p>
                </tbody>
            @endforeach
            <tr>
                <td colspan="5" style="text-align: left">Saran : {{$saran}}</td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: left">Kesimpulan : {{$hasil}}</td>
            </tr>
        </table>


        <br>
        <table class="foot">
            <tbody>
            <tr>
                <td style="width: 10%;">Tanggal Input:</td>
                <td style="width: 10%;">Nama Penginput:</td>
                <td style="width: 10%;">Nama Validator</td>
            </tr>
            <tr>
                <td style="width: 14.9148%; text-align: center;" rowspan="3">&nbsp;</td>
                <td style="width: 19.6023%;">&nbsp;</td>
                <td style="width: 15.4829%;">&nbsp;</td>
            </tr>
            <tr>
                <td style="width: 10%;">Tanda Tangan</td>
                <td style="width: 10%;">Tanda Tangan</td>
            </tr>
            <tr>
                <td style="width: 10%;"><br>
                <br></td>
                <td style="width: 10%;"></td>
            </tr>
            </tbody>
        </table>

        </body>
@endif
