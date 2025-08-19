<?php

namespace App\Http\Controllers\presensi;

use App\Exports\PresensiExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\srs\QuerySRSController;
use App\Models\presensi\presensiModel;
use App\Models\srs\QuerySRS;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\ValidationException;

class presensiController extends Controller
{

    public function index_dashboard()
    {

        return view('pages.presensi.presensi_home');
    }

    public static function index_mahasiswa()
    {

        $getpresensikonfigurasi = presensiModel::getpresensimahasiswa();
        if (empty($getpresensikonfigurasi)) {
            $open = '0';
        } else {
            $open = '1';
        }
        if ($open > '0') {
            return view('pages.presensi.presensi_mahasiswa', compact('getpresensikonfigurasi', 'open'));
        } else {
            return view('pages.presensi.presensi_mahasiswa', compact('open'));
        }
    }

    public static function search_mahasiswa(Request $request)
    {
        $id_kegiatan = $request->input('option');
        $nim = $request->input('id');
        $tgl_lahir = $request->input('tgl_lahir');
        $query = QuerySRS::getDPbyNIMTgllahir($nim, $tgl_lahir);
        $cek = presensiModel::getJenisKegiatanbyNIM($nim, $id_kegiatan);
        $DPmahasiswa = QuerySRSController::getdpbynim($nim);
//        if(!empty($DPmahasiswa)) {
//            if($DPmahasiswa['tanggal_lahir_mahasiswa'] != $tgl_lahir) {
//                return redirect()->back()->with(['warning' => ' Data tidak sesuai']);
//            }
//        }
        if (!empty($cek)) {
            return redirect()->back()->with(['warning' => $DPmahasiswa['nama_mahasiswa'] . ' Telah mengisi presensi']);
        }
        if (empty($id_kegiatan)) {
            return redirect()->back()->with(['warning' => ' Jenis kegiatan belum dipilih...']);
        }

        if (empty($DPmahasiswa)) {
            return redirect()->back()->with(['warning' => ' Data tidak ditemukan...']);
        } else {
            $data = array(
                'id_kegiatan' => $id_kegiatan,
                'nim' => $DPmahasiswa['nim'],
                'nama' => $DPmahasiswa['nama_mahasiswa'],
                'telepon' => $request->input('hp'),
                'kode_program_studi' => $DPmahasiswa['kode_program_studi'],
                'nama_program_studi' => $DPmahasiswa['nama_program_studi'],
                'masa_registrasi_awal' => $DPmahasiswa['masa_awal_registrasi'],
                'kode_upbjj' => $DPmahasiswa['kode_upbjj'],
            );

            presensiModel::insert($data);
            return redirect()->back()->with(['success' => 'Terimakasih ' . $DPmahasiswa['nama_mahasiswa']. ' Telah mengisi presensi']);
        }

    }


    public static function index_umum()
    {

        $getpresensikonfigurasi = presensiModel::getpresensiumum();
        if (empty($getpresensikonfigurasi)) {
            $open = '0';
        } else {
            $open = '1';
        }
        if ($open > '0') {
            return view('pages.presensi.presensi_umum', compact('getpresensikonfigurasi', 'open'));
        } else {
            return view('pages.presensi.presensi_umum', compact('open'));
        }
    }

    public static function save_umum(Request $request)
    {
        $id_kegiatan = $request->input('option');
        $nim = $request->input('nim');
        $nama = addslashes($request->input('nama'));
        $telepon = $request->input('telepon;');
        $institusi = $request->input('institusi;');

        $sql = presensiModel::getJenisKegiatanByID($id_kegiatan, $nim, $nama, $telepon);

        if (empty($id_kegiatan)) {
            return redirect()->back()->with(['warning' => ' Jenis kegiatan belum dipilih...']);
        } elseif (!empty($sql)) {
            return redirect()->back()->with(['success' => $nama . ' Telah mengisi presensi']);
        } else {
            $data = array(
                'id_kegiatan' => $id_kegiatan,
                'nim' => $nim,
                'nama' => $nama,
                'telepon' => $telepon,
                'institusi' => $institusi,
            );
            presensiModel::insert($data);
            return redirect()->back()->with(['success' => ' Data berhasil tersimpan...']);
        }
    }

    public function index_conf()
    {
        $getDataKonfigurasi = presensiModel::getJenisAll();
        $getJenisKegiatanAll = presensiModel::getJenisKegiatanAll();

        return view('pages.presensi.presensi_config', compact('getDataKonfigurasi', 'getJenisKegiatanAll'));
    }

    public function save_conf(Request $request)
    {
        $jenis = $request->input('jenis');
        try {
            $validator = $this->validate($request, [
                '_token' => 'required',
                'option' => 'required',
                'nama_kegiatan' => 'required|max:200',
                'tgl_buka' => 'required',
                'jam_buka' => 'required',
                'tgl_tutup' => 'required',
                'jam_tutup' => 'required',
                'masa' => 'required',
            ]);

        } catch (ValidationException $e) {
            return redirect()->back()->with(['warning' => ' Error Simpan Jenis Kegiatan...']);
        }

        $buka = $request->input('tgl_buka') . " " . $request->input('jam_buka');
        $tutup = $request->input('tgl_tutup') . " " . $request->input('jam_tutup');

        $data = array(
            'id_jenis_kegiatan' => $request->input('option'),
            'nama_kegiatan' => $request->input('nama_kegiatan'),
            'tanggal_buka' => $buka,
            'tanggal_tutup' => $tutup,
            'masa' => $request->input('masa'),
            'user_create' => Auth::user()->name,
        );

        if ($jenis == 'save') {
            presensiModel::insert_conf($data);
            return redirect()->back()->with(['success' => ' Data berhasil tersimpan...']);
        }
        if ($jenis == 'update') {
            $id_kegiatan = decrypt($request->input('id_kegiatan'));
            presensiModel::update_conf($data,$id_kegiatan);
            return redirect()->back()->with(['success' => ' Data berhasil diperbaharui...']);
        }

    }

    public static function index_jenis()
    {

        return view('pages.presensi.presensi_home');

    }

    public static function index_laporan_daftar_peserta()
    {
        $getKegiatanAll = presensiModel::getJenisAll();
        return view('pages.presensi.presensi_laporan_daftar', compact('getKegiatanAll'));
    }

    public static function getlaporan_daftar_peserta(Request $request)
    {
        if(Auth::check()) {
            $id = $request->input('id');
            $getKegiatanAll = presensiModel::getJenisAll();
            $DaftarPeserta = presensiModel::getDaftarPeserta($id);
            return view('pages.presensi.presensi_laporan_daftar', compact('getKegiatanAll', 'DaftarPeserta'));
        } else {
            return redirect(route('presensi.dashboard'))->with(['error' => ' Silakan login terlebih dahulu']);
        }

    }

    public static function getlaporan_daftar_peserta_excel($id)
    {
        $id = decrypt($id);
//        $getKegiatanAll = presensiModel::getJenisAll();
//        $DaftarPeserta = presensiModel::getDaftarPeserta($id);
//        return view('pages.presensi.presensi_laporan_daftar_excel', compact('getKegiatanAll', 'DaftarPeserta'));
        return Excel::download(new PresensiExport($id), 'Presensi.xlsx');
    }

    public static function delete_conf($id)
    {
        $id = decrypt($id);
        try {
            presensiModel::delete_conf($id);
            return redirect()->back()->with(['success' => ' Data berhasil dihapus...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['warning' => ' Tidak dapat dihapus karena sudah ada peserta yang mengisi presensi...']);
        }

    }

    public static function hapus_peserta($id)
    {
        $id = decrypt($id);
        try {
            presensiModel::delete_peserta($id);
            return redirect()->back()->with(['success' => ' Data berhasil dihapus...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['warning' => ' Error Hapus Jenis Kegiatan...']);
        }

    }
}
