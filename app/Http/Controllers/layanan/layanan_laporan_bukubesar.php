<?php

namespace App\Http\Controllers\layanan;

use App\Http\Controllers\Controller;
use App\Models\layanan\layanan_LaporanBBModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class layanan_laporan_bukubesar extends Controller
{
    public function index()
    {
        $query = layanan_LaporanBBModel::getDataAll();
        return view('pages.layanan.layanan_laporan_buku_besar',compact('query'));
    }


}
