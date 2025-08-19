<?php

namespace App\Http\Controllers\layanan;

use App\Http\Controllers\Controller;
use App\Models\layanan\layanan_dataKPModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class layanan_dataKPController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roleadmin:admin')->except('index');
    }
    public function index()
    {
        try {
            $query = layanan_dataKPModel::getdataAll();

            if (!empty($query)) {
                return view('pages.layanan.layanan_data_kp', compact('query'));
            }

        } catch (\Exception $e) {
            return redirect()->route('dashboardlayanan')->with(['danger' => 'Kesalahan mengambil data (KP)']);
        }

    }
    public function hapus($id)
    {

        if (Auth::check()) {
            $id = decrypt($id);
            try {
                layanan_dataKPModel::hapus($id);
                return redirect()->route('layanan.data.kp')->with(['success' => 'Data Berhasil Dihapus']);
            } catch (\Illuminate\Database\QueryException $exception) {
                return redirect()->route('layanan.data.kp')->with(['error' => 'Gagal hapus data peserta']);
            }
        } else {
            return redirect()->route('layanan.data.kp')->with(['error' => 'Silakan login terlebih dahulu']);
        }
    }
    public function tambah(Request $request)
    {

        $nama_kp = $request->input('nama_kp');
        if(!empty($nama_kp)){
            $data = array(
                'nama_kp' => $nama_kp,

            );
            layanan_dataKPModel::tambah($data);
            return redirect()->route('layanan.data.kp')->with(['success' => 'Data Berhasil Ditambahkan']);
        } else {
            return redirect()->route('layanan.data.kp')->with(['warning' => 'Data Gagal Ditambahkan']);
        }
    }


    public function ubah(Request $request)
    {

        $id_kp = decrypt($request->input('id_kp'));
        $nama_kp = $request->input('nama_kp');
        if(!empty($id_kp && $nama_kp)){
            $data = array(
                'nama_kp' => $nama_kp,
            );
            layanan_dataKPModel::ubah($data,$id_kp);
            return redirect()->route('layanan.data.kp')->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return redirect()->route('layanan.data.kp')->with(['warning' => 'Data Berhasil Ditambahkan']);
        }
    }
}
