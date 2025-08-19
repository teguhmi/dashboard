<!DOCTYPE html>
<html>
<body>
<style type="text/css">
    @page {
        /*size: 360pt 500pt;*/
        margin: 0.5cm 20cm 0cm 0.5cm;

    }

    p.head {
        font-family: "Arial", Helvetica, sans-serif;
        font-size: 8pt;
    }

    tbody.data {
        font-family: "Arial", Helvetica, sans-serif;
        font-size: medium;
    }

    p.bawah {
        font-family: "Arial", Helvetica, sans-serif;
        font-size: small;
        text-align: justify;
    }
</style>
@if( !empty( $nota) )

    <p class="head">{{$upbjj[0]->alamat_0}}<br>UNIVERSITAS TERBUKA<br>{{$upbjj[0]->unit}}</p>
    <p class="head">

        {{$upbjj[0]->alamat_1}}<br>
        {{$upbjj[0]->alamat_2}} WA : {{$upbjj[0]->wa}}<br>
        {{$upbjj[0]->alamat_3}}<br>
    </p>
    <br>

    <table style="width: 100%;">
        <tbody class="data">
        @if( !empty( $nota ) )
            <tr>
                <td style="width: 15px;">Nomor&nbsp;</td>
                <td style="width: 2px;">:</td>
                <td style="width: 100px;">{{$nota[0]->id_nota}}</td>
            </tr>

            <tr>
                <td style="width: 15px;">Tanggal</td>
                <td style="width: 2px;">:</td>
                <td style="width: 100px;">{{$nota[0]->user_date_create}}</td>
            </tr>
        @endif

        <tr>
            <td style="width: 18px;">NIM</td>
            <td style="width: 2px;">:</td>
            <td style="width: 100px;">{{$DPMahasiswa[0]->nim}}</td>
        </tr>
        <tr>
            <td style="width: 25px;">Nama</td>
            <td style="width: 5px;">:</td>
            <td style="width: 100px;">{{$DPMahasiswa[0]->nama_mahasiswa}}</td>
        </tr>
        <tr>
            <td style="width: 25px;">UPBJJ</td>
            <td style="width: 5px;">:</td>
            <td style="width: 100px;">{{$DPMahasiswa[0]->kode_upbjj}} / {{$DPMahasiswa[0]->nama_upbjj}}</td>
        </tr>

        @if(!empty($yudisium))
            <tr>
                <td style="width: 18px;">No Ijazah</td>
                <td style="width: 5px;">:</td>
                <td style="width: 100px;">{{$yudisium[0]->no_ijazah_d}}</td>
            </tr>
            <tr>
                <td style="width: 18px;">Ijazah Akta</td>
                <td style="width: 5px;">:</td>
                <td style="width: 100px;">{{$yudisium[0]->no_ijazah_a}}</td>
            </tr>
        @endif

        <tr>
            <td style="width: 18px;">No LIP</td>
            <td style="width: 5px;">:</td>
            <td style="width: 100px;">{{$nota[0]->nomor_billing}}</td>
        </tr>
        <tr>
            <td style="width: 18px;">Status</td>
            <td style="width: 5px;">:</td>
            <td style="width: 100px;">{{$lip[0]->keterangan}}</td>
        </tr>
        <tr>
            <td style="width: 18px;">Tgl Bayar</td>
            <td style="width: 5px;">:</td>
            <td style="width: 100px;">{{$lip[0]->tanggalsetor}}</td>
        <tr>
            <td style="width: 18px;">Total Bayar</td>
            <td style="width: 5px;">:</td>
            <td style="width: 100px;">{{$lip[0]->totalbayar}}</td>
        </tr>
        <tr>
            <td style="width: 18px;">Bank</td>
            <td style="width: 5px;">:</td>
            <td style="width: 100px;">{{$lip[0]->nama_bank}}</td>
        </tr>
        {{--            @endif--}}
        </tbody>
    </table>
    <p>----------------------------------------------------------------------------</p>
    <p class="bawah">Catatan :<br/>{{config('app.upbjj')}} tidak bertanggungjawab atas kehilangan
        <strong>Surat Keterangan</strong> atau <strong>Legalisir&nbsp;</strong>jika tidak diambil dalam
        jangka
        waktu 1 (satu) bulan terhitung mulai tanggal tertera pada nota ini.</p>
@endif
</body>
