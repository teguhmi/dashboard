<?php

namespace App\Http\Controllers\layanan\mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Controllers\srs\QueryQontak;
use App\Http\Controllers\srs\QuerySRSController;
use App\Models\layanan\mahasiswa\layanan_wifiIDModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class layananWifiIDController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rolepjb:admin,frontdesk')->except('index');
    }

    public function index(Request $request)
    {
        $jenis = $request->input('jenis');
        $status = $request->input('status');

        if ($jenis == 'wifiID') {
            $masa = QuerySRSController::getMasaAktif();
            $sql = layanan_wifiIDModel::getPermohonanwifiIDbyStatus($status);
            if (empty($sql)) {
                $status = 'baru';
                $sql = layanan_wifiIDModel::getPermohonanwifiIDbyStatus($status);
            }
            return view('pages.layanan.mahasiswa.form_layanan_WifiID', compact('sql', 'masa'));
        } else {
            return view('pages.layanan.mahasiswa.form_layanan_WifiID');
        }
    }

    public function proses($nim, $jenis)
    {
        $nim = decrypt($nim);

        if (empty($nim)) {
            return redirect()->back()->with('Error', 'NIM harus diisi');
        }
        $DPMahasiswa = QuerySRSController::getdpbynim($nim);
        $datalayanan = layanan_wifiIDModel::getPermohonanwifiIDbynim($nim);

        if (empty($DPMahasiswa) || empty($datalayanan)) {
            return redirect()->back()->with('Error', 'NIM tidak ditemukan');
        }
        $nim = $DPMahasiswa['nim'];
        $masa = $datalayanan[0]->masa;
        if ($jenis == 'wa') {
            $data_array = array(
                'nim' => $nim,
                'name' => $DPMahasiswa['nama_mahasiswa'],
                'hp' => '62' . substr($datalayanan[0]->handphone, 1),
                'user' => $DPMahasiswa['nim'] . '@ut.ac.id',
                'pass' => $datalayanan[0]->password
            );
            $wa = QueryQontak::sendWA($data_array);
            $data = array(
                'id_wa' => $wa->data->id,
                'status' => 'selesai',
            );

            layanan_wifiIDModel::update_idWA($data, $nim, $masa);
            $status = 'proses';
            $masa = QuerySRSController::getMasaAktif();
            $sql = layanan_wifiIDModel::getPermohonanwifiIDbyStatus($status);
            if (empty($sql)) {
                $status = 'baru';
                $sql = layanan_wifiIDModel::getPermohonanwifiIDbyStatus($status);
                return view('pages.layanan.mahasiswa.form_layanan_WifiID', compact('sql', 'masa'));
            } else {
                return redirect()->back()->with('success', 'Data ' . $DPMahasiswa['nama_mahasiswa'] . ' berhasil terkirim');
            }

        }
        if ($jenis == 'pass') {
            $pass = 'WiFi' . substr($datalayanan[0]->masa, 3) . '@' . substr($DPMahasiswa['nim'], 6);
            $data = array(
                'password' => $pass,
                'status' => 'proses',
                'user_proses' => Auth::user()->name,
                'user_date_proses' => date('Y-m-d H:i:s')
            );
            layanan_wifiIDModel::update_password($data, $nim, $masa);
            return redirect()->back()->with('success', 'Password ' . $DPMahasiswa['nama_mahasiswa'] . ' berhasil terbentuk');
        }

    }
}
