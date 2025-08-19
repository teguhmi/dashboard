<?php

namespace App\Http\Controllers\layanan\legalisir;

use App\Http\Controllers\Controller;
use App\Models\layanan\legalisir\layanan_legalisirModel;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\IpUtils;
use Illuminate\Support\Facades\Crypt;


class legalisir_formController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request)
    {

        $ip = $request->getClientIp();
        $nim = $request->input('nim');
        if (empty($nim)) {
            return view('pages.layanan.legalisir.legalisir_form',compact('ip'));
        } else {
            return redirect()->route('legalisir.refresh', ['id' => Crypt::encrypt($nim)]);
        }

    }

    public function refresh($id, Request $request)
    {
        $nim = decrypt($id);
        $ip = $request->getClientIp();
        if (empty($nim)) {
            return view('pages.layanan.legalisir.legalisir_form');
        } else {
            $DPMahasiswa = SettingModel::get_dp($nim);
            $lip = SettingModel::get_lip_legalisir($nim);
            $yudisium = SettingModel::get_yudisium($nim);
            $transaksi = layanan_legalisirModel::getTransaksiLegalisir($nim);
            if (empty($yudisium)) {
                return redirect()->route('legalisir.index')->with(['error' => 'Data Yudisium tidak ditemukan']);
            } else {
                return view('pages.layanan.legalisir.legalisir_form', compact('DPMahasiswa', 'lip', 'yudisium', 'transaksi','ip'));
            }
        }
    }

    public function getBYlip(Request $request)
    {

        $lip = $request->input('lip');
        $hasil = SettingModel::getlip($lip);
        if ($hasil[0]->statusbank == '1') {
            $statusbank = "Lunas";
        } else {
            $statusbank = "Belum Lunas";
        }
        $data = array(
            'totalbayar' => $hasil[0]->totalbayar,
            'statusbank' => $statusbank,
        );
        echo json_encode($data);
    }

    public function simpan(Request $request)
    {
        $nim = $request->input('nim');
        $lip = $request->input('lip');
        $DPMahasiswa = SettingModel::get_dp($nim);
        $yudisium = SettingModel::get_yudisium($nim);
        $lip = SettingModel::getlip($lip);
        if (empty($DPMahasiswa) || empty($yudisium) || empty($lip)) {
            return redirect()->back()->with(['error' => 'Data Gagal Terproses, Silakan di transaksikan ulang']);
        }
        /* Buat Nota*/
        $id = config('app.kode_upbjj') . date('y');
        $max_nota = layanan_legalisirModel::BuatNotaLegalisir($id);
        /*End Buat Nota */
        $data = array(
            'id_nota' => $id . sprintf("%05s", $max_nota[0]->urut),
            'nim' => $DPMahasiswa[0]->nim,
            'nama_mahasiswa' => $DPMahasiswa[0]->nama_mahasiswa,
            'kode_upbjj' => $DPMahasiswa[0]->kode_upbjj,
            'nomor_billing' => $lip[0]->nobilling,
            'total_bayar' => $lip[0]->totalbayar,
            'user_create' => Auth::user()->name
        );
        try {
            layanan_legalisirModel::simpan($data);
        } catch (\Exception $e) {
            return redirect()->route('legalisir.refresh', ['id' => Crypt::encrypt($nim)])->with(['warning' => 'LIP Sudah digunakan']);
        }
        return redirect()->route('legalisir.refresh', ['id' => Crypt::encrypt($nim)]);
    }

    public function cetak_nota($id)
    {
        $id = decrypt($id);
//        if (empty($id)) {
//            return redirect()->route('legalisir.refresh', ['id' => Crypt::encrypt($nim)])->with(['warning' => 'Error ID Legalisir, Silakan refresh atau diulangi proses legalisir ']);
//        }
        $nota = layanan_legalisirModel::GetNotaLegalisir($id);
        $lip = $nota[0]->nomor_billing;
        $nim = $nota[0]->nim;
        $lip = SettingModel::getlip($lip);
        $DPMahasiswa = SettingModel::get_dp($nim);
        $yudisium = SettingModel::get_yudisium($nim);
        $upbjj = SettingModel::getAlamatUPBJJ(config('app.kode_upbjj'));
        $pdf = null;
        $pages = \View::make('pages.layanan.legalisir.legalisir_nota_pdf', compact('nota','DPMahasiswa','nim','yudisium','lip','upbjj'))->render();
        $pdf = \App::make('snappy.pdf.wrapper');
        $pdf->loadHTML($pages)
            ->setOption('page-size', 'A5')
            ->setOrientation('landscape')
            ->setOption('no-background', false)
            ->setOption('background', true)
            ->setOption('disable-javascript', true)
            ->setOption('print-media-type', true)
            ->setOption('margin-bottom', 0)
            ->setOption('margin-left', 5)
            ->setOption('margin-right', 120)
            ->setOption('margin-top', 10)
            ->setOption('encoding', 'utf-8');
        return $pdf->inline($id . '.pdf');
    }
}
