<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        @page {
            margin-top: 0cm;
            margin-left: 1.5cm;
            margin-right: 1.5cm;
            margin-bottom: 1.50cm;
            font-family: "Times New Roman", Times, serif;
            font-size: 14pt;
        }

        div.kirikanan {
            margin-left: 1.5cm;
            margin-right: 1.5cm;
            font-family: "Times New Roman", Times, serif;
            font-size: 14pt;
        }



        header {

            top: 5cm;
            right: 0cm;
            left: 0cm;
            height: 0cm;
            /** Extra personal styles **/
            background-color: #FFFFFF;
            color: black;
            text-align: center;
            font-family: "Times New Roman", Times, serif;
            font-size: 16pt;

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

        div.tab {
            margin-left: 1.0cm;
            margin-right: 0cm;
            line-height: 1;
            text-align: justify;
            vertical-align: top;
            font-family: "Times New Roman", Times, serif;
            font-size: 14pt;
        }


        div.satu {
            margin-left: 0.5cm;
            margin-right: 1.5cm;
            line-height: 1;
            text-align: left;
            font-family: "Times New Roman", Times, serif;
            font-size: 14pt;
        }

        td {
            font-family: "Times New Roman", Times, serif;
            font-size: 14pt;
            vertical-align: top;
        }
    </style>

</head>

<body>
@if(!empty($DPtutor))
    <header>
        <p><strong>REGISTRASI ULANG<br>TUTOR/PEMBIMBING/INSTRUKTUR/SUPERVISOR/PENGUJI<br>UPBJJ-{{config('app.upbjj')}} @if(!empty($masa)) {{$masa}}@endif
            </strong></p>
    </header>
    <body>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="kirikanan">
        <p><span>Saya yang bertanda tangan di bawah ini :</span></p>
        <div class="tab">
            <table width="100%" border="0">
                <tbody>
                <tr>
                    <td width="1%">1.</td>
                    <td width="20%">Id tutor</td>
                    <td width="1%">:</td>
                    <td width="100%">{{$DPtutor[0]->idtutor}}</td>
                </tr>
                <tr>
                    <td width="1%">2.</td>
                    <td width="20%">Nama</td>
                    <td width="1%">:</td>
                    <td width="100">{{$DPtutor[0]->namalengkap}}</td>
                </tr>
                <tr>
                    <td width="1%">3.</td>
                    <td width="20%">NIK</td>
                    <td width="1%">:</td>
                    <td width="100">{{$DPtutor[0]->noidentitas}}</td>
                </tr>
                <tr>
                    <td width="1%">4.
                    <td style="vertical-align: top; " width="20%">Alamat
                    <td width="1%">:
                    <td width="100%">{{$DPtutor[0]->alamat}}</td>
                </tr>
                <tr>
                    <td width="1%">5.</td>
                    <td width="20%">Gelar</td>
                    <td width="1%">:</td>
                    <td></td>
                </tr>
                <tr>
                    <td width="1%">6.</td>
                    <td width="20%">Instansi</td>
                    <td width="1%">:</td>
                    <td width="100">{{$DPtutor[0]->institusi}}</td>
                </tr>
                <tr>
                    <td width="1%">7.</td>
                    <td width="20%">Golongan</td>
                    <td width="1%">:</td>
                    <td width="100">{{$DPtutor[0]->golongan}}</td>
                <tr>
                </tr>
                <td width="1%">8.</td>
                <td width="20%">NPWP</td>
                <td width="1%">:</td>
                <td width="100">{{$DPtutor[0]->npwp}}</td>
                </tr>
                <tr>
                    <td width="1%">9.</td>
                    <td width="20%">Nama Bank</td>
                    <td width="1%">:</td>
                    <td width="100">{{$DPtutor[0]->nama_bank}}</td>
                </tr>
                <tr>
                    <td width="1%">10.</td>
                    <td width="20%">No Rekening</td>
                    <td width="1%">:</td>
                    <td width="100">{{$DPtutor[0]->norekening}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <p><span>Menyatakan kesediaan untuk menjadi tutor/pembimbing/instruktur/supervisor/penguji mata kuliah :</span></p>
        <div class="tab">
            <table width="100%" border="0">
                <tbody>
                @if(!empty($ajuanmatakuliah))
                    @php  $no = 1 @endphp
                    @foreach($ajuanmatakuliah as $data)
                        <tr>

                            <td width="1%">{{$no++}}.</td>
                            <td width="100%">{{$data->kode_mtk}} - {{$data->nama_matakuliah}}
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <p><span> Sebagai bahan pertimbangan, saya lampirkan :</span></p>
        <div class="satu">
            <ol>
                <li style="text-align:justify"><span>Fotokopi ijazah terakhir</span></li>
                <li style="text-align:justify"><span>Surat keterangan atau pengangkatan sebagai guru/dosen/widyaiswara*)</span></li>
                <li style="text-align:justify"><span>Daftar Riwayat Hidup</span></li>
                <li style="text-align:justify"><span>Surat keterangan mata kuliah yang diajarkan serta lama mengajar**</span></li>
                <li style="text-align:justify"><span>Fotokopi Buku Rekening</span></li>
                <li style="text-align:justify"><span>Fotokopi NPWP</span></li>
            </ol>
        </div>
        <p style="text-align:justify"><span>Apabila saya diterima sebagai tutor/pembimbing/instruktur/supervisor/penguji di lingkungan UPBJJ-{{config('app.upbjj')}} saya akan melaksanakan kewajiban sesuai dengan tugas dan kewenangan sebagai tutor/pembimbing/instruktur/supervisor/penguji dengan sungguh-sungguh serta bersedia mematuhi segala ketentuan yang berlaku.</span>
        </p>

        <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
            <tbody>
            <tr>
                <td style="width:60%"><span>Catatan:<br/>
			*) Coret yang tidak perlu<br/>
			**) Khusus untuk dosen
                <td>
                <td style="text-align:center; width:40%">
                    <p><span>__________, ____________________</span></p>
                    <br>
                    <br>
                    <br>

                    <p><br/>
                        <span>Yang membuat pernyataan</span><br/>
                        {{$DPtutor[0]->namalengkap}}</p>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
    </body>
@endif
</body>
</html>
