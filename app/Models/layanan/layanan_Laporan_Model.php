<?php

namespace App\Models\layanan;

use DB;
use Illuminate\Database\Eloquent\Model;

class layanan_Laporan_Model extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getDataByDateBetween($awal, $akhir)
    {
        $sql = "SELECT date(a.deskripsi_user_date) AS tanggal, a.id_deskripsi, al.nama_asal, dp.nim, dp.nama
                , a.deskripsi, pj.nama_pj, a.target_selesai, a.jawaban, a.jawaban_user_date, a.jawaban_user_create
                , a.id_status, s.nama_status,dp.id_data_dp, a.status_user_date, s.icon
                FROM kl_data_deskripsi AS a
                JOIN kl_data_dp AS dp ON a.id_data_dp = dp.id_data_dp
                JOIN kl_asal AS al ON dp.id_asal = al.id_asal
                JOIN kl_pj AS pj ON a.id_pj = pj.id_pj
                JOIN kl_status AS s ON a.id_status = s.id_status
                WHERE date(a.deskripsi_user_date) BETWEEN $awal AND '$akhir'
                ORDER BY a.id_deskripsi asc";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getDataStatus()
    {
        $sql = "SELECT * FROM kl_status as a ORDER BY a.nama_status asc";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getDataByDate($awal, $akhir)
    {
        $sql = "SELECT date(a.deskripsi_user_date) AS tanggal, a.id_deskripsi, al.nama_asal, dp.nim, dp.nama
                , a.deskripsi, pj.nama_pj, a.target_selesai, a.jawaban, a.jawaban_user_date, a.jawaban_user_create
                , a.id_status, s.nama_status,s.icon,dp.id_data_dp, a.status_user_date
                FROM kl_data_deskripsi AS a
                JOIN kl_data_dp AS dp ON a.id_data_dp = dp.id_data_dp
                JOIN kl_asal AS al ON dp.id_asal = al.id_asal
                JOIN kl_pj AS pj ON a.id_pj = pj.id_pj
                JOIN kl_status AS s ON a.id_status = s.id_status
                WHERE DATE(a.deskripsi_user_date) BETWEEN '$awal' AND '$akhir'
                order by a.id_deskripsi asc";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getDataByStatus($status)
    {
        $sql = "SELECT date(a.deskripsi_user_date) AS tanggal, a.id_deskripsi, al.nama_asal, dp.nim, dp.nama
                , a.deskripsi, pj.nama_pj, a.target_selesai, a.jawaban, a.jawaban_user_date
                , a.id_status, s.nama_status,s.icon,dp.id_data_dp, a.status_user_date
                FROM kl_data_deskripsi AS a
                JOIN kl_data_dp AS dp ON a.id_data_dp = dp.id_data_dp
                JOIN kl_asal AS al ON dp.id_asal = al.id_asal
                JOIN kl_pj AS pj ON a.id_pj = pj.id_pj
                JOIN kl_status AS s ON a.id_status = s.id_status
                WHERE a.id_status = '$status'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getUser()
    {
        $sql = "SELECT  u.name FROM users AS u WHERE u.name IN (SELECT a.deskripsi_user_create  FROM kl_data_deskripsi AS a)
                OR u.name IN (SELECT a.jawaban_user_create  FROM kl_data_deskripsi AS a)
                OR u.name IN (SELECT a.penyebab_user_create  FROM kl_data_deskripsi AS a)
                OR u.name IN (SELECT a.status_user_create  FROM kl_data_deskripsi AS a)
                ";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }


    public static function getJumlahDeskripsiBulan()
    {
        $sql = "SELECT MONTH(a.deskripsi_user_date) AS bulan,
MONTHNAME(a.deskripsi_user_date) AS namabulan,
a.deskripsi_user_create
FROM kl_data_deskripsi AS a";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }


}

