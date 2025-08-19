<!DOCTYPE html>
<html lang="">
<head>
    <style>
        /*table, th, td {*/
        /*    border: 1px solid black;*/
        /*    border-collapse: collapse;*/
        /*}*/

        /*table.center {*/
        /*    margin-left: auto;*/
        /*    margin-right: auto;*/
        /*}*/
        body {
            margin-top: 3cm;
            margin-left: 0cm;
            margin-right: 0cm;
            margin-bottom: 0cm;
            z-index: 0;
        }


        footer {
            position: fixed;
            height: 4cm;
            top: 252mm;
            /** Extra personal styles **/
            background-color: #FFFFFF;
            color: black;
            text-align: left;
            line-height: 0;
            z-index: -1;
        }

        .line {
            border: 1px solid gray;
            border-collapse: collapse;
        }

        div.text {
            margin-left: 1.5cm;
            margin-right: 1.5cm;
            line-height: 1em;
            text-align: justify;
            font-size: 12pt;
        }

        div.kop {
            margin-left: 0;
            margin-right: 0;
            color: darkblue;
        }

        div.tab {
            margin-left: 2cm;
            margin-right: 2cm;
            line-height: 1;
            text-align: justify;
        }

        div.ttd {
            margin-left: 2cm;
            margin-right: 1cm;
            line-height: 1;
            text-align: justify;
            font-size: 12pt;
        }
    </style>
    <title></title>
</head>
<body>
@if( !empty( $getnomorsurat) )
    <div class="kop">
        <table style="width: 100%;border:0 ">
            <tr>
                <td>&nbsp;&nbsp;</td>
                {{--                <td>&nbsp;&nbsp;</td>--}}
                <td style="width: 10%"><img width="130px" height="100px"
                                            src="{{public_path('app-assets/images/logo/logo_ut_text.png')}}" align="top" alt=""/>&nbsp;
                </td>
                <td style="width:80%;height: 18px">
                    <div align="center"
                         style="font-size:16pt;'Times New Roman', Times, serif;">{{$getnomorsurat[0]->baris_kop_1}}<br>{{$getnomorsurat[0]->baris_kop_2}}
                    </div>

                    <div align="center" style="font-size:5pt;">&nbsp;&nbsp;</div>
                    <div align="center" style="font-size:16pt;font-family: 'Times New Roman', Times, serif;"><strong>{{$getnomorsurat[0]->baris_kop_3}}</strong></div>
                    <div align="center" style="font-size:14pt;font-family: 'Times New Roman', Times, serif;">{{$getnomorsurat[0]->baris_kop_4}}</div>
                    <div align="center" style="font-size:11pt;font-family: 'Times New Roman', Times, serif;">{{$getnomorsurat[0]->baris_kop_5}}<br>{{$getnomorsurat[0]->baris_kop_6}}<br>{{$getnomorsurat[0]->baris_kop_9}}</div>
                </td>
                <td></td>
            </tr>
        </table>
    </div>
@endif
<hr>
<div class="text">
    <table style="width: 100%;text-align: left;border: 0">
        <tr>
            <td style="width: 3%">Nomor</td>
            <td>:</td>
            <td>
                @if(!empty($getnomorsurat))
                    {{$getnomorsurat[0]->nomor_surat}}
                @else
                    -
                @endif

            </td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>:</td>
            <td>-</td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>:</td>
            <td>
                @if(!empty($getnomorsurat))
                    {{$getnomorsurat[0]->nama_surat}} Masa {{$getnomorsurat[0]->masa}}
                @else
                    -
                @endif

            </td>
        </tr>
    </table>

    <br>
    <br>
    <table style="width: 40%;text-align: left;border: 0">
        <tr>
            <td>
                @if(!empty($upbjj))
                    Yth. Direktur UT {{$upbjj->data->nama_upbjj}} <br>
                    {{$upbjj->data->alamat_upbjj}}
                @endif
            </td>
        </tr>
    </table>

</div>
<br>
<br>
<div class="text">Menindaklanjuti permohonan mahasiswa tentang numpang ujian:</div>
<br>

@if(!empty($DPMahasiswa))

    <div class="tab">
        <table>
            <tbody>
            <tr>
                <td width="25%">NIM</td>
                <td width="1%">:</td>
                <td width="100%">{{$DPMahasiswa['nim']}}</td>
            </tr>
            <tr>
                <td>Nama Mahasiswa</td>
                <td>:</td>
                <td>{{$DPMahasiswa['nama_mahasiswa']}}</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td>{{$DPMahasiswa['nama_program_studi']}}</td>
            </tr>
            <tr>
                <td>UPBJJ</td>
                <td>:</td>
                <td>{{$DPMahasiswa['kode_upbjj']}} / {{$DPMahasiswa['nama_upbjj']}}</td>
            </tr>
            @if(!empty($getnomorsurat[0]->nomor_handphone))
                <tr>
                    <td>Nomor Telepon</td>
                    <td>:</td>
                    <td> {{$getnomorsurat[0]->nomor_handphone}}</td>
                </tr>
            @endif
            @if(!empty($getnomorsurat[0]->email))
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{$getnomorsurat[0]->email}} </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

@endif
<br>
<div class="text">Mohon kiranya mahasiswa tersebut dapat menumpang ujian di Universitas Terbuka {{$sql[0]->nama_upbjj_ujian_tujuan}} masa {{$masa}} dengan lokasi dan matakuliah sebagai berikut:</div>
<br>
<div class="tab">
    @if(!empty($sql))
        <table style="border-collapse:collapse; margin-left: auto;margin-right: auto;font-size: 10pt">
            <thead>
            <tr>
                <th class="line" style="width: 1%;text-align: center">Hari</th>
                <th class="line" style="text-align: center">Lokasi Ujian</th>
                <th class="line" style="width: 50px;height: 30px;text-align: center">Jam 1</th>
                <th class="line" style="width: 50px;text-align: center">Jam 2</th>
                <th class="line" style="width: 50px;text-align: center">Jam 3</th>
                <th class="line" style="width: 50px;text-align: center">Jam 4</th>
                <th class="line" style="width: 50px;text-align: center">Jam 5</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sql as $item)
                <tr>

                    <td class="line" style="width: 80px;text-align: center">{{$item->hari}}</td>
                    <td class="line" style="text-align: left">{{$item->kode_tempat_ujian_tujuan}} / {{$item->nama_wilayah_ujian_tujuan}}</td>
                    <td class="line" style="width: 65px;height: 30px;text-align: center">
                        @if(!empty($item->kode_mtk_1))
                            {{$item->kode_mtk_1}}
                        @else
                            -
                        @endif
                    </td>

                    <td class="line" style="width: 65px;text-align: center">
                        @if(!empty($item->kode_mtk_2))
                            {{$item->kode_mtk_2}}
                        @else
                            -
                        @endif
                    </td>
                    <td class="line" style="width: 65px;text-align: center">
                        @if(!empty($item->kode_mtk_3))
                            {{$item->kode_mtk_3}}
                        @else
                            -
                        @endif
                    </td>
                    <td class="line" style="width: 65px;text-align: center">
                        @if(!empty($item->kode_mtk_4))
                            {{$item->kode_mtk_4}}
                        @else
                            -
                        @endif
                    </td>
                    <td class="line" style="width: 65px;text-align: center">
                        @if(!empty($item->kode_mtk_5))
                            {{$item->kode_mtk_5}}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
<br>
<div class="text">Kepada mahasiswa yang bersangkutan diharuskan melapor ke Universitas Terbuka {{$sql[0]->nama_upbjj_ujian_tujuan}} tempat menumpang ujian paling lambat 10 (sepuluh) hari sebelum pelaksanaan ujian dan diminta mencantumkan kode UT Daerah asal pada Lembar Jawab Ujian(LJU).</div>
<br>
<div class="text">Atas perhatian dan bantuan kami ucapkan terimakasih.</div>
<br>
<br>
@if (!empty($getnomorsurat))
    @foreach($getnomorsurat as $key => $row)
        <div class="ttd">
            @php
                setlocale(LC_ALL, 'id_ID.88591', 'id_ID', 'ID');
            @endphp
            <table style="border-collapse: collapse; width: 100%;" border="0">
                <tbody>
                <tr>
                    <td style="width: 28%;"></td>
                    <td style="width: 28%;"></td>
                    <td style="width: 44%;">{{ ucwords(strtolower($row->baris_kop_7)) }}, {{strftime("%d %B %Y", time())}}
                        <br>
                        {{$row->penandatangan}}
                        <div class="visible-print text-center qr"><img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(100)->generate($qr)) }} " alt="">
                        </div>
                        <u>{{$row->nama_penandatangan}}</u>
                        <br>
                        NIP.{{$row->nip_penandatangan}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        @break
    @endforeach
@endif
<footer>
    <img align="middle" width="100%" height="100%" src="{{public_path('app-assets/images/logo/selendang.png')}}" alt="Image"/>
</footer>
</body>

</html>
