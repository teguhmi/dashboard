<?php

namespace App\Http\Controllers\jadwal;

use App\Http\Controllers\Controller;
use App\Models\jadwal\jadwal_tutorialModel;
use Illuminate\Http\Request;

class jadwalController extends Controller
{
    public function index()
    {
//        return view('pages.jadwal.jadwal_home');
        return view('pages.jadwal.jadwal_tutorial');

    }

    public function dashboard()
    {
        return view('pages.jadwal.jadwal_home');
    }

    public function home($id, $id2)
    {
        $id = decrypt($id);
        $jenis = $id2;
        if ($jenis == 'angketetm') {

        }
        $kode_upbjj = config('app.kode_upbjj');
        if (!empty($id)) {
            $query_mhs = jadwal_tutorialModel::getDataBYNIM($id, $kode_upbjj);
            return redirect()->route('jadwal.tutorial.home', compact('query_mhs'), ['id' => Crypt::encrypt($id)])
                ->with(['success' => 'Terima Kasih Atas Waktu dan Masukan yang anda berikan,Semua masukan yang anda berikan akan kami terima sebagai sarana bagi kami untuk meningkatkan kulaitas pelanan kami']);
        }


    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'captcha' => 'required|captcha'
        ],
            ['captcha.captcha' => 'Kode captcha belum sesuai.']);

        $id = $request->input('id');
        $kode_upbjj = config('app.kode_upbjj');
//        $tanggallahir = $request->input('tanggal_lahir');
        if (!empty($id)) {
            $query_mhs = jadwal_tutorialModel::getDataBYNIM($id, $kode_upbjj);
            $query_tutor = jadwal_tutorialModel::getDataBYidtutor($id, $kode_upbjj);
        } else {
            return redirect()->route('jadwal.tutorial')->with('error', 'Refresh / Reload Captcha');
        }
        try {
            if (empty($query_tutor || $query_mhs)) {
                return redirect()->route('jadwal.tutorial')->with(['warning' => 'Data tidak ditemukan / Anda tidak terdaftar sebagai peserta Tutorial (tuweb)']);
            } else {
                return view('pages.jadwal.jadwal_tutorial', compact('query_mhs', 'query_tutor'));
            }
        } catch (\Exception $e) {
            return redirect()->route('jadwal.tutorial')->with('error', 'Terjadi kesalahan');
        }

    }

    public function jadwal_home($id)
    {
        $id = decrypt($id);
        $kode_upbjj = config('app.kode_upbjj');
        if (!empty($id)) {
            $query_mhs = jadwal_tutorialModel::getDataBYNIM($id, $kode_upbjj);
            $query_tutor = jadwal_tutorialModel::getDataBYidtutor($id, $kode_upbjj);
        } else {
            return redirect()->route('jadwal.tutorial')->with('error', 'Refresh / Reload Captcha');
        }
        try {
            if (empty($query_tutor || $query_mhs)) {
                return redirect()->route('jadwal.tutorial')->with(['warning' => 'Data tidak ditemukan / Anda tidak terdaftar sebagai peserta Tutorial (tuweb)']);
            } else {
                return view('pages.jadwal.jadwal_tutorial', compact('query_mhs', 'query_tutor'));
            }
        } catch (\Exception $e) {
            return redirect()->route('jadwal.tutorial')->with('error', 'Terjadi kesalahan');
        }

    }

    public function searchBykelas($kelas,$idtutorial)
    {
        $id = decrypt($kelas);
        $kode_upbjj = config('app.kode_upbjj');
//        $query = jadwal_tutorialModel::getDataBYkelas($id, $kode_upbjj,$idtutorial);
        $query = jadwal_tutorialModel::getDataBYkelas($id, $kode_upbjj,$idtutorial);
        return view('pages.jadwal.jadwal_tutorial_kelas', compact('query'));
    }
}
