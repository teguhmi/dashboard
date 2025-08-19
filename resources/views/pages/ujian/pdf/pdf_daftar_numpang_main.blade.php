<!DOCTYPE html>
<html lang="">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Aplikasi AKSI">
    <meta name="keywords" content="sertifikat, Universitas Terbuka, kelulusan, aksi">
    <meta name="author" content="teguhmi">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Daftar Peserta Wisuda</title>
    <link rel="apple-touch-icon" href="{{secure_url('app-assets/images/favicon/favicon.ico')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{secure_url('app-assets/images/favicon/favicon.ico')}}">

    <style type="text/css">
        body {
            margin-top: 0;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 0;
        }

        .page {
            overflow: hidden;
            page-break-after: always;
        }

        .b {
            border: 1px solid gray;
            border-collapse: collapse;
            font-family: courier, courier new, serif;
            font-size: 10pt;
        }

        .page-break {
            page-break-after: always;
        }

        thead tr th {
            font-family: courier, courier new, serif;
            font-size: 12pt;
        }

        thead tr td {
            font-family: courier, courier new, serif;
            font-size: 10pt;
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

</head>
<body>
@php($hari = '')
@php($lokasi = '')
@php($no = 1)
@foreach($sql as $item)

    @if( $hari == '' || $lokasi == '' )
        <div>
            <table class="" style="vertical-align:middle;width: 100%; border-collapse: collapse;" align="top">
                @include('pages.ujian.pdf.pdf_daftar_numpang_thead')
                @include('pages.ujian.pdf.pdf_daftar_numpang_td')
                @php($hari = $item->hari)
                @php($lokasi = $item->kode_tempat_ujian_tujuan)
                @elseif($lokasi == $item->kode_tempat_ujian_tujuan && $hari == $item->hari)
                    @include('pages.ujian.pdf.pdf_daftar_numpang_td')
                    @php($hari = $item->hari)
                    @php($lokasi = $item->kode_tempat_ujian_tujuan)
                @elseif($lokasi != $item->kode_tempat_ujian_tujuan)
            </table>
        </div>
        <div class="page-break"></div>
        @php($no = 1)
        <div>
            <table class="" style="vertical-align:middle;width: 100%; border-collapse: collapse;" align="top">
                @include('pages.ujian.pdf.pdf_daftar_numpang_thead')
                @include('pages.ujian.pdf.pdf_daftar_numpang_td')
                @php($hari = $item->hari)
                @php($lokasi = $item->kode_tempat_ujian_tujuan)
                @else

            </table>
        </div>
        <div class="page-break"></div>
        <div>
            <table class="" style="vertical-align:middle;width: 100%; border-collapse: collapse;" align="top">
                @include('pages.ujian.pdf.pdf_daftar_numpang_thead')
                @include('pages.ujian.pdf.pdf_daftar_numpang_td')
                @php($hari = $item->hari)
                @php($lokasi = $item->kode_tempat_ujian_tujuan)

            </table>
        </div>
    @endif
@php($no++)
@endforeach
</body>
</html>
