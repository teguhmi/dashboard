<?php

namespace App\Http\Controllers\layanan;

use App\Http\Controllers\Controller;
//use App\Models\mahasiswa\mahasiswaModel;
use App\Models\mahasiswa\presensi\presensiModel;

class layanan_pjController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('pages.layanan.layanan_data_pj');
    }


}
