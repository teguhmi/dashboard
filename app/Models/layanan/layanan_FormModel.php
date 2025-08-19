<?php

namespace App\Models\layanan;

use DB;
use Illuminate\Database\Eloquent\Model;

class layanan_FormModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getDPbyID($id_dp)
    {
        $sql = "SELECT dp.*, asal.nama_asal, kp.nama_kp
                FROM kl_data_dp AS dp
                JOIN kl_asal AS asal ON dp.id_asal = asal.id_asal
                JOIN kl_kp AS kp ON dp.id_kp = kp.id_kp
                WHERE dp.id_data_dp = '$id_dp'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getDPbyNotInDeskripsi()
    {
        $sql = "SELECT dp.*, asal.nama_asal, kp.nama_kp
                FROM kl_data_dp AS dp
                JOIN kl_asal AS asal ON dp.id_asal = asal.id_asal
                JOIN kl_kp AS kp ON dp.id_kp = kp.id_kp
                WHERE dp.id_data_dp not in (SELECT a.id_data_dp FROM kl_data_deskripsi as a) AND (DATE(dp.user_date_create) > '2024-07-31')
                ORDER BY dp.user_date_create asc";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getDPbyname($nama)
    {
        $sql = "SELECT dp.*, asal.nama_asal, kp.nama_kp
                FROM kl_data_dp AS dp
                JOIN kl_asal AS asal ON dp.id_asal = asal.id_asal
                JOIN kl_kp AS kp ON dp.id_kp = kp.id_kp
                WHERE dp.nama = '$nama' AND date(dp.user_date_create) = CURRENT_DATE";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }



    public static function getDeskripsibyID($id_data_dp)
    {
        $sql = "SELECT a.*, b.nama_kategori, c.nama_pj, d.*, a.id_status, e.nama_status
                FROM kl_data_deskripsi AS a
                JOIN kl_kategori AS b ON a.id_kategori = b.id_kategori
                JOIN kl_pj AS c ON a.id_pj = c.id_pj
                JOIN kl_data_dp AS d ON a.id_data_dp = d.id_data_dp
                JOIN kl_status AS e ON a.id_status = e.id_status
                WHERE a.id_data_dp= '$id_data_dp' ";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getDeskripsibyIDKategori($id_kategori,$id_data_dp)
    {

        $sql = "SELECT a.*, b.nama_kategori, c.nama_pj, d.*, a.id_status, e.nama_status
                FROM kl_data_deskripsi AS a
                JOIN kl_kategori AS b ON a.id_kategori = b.id_kategori
                JOIN kl_pj AS c ON a.id_pj = c.id_pj
                JOIN kl_data_dp AS d ON a.id_data_dp = d.id_data_dp
                JOIN kl_status AS e ON a.id_status = e.id_status
                WHERE a.id_kategori= '$id_kategori' and a.id_data_dp = '$id_data_dp'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }


    public static function tambah($data)
    {
            $results = DB::table('kl_data_dp')
                ->insertGetId($data);
        return $results;
    }

    public static function ubah($data,$id_data_dp)
    {
        $results = DB::table('kl_data_dp')
            ->where('id_data_dp',$id_data_dp)
            ->update($data);
        return $results;
    }


    public static function tambah_deskripsi($data)
    {
        $results = DB::table('kl_data_deskripsi')
            ->insert($data);
        return $results;
    }


    public static function hapusdeskripsi($id_deskripsi)
    {
        DB::table('kl_data_deskripsi')
            ->where('id_deskripsi', $id_deskripsi)
            ->delete();
    }

    public static function getJumlahTiket()
    {
        $sql = "SELECT SUM(CASE WHEN a.id_status = 1 THEN 1 ELSE 0 END) AS baru, SUM(CASE WHEN a.id_status = 2 THEN 1 ELSE 0 END) AS proses, SUM(CASE WHEN a.id_status = 3 THEN 1 ELSE 0 END) AS terjawab,SUM(CASE WHEN a.id_status = 4 THEN 1 ELSE 0 END) AS selesai FROM kl_data_deskripsi AS a";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
}

