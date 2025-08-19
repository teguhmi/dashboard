<?php

namespace App\Models\ujian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class NumpangUjianMasukModel extends Model
{
    use HasFactory;
    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getPesertaUjian($nim, $masa)
    {

        $sql = "SELECT a.masa,  b.kode_upbjj AS ujian_kode_upbjj, a.kode_tempat_ujian, b.nama_wilayah_ujian, a.hari, a.nim, dp.nama_mahasiswa,
                dp.kode_upbjj AS dp_kode_upbjj, u.nama_upbjj AS dp_nama_upbjj,dp.kode_program_studi, p.nama_singkat_ps, a.kode_mtk_1, a.kode_mtk_2,a.kode_mtk_2,a.kode_mtk_4,a.kode_mtk_5,
                b.kode_upbjj AS kodeupbjj_wilayah_ujian
                FROM tmp_proses_d20an_biner_tunggal AS a
                JOIN m_wilayah_ujian as b ON a.kode_tempat_ujian = b.kode_wilayah_ujian
                JOIN  m_data_pribadi AS dp ON dp.nim = a.nim
                JOIN m_program_studi AS p ON dp.kode_program_studi = p.kode_program_studi
                JOIN m_upbjj AS u ON dp.kode_upbjj = u.kode_upbjj
                WHERE a.masa = '$masa' AND a.nim = '$nim' AND b.status_aktif = '1'
                ORDER BY a.masa DESC";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getmasaujian()
    {
        $sql = "SELECT DISTINCT a.masa FROM ujian_numpang_tpu AS a ORDER BY a.masa DESC";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getjumlahmatakuliahujianmasuk($masaujian, $jenis, $tanggalawal, $tanggalakhir)
    {
        $sql = "SELECT a.masa, tpu.nama_upbjj_ujian_tujuan AS nama_upbjj, tpu.kode_tempat_ujian_tujuan AS kode_tpu, tpu.nama_wilayah_ujian_tujuan AS nama_tpu, a.kode_mtk, COUNT(a.nim) AS total
                FROM ujian_numpang AS a
                JOIN ujian_numpang_tpu AS tpu ON a.masa = tpu.masa AND a.nim = tpu.nim and a.hari = tpu.hari
                WHERE a.masa = '$masaujian' AND a.jenis = '$jenis' AND DATE(a.user_date_create) BETWEEN '$tanggalawal' AND '$tanggalakhir'
                GROUP BY  a.masa, tpu.nama_upbjj_ujian_tujuan, tpu.kode_tempat_ujian_tujuan, a.nama_wilayah_ujian_tujuan, a.kode_mtk,tpu.nama_wilayah_ujian_tujuan
                ORDER BY tpu.kode_tempat_ujian_tujuan, a.kode_mtk";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getdaftarmatakuliahujianmasuk($masaujian, $jenis, $tanggalawal, $tanggalakhir)
    {
        $sql = " SELECT a.masa, a.nim, b.nama_mahasiswa, a.kode_mtk,  a.hari, a.jam_ujian, a.kode_upbjj_ujian_asal, a.nama_wilayah_ujian_asal,
                b.kode_upbjj_ujian_tujuan, b.nama_wilayah_ujian_tujuan, a.jenis
                FROM ujian_numpang AS a
                JOIN ujian_numpang_tpu AS b ON a.masa = b.masa AND a.nim = b.nim AND a.hari = b.hari
                WHERE a.masa = '$masaujian' AND a.jenis = '$jenis' AND DATE(a.user_date_create) BETWEEN '$tanggalawal' AND '$tanggalakhir' and a.hari = b.hari
                ORDER BY  b.kode_tempat_ujian_tujuan, b.nama_mahasiswa, a.kode_mtk";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

}
