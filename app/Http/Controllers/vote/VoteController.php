<?php

namespace App\Http\Controllers\vote;

use App\Http\Controllers\Controller;
use App\Http\Controllers\srs\QuerySRSController;
use App\Http\Controllers\tools\network;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VoteController extends Controller
{
    public function index()
    {
        $kandidat = self::get_vote_konfigurasi();

        return view('pages.vote.vote', compact('kandidat'));
    }

    public function reload($pesan)
    {
        if (empty($pesan)) {
            $pesan = '';
        }
        $kandidat = self::get_vote_konfigurasi();
        return view('pages.vote.vote', compact('kandidat', 'pesan'));
    }

    public function get_vote_konfigurasi()
    {
        $results = DB::connection()
            ->table('vote_konfigurasi as a')
            ->orderBy('a.id')
            ->get();
        return json_decode($results);
    }

    public function simpan(Request $request)
    {
        $buka = date('2025-02-13');
        $today = Carbon::today()->toDateString();
        $warning = '';
        $ipaddress = explode(',', network::getIP());
        $boleh = array('DA', 'DN', 'DS');

        if ($today == $buka) {
            $nim = $request->input('nim');
            $tanggal_lahir = $request->input('tanggal_lahir');
            $kandidat = $request->input('kandidat');
            $DPMahasiswa = QuerySRSController::getdpbynim($nim);
            if (empty($DPMahasiswa) || $DPMahasiswa['tanggal_lahir_mahasiswa'] != $tanggal_lahir) {
                $pesan = 'Data Mahasiswa tidak ditemukan';
            } elseif ($DPMahasiswa['kode_upbjj'] != '44') {
                $pesan = 'Bukan Mahasiswa UT Surakarta';
            } elseif (!in_array($DPMahasiswa['status_dp'], $boleh))   {
                $pesan = 'Bukan Mahasiswa Aktif';
            } else {
                $warning = 'gradient-45deg-green-teal';
                $data_array = array(
                    'nim' => $nim,
                    'nama' => $DPMahasiswa['nama_mahasiswa'],
                    'id_vote' => $kandidat,
                    'ip' => $ipaddress[0]
                );
                $cek_data = DB::connection()->table('vote_data')->where('nim', $nim)->get();
                $hasil = json_decode($cek_data);
                if (empty($hasil)) {
                    $simpan = DB::table('vote_data')->insertGetId($data_array);
                    if (empty($simpan)) {
                        $pesan = 'Gagal menyimpan data..';
                    } else {
                        $pesan = 'Data Tersimpan';
                    }
                } else {
                    $pesan = $DPMahasiswa['nama_mahasiswa'] . ' sudah melakukan pemilihan';
                }
            }
        } else {
            $pesan = 'Pemilihan belum dibuka';
        }
        $kandidat = self::get_vote_konfigurasi();
        return view('pages.vote.vote', compact('kandidat', 'pesan', 'warning'));
    }
}
