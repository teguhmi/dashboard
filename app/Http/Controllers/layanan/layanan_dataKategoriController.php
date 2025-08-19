<?php

namespace App\Http\Controllers\layanan;

use App\Http\Controllers\Controller;
use App\Models\layanan\layanan_dataKategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class layanan_dataKategoriController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roleadmin:admin')->except('index');
    }
    public function index()
    {
        try {
            $query = layanan_dataKategoriModel::getdataAll();
            if (!empty($query)) {
                return view('pages.layanan.layanan_data_kategori', compact('query'));
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
                layanan_dataKategoriModel::hapus($id);
                return redirect()->route('layanan.data.kategori')->with(['success' => 'Data Berhasil Dihapus']);
            } catch (\Illuminate\Database\QueryException $exception) {
                return redirect()->route('layanan.data.kategori')->with(['error' => 'Gagal hapus data peserta']);
            }
        } else {
            return redirect()->route('layanan.data.kategori')->with(['error' => 'Silakan login terlebih dahulu']);
        }
    }
    public function tambah(Request $request)
    {

        $nama_kategori = $request->input('nama_kategori');
        if(!empty($nama_kategori)){
            $data = array(
                'nama_kategori' => $nama_kategori,

            );
            layanan_dataKategoriModel::tambah($data);
            return redirect()->route('layanan.data.kategori')->with(['success' => 'Data Berhasil Ditambahkan']);
        } else {
            return redirect()->route('layanan.data.kategori')->with(['warning' => 'Data Gagal Ditambahkan']);
        }
    }


    public function ubah(Request $request)
    {

        $id_kategori = decrypt($request->input('id_kategori'));
        $nama_kategori = $request->input('nama_kategori');
        if(!empty($id_kategori && $nama_kategori)){
            $data = array(
                'nama_kategori' => $nama_kategori,
            );
            layanan_dataKategoriModel::ubah($data,$id_kategori);
            return redirect()->route('layanan.data.kategori')->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return redirect()->route('layanan.data.kategori')->with(['warning' => 'Data Berhasil Ditambahkan']);
        }
    }
}
