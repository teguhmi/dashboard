<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function get_masa()
    {
        $sql = "SELECT max(a.masa) as masa from t_kalender_akademik_upbjj as a
                where a.kode_kegiatan = 'AKRG' and a.resource_id = '02'
                LIMIT 1";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function get_dp($nim)
    {
        $sql = "SELECT dp.nim, dp.nama_mahasiswa, dp.kode_program_studi, p.nama_singkat_ps,
                p.nama_program_studi, f.singkatan, f.nama_fakultas, dp.tempat_lahir_mahasiswa,
                dp.tanggal_lahir_mahasiswa, j.nama_jenjang, dp.kode_upbjj, u.nama_upbjj
                FROM m_data_pribadi AS dp
                JOIN m_program_studi AS p ON dp.kode_program_studi = p.kode_program_studi
                JOIN m_fakultas AS f ON p.kode_fakultas = f.kode_fakultas
                JOIN m_jenjang_ps AS j ON p.kode_jenjang =  j.kode_jenjang
                JOIN m_upbjj as u  ON dp.kode_upbjj = u.kode_upbjj
                WHERE dp.nim = '$nim'";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function get_yudisium($nim)
    {
        $sql = "SELECT * FROM t_yudisium AS a WHERE a.nim = '$nim'";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }
    public static function get_lip_legalisir($nim)
    {
        $sql = "SELECT a.masa, a.nobilling, a.tanggalsetor, a.totalbayar, a.kode_bank, b.nama_bank
                FROM t_billing_header AS a
                LEFT JOIN m_bank AS b ON a.kode_bank = b.kode_bank
                WHERE a.nim = '$nim' AND a.kodejenisbayar = '032' AND a.statusbank > '0' and a.kodesumberdata = '02'";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getlip($lip)
    {
        $sql = "SELECT a.masa, a.nobilling, a.tanggalsetor, a.totalbayar, a.kode_bank, b.nama_bank, a.statusbank, c.keterangan
                FROM t_billing_header AS a
                LEFT JOIN m_bank AS b ON a.kode_bank = b.kode_bank
                JOIN m_status_bank AS c ON a.statusbank = c.kode_status_bank
                WHERE a.nobilling = '$lip'";
        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function getAlamatUPBJJ($id)
    {
        $sql = "SELECT * FROM z_t_upbjj as a where a.kode_upbjj = '$id'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function getnomorsurat($idsurat)
    {
        $sql = "SELECT * FROM surat_jenis as a WHERE a.id = '$idsurat'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
}

