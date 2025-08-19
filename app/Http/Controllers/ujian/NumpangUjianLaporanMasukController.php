<?php

namespace App\Http\Controllers\ujian;

use App\Exports\JumlahNumpangMasuk;
use App\Exports\JumlahNumpangMasuk_Daftar;
use App\Http\Controllers\Controller;
use App\Http\Controllers\srs\QuerySRSController;
use App\Models\ujian\NumpangUjianMasukModel;
use App\Models\ujian\NumpangUjianModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Excel;
class NumpangUjianLaporanMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('roleadmin');

    }


    public function index()
    {
        $masa = NumpangUjianMasukModel::getmasaujian();
        $jenis = 'masuk';
        return view('pages.ujian.Laporan_PesertaNumpangMasuk', compact('jenis', 'masa'));
    }

    public function cari(Request $request)
    {
        $masaujian = $request->input('masa');
        $jenis = 'masuk';
        $masa = NumpangUjianMasukModel::getmasaujian();
        $tanggalawal = Carbon::createFromFormat('d/m/Y', $request->input('tgl_awal'))->format('Y-m-d');
        $tanggalakhir = Carbon::createFromFormat('d/m/Y', $request->input('tgl_akhir'))->format('Y-m-d');

        $sql_jumlah = NumpangUjianMasukModel::getjumlahmatakuliahujianmasuk($masaujian, $jenis, $tanggalawal, $tanggalakhir);

        if(!empty($sql_jumlah)) {
            return view('pages.ujian.Laporan_PesertaNumpangMasuk', compact('jenis', 'masa','sql_jumlah','tanggalawal', 'tanggalakhir','masaujian'));
        } else {
            return redirect()->back()->with('warning', 'Data tidak ditemukan');
        }

    }

    public function excel($a,$b,$c,$d,$e)
    {
        $masaujian = $a;
        $jenis = $b;
        $tanggalawal = $c;
        $tanggalakhir = $d;
        $jenislaporan = $e;

        if($jenislaporan == 'jumlah') {
            return Excel::download(new JumlahNumpangMasuk($masaujian,$jenis,$tanggalawal,$tanggalakhir), $masaujian . '_jumlah_numpang.xlsx');
        } elseif($jenislaporan == 'daftar') {
            return Excel::download(new JumlahNumpangMasuk_Daftar($masaujian,$jenis,$tanggalawal,$tanggalakhir), $masaujian . '_daftar_numpang.xlsx');
        }

    }
}
