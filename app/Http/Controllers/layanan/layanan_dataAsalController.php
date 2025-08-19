<?php

namespace App\Http\Controllers\layanan;

use App\Http\Controllers\Controller;
use App\Models\layanan\layanan_dataAsalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class layanan_dataAsalController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roleadmin:admin')->except('index');

    }
    public function index()
    {
        try {
            $query = layanan_dataAsalModel::getdataAll();
            if (!empty($query)) {
                return view('pages.layanan.layanan_data_asal', compact('query'));
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
                layanan_dataAsalModel::hapus($id);
                return redirect()->route('layanan.data.asal')->with(['success' => 'Data Berhasil Dihapus']);
            } catch (\Illuminate\Database\QueryException $exception) {
                return redirect()->route('layanan.data.asal')->with(['error' => 'Gagal hapus data peserta']);
            }
        } else {
            return redirect()->route('layanan.data.asal')->with(['error' => 'Silakan login terlebih dahulu']);
        }
    }
    public function tambah(Request $request)
    {

        $nama_asal = $request->input('nama_asal');
        if(!empty($nama_asal)){
            $data = array(
                'nama_asal' => $nama_asal,

            );
            layanan_dataAsalModel::tambah($data);
            return redirect()->route('layanan.data.asal')->with(['success' => 'Data Berhasil Ditambahkan']);
        } else {
            return redirect()->route('layanan.data.asal')->with(['warning' => 'Data Gagal Ditambahkan']);
        }
    }


    public function ubah(Request $request)
    {

        $id_asal = decrypt($request->input('id_asal'));
        $nama_asal = $request->input('nama_asal');
        if(!empty($id_asal && $nama_asal)){
            $data = array(
                'nama_asal' => $nama_asal,
            );
            layanan_dataAsalModel::ubah($data,$id_asal);
            return redirect()->route('layanan.data.asal')->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return redirect()->route('layanan.data.asal')->with(['warning' => 'Data Berhasil Ditambahkan']);
        }
    }
}
