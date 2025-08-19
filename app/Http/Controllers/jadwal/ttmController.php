<?php

namespace App\Http\Controllers\jadwal;

use App\Http\Controllers\Controller;
use App\Http\Controllers\srs\QuerySRSController;
use App\Models\jadwal\jadwal_tutorialModel;
use App\Models\srs\QuerySRS5G;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ttmController extends Controller
{

    public function index()
    {
        return view('pages.ttm.jadwal_tutorial');
    }

    public function ttm_mhs_by_nim()
    {
        $masa = '20231';
        $nim = '857841089';
        $id = '44001310';
        $DPMahasiswa = QuerySRS5G::getdpbynim($nim);
//        $ttmMahasisswa = QuerySRS5G::getttmbynim($masa,$nim);
        $ttmMahasisswa = QuerySRS5G::getttmbytutor($masa, $id);
    }

    public function search(Request $request)
    {

        $this->validate($request, [
            'captcha' => 'required|captcha'
        ],
            ['captcha.captcha' => 'Kode captcha belum sesuai.']);

        $id = $request->input('id');
        $masa = $request->input('masa');

        $kode_upbjj = config('app.kode_upbjj');
        if (!empty($masa) && !empty($id)) {

            $query_mhs = QuerySRS5G::getttmbynim($masa, $id);
            $DP_Mahasiswa = QuerySRS5G::getdpbynim($id);
            $query_tutor = QuerySRS5G::getttmbytutor($masa, $id);

        } else {
            return redirect()->route('ttm.jadwal')->with('error', 'Refresh / Reload Captcha');
        }
        if (!empty($query_mhs->data)) {
            foreach ($query_mhs->data as $item) {
//                $masa = $item->masa;
//                $id_tutorial = $item->id_tutorial;
//                $id_kelas = $item->id_kelas;
//                $query = QuerySRS5G::getttmbykelas($masa, $id_kelas,$id_tutorial);
//                if(!empty($query)) {
//                    foreach ($query->data as $items) {
//                        $status = $items->status_approval;
//                        if(empty($status)) {
//                            $status = 'Dalam Proses';
//                        }
//                    }
//                }
                $data_mhs[] = array(
                    'masa' => $item->masa,
                    'nim' => $item->nim,
                    'nama_mahasiswa' => $item->nama_mahasiswa,
                    'kode_matakuliah' => $item->kode_matakuliah,
                    'nama_matakuliah' => $item->nama_matakuliah,
                    'id_tutor' => $item->id_tutor,
                    'nama_tutor' => $item->nama_tutor,
                    'nama_hari' => $item->nama_hari,
                    'jam' => $item->jam,
                    'tanggal_mulai' => $item->tanggal_mulai,
                    'id_tutorial' => $item->id_tutorial,
                    'lokasi' => $item->lokasi,
                    'link' => $item->link,
                    'id_kelas' => $item->id_kelas,
                    'status' => $item->status_approval_wr3,

                );
            }

        } else {
            $data_mhs = '';
        }

        if (!empty($query_tutor->data)) {
            foreach ($query_tutor->data as $item) {
//                $masa = $item->masa;
//                $id_tutorial = $item->id_tutorial;
//                $id_kelas = $item->id_kelas;
//                $query = QuerySRS5G::getttmbykelas($masa, $id_kelas,$id_tutorial);
//                if(!empty($query)) {
//                if(!empty($query)) {
//                    foreach ($query->data as $items) {
//                        $status = $items->status_approval;
//                    }
//                }
                $data_tutor[] = array(
                    'masa' => $item->masa,
                    'id_tutor' => $item->id_tutor,
                    'nama_tutor' => $item->nama_tutor,
                    'kode_matakuliah' => $item->kode_matakuliah,
                    'nama_matakuliah' => $item->nama_matakuliah,
                    'nama_hari' => $item->nama_hari,
                    'jam' => $item->jam,
                    'lokasi' => $item->lokasi,
                    'tanggal_mulai' => $item->tanggal_mulai,
                    'link' => $item->link,
                    'id_kelas' => $item->id_kelas,
                    'id_tutorial' => $item->id_tutorial,
                    'status' => $item->status_tutorial,
                );
            }
        } else {
            $data_tutor = '';
        }

        try {
            if (empty($data_tutor || $data_mhs)) {
                return redirect()->route('ttm.jadwal')->with(['warning' => 'Data tidak ditemukan / Anda tidak terdaftar sebagai peserta Tutorial (tuweb)']);
            } else {
                return view('pages.ttm.jadwal_tutorial', compact('data_mhs', 'data_tutor', 'DP_Mahasiswa'));
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('ttm.jadwal')->with('error', 'Terjadi kesalahan');
        }
    }

    public function kelas($id1, $id2, $id3)
    {
        $masa = decrypt($id1);
        $id_kelas = decrypt($id2);
        $id_tutorial = $id3;
        $query = QuerySRS5G::getttmbykelas($masa, $id_kelas, $id_tutorial);

        if (empty($query) || $query == null) {
            return redirect()->route('ttm.jadwal')->with(['warning' => 'Data tidak ditemukan Silakah hubungi UT Daerah']);
        } else {
            return view('pages.ttm.daftar_tutorial_kelas', compact('query'));
        }
    }
}
