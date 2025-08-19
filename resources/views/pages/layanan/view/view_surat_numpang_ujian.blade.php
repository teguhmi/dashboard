<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="keywords" content="layanan, mahasiswa, sertifikat, ijazah, kelulusan"/>
    <meta name="description" content="Surat Keterangan & Legalisir">
    <meta name="author" content="teguhmi">
    <title>Surat Keterangan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
</div>
<div class="jumbotron d-flex align-items-center min-vh-100">
    <div class="container text-center">
        <img width="130px" height="100px" src="{{ secure_url ('/app-assets/images/logo/logo_ut_text.png') }}" align="top" alt=""/>&nbsp;
        <h1>DATA SURAT KETERANGAN</h1>
    </div>
</div>
@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <p class="text-center">
            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
            <strong>   {{$message }} </strong>
        </p>
    </div>
@endif
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <p class="text-center">
            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
            <strong>   {{$message}} </strong>
        </p>
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <p class="text-center">
            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
            <strong>   {{ $message}} </strong>
        </p>
    </div>
@endif
@php
    setlocale(LC_ALL, 'id_ID.88591', 'id_ID', 'ID');
@endphp
@if(!empty($sql))
    @foreach($sql as $data)
        <table class="table table-bordered">
            <thead>
            </thead>
            <tbody>
            <tr>
                <td width="30%">Nomor Surat</td>
                <td>:</td>
                <td width="50%">{{$surat[0]->nomor_surat}}</td>
            </tr>
            <tr>
                <td>Tanggal Surat</td>
                <td width="1%">:</td>
                <td>{{strftime("%d %B %Y", strtotime($surat[0]->tanggal_surat))}}</td>
            </tr>
            <tr>
                <td>Perihal Surat</td>
                <td>:</td>
                <td> {{$jenissurat[0]->nama_surat}} Masa {{$masa}}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td>{{$DPMahasiswa['nim']}}</td>
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

            <tr>
                <td>Penandatangan</td>
                <td>:</td>
                <td>{{$surat[0]->penandatangan}}</td>
            </tr>
            <tr>
                <td>Nama Penandatangan</td>
                <td>:</td>
                <td>{{$surat[0]->nama_penandatangan}}</td>
            </tr>
            <tr>
                <td>NIP Penandatangan</td>
                <td>:</td>
                <td>{{$surat[0]->nip_penandatangan}}</td>
            </tr>
            </tbody>
        </table>
    @endforeach
@endif
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
