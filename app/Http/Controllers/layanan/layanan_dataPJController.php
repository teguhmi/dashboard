<?php

namespace App\Http\Controllers\layanan;

use App\Http\Controllers\Controller;
use App\Models\layanan\layanan_dataPJModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class layanan_dataPJController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roleadmin:admin')->except('index');
    }
    public function index()
    {
        try {
            $query = layanan_dataPJModel::getdataAll();
            if (!empty($query)) {
                return view('pages.layanan.layanan_data_pj', compact('query'));
            }

        } catch (\Exception $e) {
            return redirect()->route('dashboardlayanan')->with(['danger' => 'Kesalahan mengambil data {PJ)']);
        }

    }
    public function hapus($id)
    {

        if (Auth::check()) {
            $id = decrypt($id);
            try {
                layanan_dataPJModel::hapus($id);
                return redirect()->route('layanan.data.pj')->with(['success' => 'Data Berhasil Dihapus']);
            } catch (\Illuminate\Database\QueryException $exception) {
                return redirect()->route('layanan.data.pj')->with(['error' => 'Gagal hapus data peserta']);
            }
        } else {
            return redirect()->route('layanan.data.pj')->with(['error' => 'Silakan login terlebih dahulu']);
        }
    }
    public function tambah(Request $request)
    {

        $nama_pj = $request->input('nama_pj');
        if(!empty($nama_pj)){
            $data = array(
                'nama_pj' => $nama_pj,

            );
            layanan_dataPJModel::tambah($data);
            return redirect()->route('layanan.data.pj')->with(['success' => 'Data Berhasil Ditambahkan']);
        } else {
            return redirect()->route('layanan.data.pj')->with(['warning' => 'Data Gagal Ditambahkan']);
        }
    }


    public function ubah(Request $request)
    {

        $id_pj = decrypt($request->input('id_pj'));
        $nama_pj = $request->input('nama_pj');
        if(!empty($id_pj && $nama_pj)){
            $data = array(
                'nama_pj' => $nama_pj,
            );
            layanan_dataPJModel::ubah($data,$id_pj);
            return redirect()->route('layanan.data.pj')->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return redirect()->route('layanan.data.pj')->with(['warning' => 'Data Berhasil Ditambahkan']);
        }
    }
}
