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
            /*font-family: "Times New Roman";*/
            font-size: 12px;
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
            /*font-family: "Times New Roman";*/
            font-size: 12px;
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
<body>
<h4 align="center"><strong>Pengolahan Angket Evaluasi Tutor Oleh Mahasiswa</strong></h4>
<table>
    <tr style="height: 18px;font-size: small">
        <td>Nama UPBJJ</td>
        <td>:</td>
        <td>{{config('app.upbjj')}}</td>
    </tr>
    <tr style="height: 18px;font-size: small">
        <td>Masa Registrasi</td>
        <td>:</td>
        <td>{{$query[0]->masa}}</td>
    </tr>
    <tr style="height: 18px;font-size: small">
        <td>Pokjar</td>
        <td>:</td>
        <td></td>
    </tr>
</table>
<table>
    <tr>
        <td style="height: 18px;font-size: small">
            Lengkapilah tabel penilaian tutor dengan mengisi kolom aspek tutor yang dievaluasi di bawah ini:<br>
            Kriteria Penilaian:
        </td>
    </tr>
</table>


<table width="100%">
    <tr style="height: 18px;font-size: small">
        <td width="40px" align="center">1</td>
        <td>Sangat Tidak Setuju</td>
    </tr>
    <tr style="height: 18px;font-size: small">
        <td align="center">2</td>
        <td>Tidak Setuju</td>
    </tr>
    <tr style="height: 18px;font-size: small">
        <td align="center">3</td>
        <td>Setuju</td>
    </tr>
    <tr style="height: 18px;font-size: small">
        <td align="center">4</td>
        <td>Sangat Setuju</td>
    </tr>
</table>
<table class="tg">
    <thead>

    <tr style="font-weight: bold;font-size: small">
        <td width="5%" rowspan="2">Responden</td>
        <td colspan="15"> @if (!empty($query)) {{$query[0]->nama_tutor}} @endif/ {{$query[0]->kode_mtk}} - {{$query[0]->nama_mtk}}</td>
    </tr>
    <tr style="font-weight: bold;font-size: small">
        @for ($i=1;$i<=15;$i++)
            <td>{{$i}}</td>
        @endfor
    </tr>
    </thead>
    <tbody>
    @php $no = 1;@endphp
    @if (!empty($query))
        @foreach($query as $data)
            <tr>
                <td style="font-size: small;text-align: center" width="1%">{{$no++}}</td>
                @for ($i=1;$i<=15;$i++)
                    @php $a = 'H_'. $i @endphp
                    <td class="center">{{$data->$a}}</td>
                @endfor

            </tr>
        @endforeach
    @endif
    </tbody>
    <tfoot>
    @if(!empty($ratarata))
        <tr>
            <td style="text-align: left">Rata-Rata</td>
            @foreach($ratarata as $data)
                <td>{{$data}}</td>
            @endforeach
        </tr>
    @endif
    @if(!empty($total))
        <tr>
            <td style="text-align: left">Total</td>
            <td style="text-align: center" colspan="15">{{$total}}</td>
        </tr>
    @endif
    </tfoot>
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
</html>
