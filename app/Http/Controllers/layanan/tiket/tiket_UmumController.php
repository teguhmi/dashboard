<?php

namespace App\Http\Controllers\layanan\tiket;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SettingController;
use App\Models\layanan\layanan_dataAsalModel;
use App\Models\layanan\layanan_dataKategoriModel;
use App\Models\layanan\layanan_dataKPModel;
use App\Models\layanan\layanan_dataPJModel;
use App\Models\layanan\layanan_dataStatusModel;
use App\Models\layanan\layanan_FormModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\IpUtils;

class tiket_UmumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'form_layanan', 'input');
    }


    public function index()
    {

        $clientIp = SettingController::getIP();
        $ip = [
            '10.44.10.0/24',
            '10.45.10.0/24',
            '10.42.10.0/24'
        ];
        $asal = layanan_dataAsalModel::getdataAll();
        $kp = layanan_dataKPModel::getdataAll();
        $kategori = layanan_dataKategoriModel::getdataAll();
        $pj = layanan_dataPJModel::getdataAll();
        $status = layanan_dataStatusModel::getdataAll();

        if(Auth::check()) {
            return view('pages.layanan.tiket.tiket_form_umum', compact('asal', 'kp', 'kategori', 'pj', 'status'));
        }
//        if (IpUtils::checkIp($clientIp, $ip)) {
//            return view('pages.layanan.tiket.tiket_form_umum', compact('asal', 'kp', 'kategori', 'pj', 'status'));
//        } else {
//            return redirect()->route(('home'));
//        }
            return view('pages.layanan.tiket.tiket_form_umum', compact('asal', 'kp', 'kategori', 'pj', 'status'));

    }

    public function input(Request $request)
    {

//        if (Auth::check()) {
        $id_data_dp = $request->input('id_data_dp');
        $asal = layanan_dataAsalModel::getdataAll();
        $kp = layanan_dataKPModel::getdataAll();
        $kategori = layanan_dataKategoriModel::getdataAll();
        $pj = layanan_dataPJModel::getdataAll();
        $status = layanan_dataStatusModel::getdataAll();
        $data = array(
            'id_asal' => $request->input('asal'),
            'id_kp' => $request->input('kl_kp'),
            'nim' => $request->input('nim'),
            'nama' => $request->input('nama'),
            'telepon' => $request->input('telepon'),
            'email' => $request->input('email'),
            'kode_upbjj' => $request->input('kode_upbjj'),
            'nama_upbjj' => $request->input('nama_upbjj'),
        );
        if (is_null($id_data_dp)) {
            $nama = addslashes($request->input('nama'));
            $cek = layanan_FormModel::getDPbyname($nama);
            if (!empty($cek)) {
                return redirect()->route('layanan.tiket')->with(['warning' => 'Hari ini,  ' . stripslashes($nama) . ' sudah terdapat tiket pelaporan']);
            }
            $id_data_dp = layanan_FormModel::tambah($data);
        } else {
            layanan_FormModel::ubah($data, $id_data_dp);
        }
       return redirect(route('layanan.tiket'))->with(['success' => 'Data Tersimpan, Silakan tunggu anda akan dipanggil sesuai antrian']);
    }


}
