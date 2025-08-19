<?php

namespace App\Http\Controllers\mahasiswa\absen;

use App\Http\Controllers\Controller;
use App\Models\mahasiswa\absen\absenModel;

class absenController extends Controller
{

    public function index()
    {

        $getabsenkonfigurasi = absenModel::getabsenkonfigurasi();
        if(empty($getabsenkonfigurasi)) {
            $open = '0';
        } else {
            $open = '1';
        }
        if ($open > '0') {
            return view('pages.mahasiswa.absen-kegiatan.absen_isi', compact('getabsenkonfigurasi','open'));
        } else {
            return view('pages.mahasiswa.absen-kegiatan.absen_isi',compact('open'));
        }
    }

    public function index_conf(){
        $getDataKonfigurasi = absenModel::getKonfigurasiAll();
        $getJenisKegiatanAll = absenModel::getJenisKegiatanAll();
        return view('pages.mahasiswa.absen-kegiatan.absen_konfigurasi_jenis', compact('getDataKonfigurasi','getJenisKegiatanAll'));
    }

    public function index_jenis(){

        return view('pages.dashboardmahasiswa');
    }

    public function find()
    {

    }
}
