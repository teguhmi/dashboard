<?php

namespace App\Http\Controllers\ujian;

use App\Http\Controllers\Controller;
use App\Http\Controllers\srs\QuerySRSController;
use App\Models\SettingModel;
use App\Models\srs\QuerySRS;
use App\Models\ujian\NumpangUjianModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class NumpangUjianLaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('roleadmin');

    }

    public function upbjj()
    {

    }

    public function index()
    {
        $jenis = 'daftarnumpang';
        $upbjj = QuerySRSController::getupbjj();
        return view('pages.ujian.Laporan_PesertaNumpangKeluar', compact('jenis', 'upbjj'));
    }

    public function index_jumlah_mtk()
    {
        $jenis = 'jumlahmtk';
        $r = '';
        $upbjj = QuerySRSController::getupbjj();
        return view('pages.ujian.Laporan_PesertaNumpangKeluar', compact('jenis', 'upbjj', 'r'));
    }

    public function get_daftar_numpang(Request $request)
    {
//        $update = NumpangUjianModel::get_all_tpu();
//        foreach ($update as $data){
//            $nim = $data->nim;
//            $DPMahasiswa = QuerySRSController::getdpbynim($nim);
//            $data_array = array(
//                'nama_mahasiswa' => $DPMahasiswa['nama_mahasiswa'],
//            );
//            NumpangUjianModel::insert_nama($nim,$data_array);
//        }

        $id = $request->input('id');
        $kodeupbjj = $request->input('upbjj');
        $jenis = $request->input('jenis');
        $r = $request->input('radio');

        if (empty($id)) {
            return redirect()->back()->with('error', 'Terjadi kesalahan, Masa tidak boleh kosong');
        } else {
            if ($jenis == 'daftarnumpang') {
                $sql = NumpangUjianModel::get_DataNumpangUjian($id);
            }
            if ($jenis == 'jumlahmtk') {
                if ($r == 'daftar') {
                    $sql = NumpangUjianModel::getDaftarNumpangUjian($id, $kodeupbjj);
                } else {
                    $sql = NumpangUjianModel::get_jumlahmatakuliah($id, $kodeupbjj);
                }
            }


            $upbjj = QuerySRSController::getupbjj();
            return view('pages.ujian.Laporan_PesertaNumpangKeluar', compact('sql', 'jenis', 'upbjj', 'r'));
        }

    }

    public function pdf($masa, $t)
    {
        $id = decrypt($masa);
        $kodeupbjj = decrypt($t);
        $sql = NumpangUjianModel::getDaftarNumpangUjian($id, $kodeupbjj);
        if (empty($sql)) {
            return redirect()->back()->with('error', 'Terjadi kesalahan, Masa dan Kode Unit tidak boleh kosong');
        } else {
                $pages = \View::make('pages.ujian.pdf.pdf_daftar_numpang_main', compact('sql'))->render();

                $pdf = \App::make('snappy.pdf.wrapper');
                $pdf->loadHTML($pages)
                    ->setOption('page-size', 'A4')
                    ->setOrientation('portrait')
                    ->setOption('no-background', false)
                    ->setOption('background', true)
                    ->setOption('disable-javascript', true)
                    ->setOption('print-media-type', true)
                    ->setOption('margin-bottom', 5)
                    ->setOption('margin-left', 5)
                    ->setOption('margin-right', 5)
                    ->setOption('margin-top', 5)
                    ->setOption('encoding', 'utf-8')
                    ->setOption('disable-smart-shrinking', true);
                return $pdf->inline($sql[0]->kode_tempat_ujian_tujuan . '.pdf');
        }
    }

}
