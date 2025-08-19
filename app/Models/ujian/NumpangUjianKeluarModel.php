<?php

namespace App\Models\ujian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class NumpangUjianKeluarModel extends Model
{
    use HasFactory;
    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getPesertaUjian($nim, $masa)
    {

        $sql = "SELECT a.masa,  b.kode_upbjj AS ujian_kode_upbjj, a.kode_tempat_ujian, b.nama_wilayah_ujian, a.hari, a.nim,
                 a.kode_mtk_1, a.kode_mtk_2,a.kode_mtk_3,a.kode_mtk_4,a.kode_mtk_5
                FROM tmp_proses_d20an_biner_tunggal AS a
                JOIN m_wilayah_ujian as b ON a.kode_tempat_ujian = b.kode_wilayah_ujian
                JOIN  m_data_pribadi AS dp ON dp.nim = a.nim
                JOIN m_program_studi AS p ON dp.kode_program_studi = p.kode_program_studi
                JOIN m_upbjj AS u ON dp.kode_upbjj = u.kode_upbjj
                WHERE a.masa = '$masa' AND a.nim = '$nim' AND b.status_aktif = '1'
                ORDER BY a.masa, a.hari asc";

//        $sql = "SELECT a.masa, a.hari,
//                (SELECT j1.kode_mtk FROM ujian_numpang AS j1 WHERE j1.jam_ujian = 1 AND j1.hari = a.hari) AS kode_mtk_1,
//                (SELECT j1.kode_mtk FROM ujian_numpang AS j1 WHERE j1.jam_ujian = 2 AND j1.hari = a.hari) AS kode_mtk_2,
//                (SELECT j1.kode_mtk FROM ujian_numpang AS j1 WHERE j1.jam_ujian = 3 AND j1.hari = a.hari) AS kode_mtk_3,
//                (SELECT j1.kode_mtk FROM ujian_numpang AS j1 WHERE j1.jam_ujian = 4 AND j1.hari = a.hari) AS kode_mtk_4,
//                (SELECT j1.kode_mtk FROM ujian_numpang AS j1 WHERE j1.jam_ujian = 5 AND j1.hari = a.hari) AS kode_mtk_5
//                FROM ujian_numpang AS a
//                GROUP BY a.hari,a.masa";
        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function get_DataNumpang_ujian($nim, $masa)
    {
        $sql = "SELECT * FROM ujian_numpang AS a
                JOIN ujian_numpang as b on a.nim = b.nim and a.masa = b.masa
                WHERE a.masa = '$masa' AND a.nim = '$nim' ";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getMasaUjian()
    {

        $sql = "SELECT MAX(masa) AS masa FROM tmp_proses_d20an_biner_tunggal";
        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function insert($data_array)
    {

        $results = DB::table('ujian_numpang')
            ->insert($data_array);
        return $results;
    }

    public static function insertTPUTujuan($data_array)
    {

        $results = DB::table('ujian_numpang_tpu')
            ->insert($data_array);
        return $results;
    }

    public static function insertNomorSurat($data_array)
    {

        $results = DB::table('ujian_numpang_surat')
            ->insert($data_array);
        return $results;
    }

    public static function updateTPUTujuan($id, $data_array)
    {
        DB::table('ujian_numpang_tpu')
            ->where('id', $id)
            ->update($data_array);
    }

    public static function hapus_mtk($id)
    {
        DB::table('ujian_numpang')
            ->where('id', $id)
            ->delete();
    }

    public static function hapus_mtk_all($nim, $masa)
    {
        DB::table('ujian_numpang')
            ->where('nim', $nim)
            ->where('masa', $masa)
            ->delete();
    }

    public static function hapus_tpu($id)
    {
        DB::table('ujian_numpang_tpu')
            ->where('id', $id)
            ->delete();
    }

    public static function cekData($nim, $masa)
    {

        $sql = "SELECT  * from ujian_numpang as a where a.nim = '$nim' and a.masa = '$masa'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function cekTPUTujuan($masa, $nim, $hari)
    {
        $sql = "SELECT * from ujian_numpang_tpu as a where a.masa = '$masa' and a.nim = '$nim' and a.hari = '$hari'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getTPU($upbjj)
    {

        $sql = "SELECT  * from m_wilayah_ujian as a where a.kode_upbjj = '$upbjj' and a.status_aktif = '1'";
        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getTPUTujuan($masa, $nim)
    {
        $sql = "SELECT * from ujian_numpang_tpu as a where a.masa = '$masa' and a.nim = '$nim'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getDataNumpagUjian($nim, $masa)
    {
//        $sql = "SELECT a.id, a.masa, a.nim, a.hari, a.jam_ujian, a.kode_mtk, a.kode_upbjj_ujian_asal,
//                a.nama_wilayah_ujian_asal, b.kode_tempat_ujian_tujuan, b.nama_wilayah_ujian_tujuan
//                FROM ujian_numpang AS a
//                JOIN ujian_numpang_tpu as b on a.nim = b.nim and a.masa = b.masa AND a.hari = b.hari
//                WHERE a.masa = '$masa' AND a.nim = '$nim'
//                GROUP BY a.id, a.masa, a.nim, a.hari, a.jam_ujian, a.kode_mtk, a.kode_upbjj_ujian_asal, a.nama_wilayah_ujian_asal,b.kode_tempat_ujian_tujuan,b.nama_wilayah_ujian_tujuan";
        $sql = "SELECT a.masa, a.hari, c.kode_upbjj_ujian_tujuan, c.nama_upbjj_ujian_tujuan, c.kode_tempat_ujian_tujuan, c.nama_wilayah_ujian_tujuan,
                (SELECT j1.kode_mtk FROM ujian_numpang AS j1 WHERE j1.jam_ujian = 1 AND j1.hari = a.hari AND j1.nim = a.nim AND j1.masa = a.masa) AS kode_mtk_1,
                (SELECT j1.kode_mtk FROM ujian_numpang AS j1 WHERE j1.jam_ujian = 2 AND j1.hari = a.hari AND j1.nim = a.nim AND j1.masa = a.masa) AS kode_mtk_2,
                (SELECT j1.kode_mtk FROM ujian_numpang AS j1 WHERE j1.jam_ujian = 3 AND j1.hari = a.hari AND j1.nim = a.nim AND j1.masa = a.masa) AS kode_mtk_3,
                (SELECT j1.kode_mtk FROM ujian_numpang AS j1 WHERE j1.jam_ujian = 4 AND j1.hari = a.hari AND j1.nim = a.nim AND j1.masa = a.masa) AS kode_mtk_4,
                (SELECT j1.kode_mtk FROM ujian_numpang AS j1 WHERE j1.jam_ujian = 5 AND j1.hari = a.hari AND j1.nim = a.nim AND j1.masa = a.masa) AS kode_mtk_5
                FROM ujian_numpang AS a
                JOIN ujian_numpang_tpu AS c ON a.nim = c.nim AND a.hari = c.hari
                WHERE a.masa = '$masa' AND a.nim = '$nim'
                GROUP BY a.nim,a.masa, a.hari, c.kode_upbjj_ujian_tujuan, c.nama_upbjj_ujian_tujuan, c.kode_tempat_ujian_tujuan, c.nama_wilayah_ujian_tujuan";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function getnomorsurat($masa,$nim,$id)
    {
        $sql = "SELECT a.*, b.nama_surat FROM ujian_numpang_surat as a
                JOIN surat_jenis AS b on a.id_surat = b.id
                WHERE a.masa = '$masa' AND a.nim = '$nim' AND a.id_surat = '$id'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function getMasa($masa){
        $sql = "SELECT DISTINCT a.masa
                FROM ujian_numpang_surat as a
                WHERE a.masa = '$masa' ";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function get_DataNumpangUjian($id){
        $sql = "SELECT DISTINCT  a.masa, a.nim, a.nomor_surat, b.kode_upbjj_ujian_tujuan, b.nama_upbjj_ujian_tujuan,
                b.nama_wilayah_ujian_tujuan,  a.user_create
                FROM ujian_numpang_surat AS a
                JOIN ujian_numpang_tpu AS b ON a.nim = b.nim AND a.masa = b.masa
                WHERE a.masa = '$id' ";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
}
