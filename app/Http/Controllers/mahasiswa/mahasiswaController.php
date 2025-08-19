<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
//use App\Models\mahasiswa\mahasiswaModel;
use App\Models\mahasiswa\presensi\presensiModel;

class mahasiswaController extends Controller
{
    public function index()
    {
        return view('pages.mahasiswa.mahasiswa_home');
    }

    public function index_absen()
    {


        $getabsenkonfigurasi = presensiModel::getabsenkonfigurasi();
        if (!empty($getabsenkonfigurasi)) {
            return view('pages.mahasiswa.absen-kegiatan.absen_isi', compact('getabsenkonfigurasi'));
        } else {

            return view('pages.mahasiswa.absen-kegiatan.absen_isi');
        }
    }


}
