<?php

namespace App\Http\Controllers\layanan;

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

class layanan_FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'form_layanan', 'input');
    }

    public function index()
    {
        $tiket = layanan_FormModel::getJumlahTiket();
        return view('pages.layanan.layanan_home', compact('tiket'));
    }

    public function form_layanan(Request $request)
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
            return view('pages.layanan.layanan_form_dp', compact('asal', 'kp', 'kategori', 'pj', 'status'));
        }
        if (IpUtils::checkIp($clientIp, $ip)) {
            return view('pages.layanan.layanan_form_dp', compact('asal', 'kp', 'kategori', 'pj', 'status'));
        } else {
            return redirect()->route(('home'));
        }

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
                return redirect()->route('layanan.formulir')->with(['warning' => 'Hari ini,  ' . stripslashes($nama) . ' sudah terdapat tiket pelaporan']);
            }
            $id_data_dp = layanan_FormModel::tambah($data);
        } else {
            layanan_FormModel::ubah($data, $id_data_dp);
        }
        $hasil = layanan_FormModel::getDeskripsibyID($id_data_dp);
        $query = layanan_FormModel::getDPbyID($id_data_dp);
        return view('pages.layanan.layanan_form_dp', compact('asal', 'kp', 'kategori', 'pj', 'status', 'hasil', 'query'));
//        } else {
//            return redirect()->route('layanan.formulir')->with(['warning' => 'Silakan login terlebih dahulu']);
//        }
    }

    public function refresh($id_data_dp)
    {

        $asal = layanan_dataAsalModel::getdataAll();
        $kp = layanan_dataKPModel::getdataAll();
        $kategori = layanan_dataKategoriModel::getdataAll();
        $pj = layanan_dataPJModel::getdataAll();
        $status = layanan_dataStatusModel::getdataAll();

        $query = layanan_FormModel::getDPbyID($id_data_dp);
        $hasil = layanan_FormModel::getDeskripsibyID($id_data_dp);
        return view('pages.layanan.layanan_form_dp', compact('query', 'hasil', 'asal', 'kp', 'kategori', 'pj', 'status'));
    }

    public function input_deskripsi(Request $request)
    {
        $id_data_dp = $request->input('id_data_dp');
        $id_kategori = $request->input('id_kategori');


        $asal = layanan_dataAsalModel::getdataAll();
        $kp = layanan_dataKPModel::getdataAll();
        $kategori = layanan_dataKategoriModel::getdataAll();
        $pj = layanan_dataPJModel::getdataAll();
        $status = layanan_dataStatusModel::getdataAll();

        $data = array(
            'id_data_dp' => $request->input('id_data_dp'),
            'id_pj' => $request->input('id_pj'),
            'id_kategori' => $request->input('id_kategori'),
            'deskripsi' => $request->input('deskripsi'),
            'deskripsi_user_create' => Auth::user()->name,
            'deskripsi_user_date' => date('Y-m-d H:m:s'),
            'id_status' => '1',
        );
        $cek = layanan_FormModel::getDeskripsibyIDKategori($id_kategori, $id_data_dp);
        if (empty($cek)) {
            layanan_FormModel::tambah_deskripsi($data);
            $query = layanan_FormModel::getDPbyID($id_data_dp);
            $hasil = layanan_FormModel::getDeskripsibyID($id_data_dp);
            return view('pages.layanan.layanan_form_dp', compact('query', 'hasil', 'asal', 'kp', 'kategori', 'pj', 'status'));
        } else {
            return redirect('layanan/formulir/' . $id_data_dp . '/refresh')->with(['error' => 'Data gagal tersimpan, sudah terdapat kategori yang sama']);
        }

    }

    public function hapusdeskripsi($id_deskripsi, $id_data_dp)
    {
        if (Auth::check()) {
            $id_deskripsi = decrypt($id_deskripsi);
            $id_data_dp = decrypt($id_data_dp);
            try {
                layanan_FormModel::hapusdeskripsi($id_deskripsi);
//                return redirect()->route('profile', [$user]);
                return redirect()->route('layanan.formulir.refresh', ['id_data_dp' => $id_data_dp])->with(['error' => 'Data berhasil dihapus']);
            } catch (\Illuminate\Database\QueryException $exception) {
                route('layanan.formulir.refresh', ['id_data_dp' => $id_data_dp], '/refresh')->with(['error' => 'Error hapus data peserta']);
            }
        } else {
            route('layanan.formulir.refresh', ['id_data_dp' => $id_data_dp], '/refresh')->with(['error' => 'Gagal menghapus data']);
        }

    }

}
