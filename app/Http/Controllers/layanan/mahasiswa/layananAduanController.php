<?php

namespace App\Http\Controllers\layanan\mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\srs\QueryDatabaseDashboard;
use App\Models\srs\QuerySRS5G;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class layananAduanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $jenis = $request->input('jenis');
        $status = $request->input('status');
        $jenisaduan = QueryDatabaseDashboard::Get_JenisAduan();
        $statusaduan = QueryDatabaseDashboard::Get_StatusAduan();
        if (empty($jenis) || empty($status)) {
            return view('pages.layanan.mahasiswa.form_layanan_aduan', compact('jenisaduan', 'statusaduan'));
        } else {
            $reload = self::reload($jenis, $status);
            return $reload;
        }

    }

    public static function reload($jenis, $status)
    {
        $jenisaduan = QueryDatabaseDashboard::Get_JenisAduan();
        $statusaduan = QueryDatabaseDashboard::Get_StatusAduan();
        $sql = QueryDatabaseDashboard::Get_LaporanAduan($jenis, $status);
        return view('pages.layanan.mahasiswa.form_layanan_aduan', compact('sql', 'jenisaduan', 'statusaduan', 'jenis', 'status'));
    }

    public static function ubah($id, $jenis)
    {
        if (!empty($jenis) && !empty($id)) {
            $id = decrypt($id);
            $data_array = array(
                'status' => $jenis,
                'user_selesai' => Auth::user()->name,
                'user_date_selesai' => date('Y-m-d H:i:s'),
            );
            QueryDatabaseDashboard::ubah($id, $data_array);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public static function Get_JenisAduan_by_ID(Request $request)
    {
        $id = $request->input('id');
        if (empty($id)) {
            return redirect(route('home'));
        } else {
            $results = DB::table('kl_layanan')
                ->where('id', $id)
                ->get();
            return $results;
        }

    }

    public static function Aduan_Umum_Simpan(Request $request)
    {
        $id = $request->input('mid');
        $status = $request->input('mkl_status');
        $jawaban = $request->input('mjawaban');


        if (empty($id)) {
            return redirect(route('home'));
        } else {
            $data_array = array(
                'keterangan' => $jawaban,
                'status' => $status
            );
            DB::table('kl_layanan')
                ->where('id', $id)
                ->update($data_array);
        }

        return redirect()->back();

    }
}
