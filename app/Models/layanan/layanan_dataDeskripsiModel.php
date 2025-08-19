<?php

namespace App\Models\layanan;

use DB;
use Illuminate\Database\Eloquent\Model;

class layanan_dataDeskripsiModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';


    public static function getdeskripsiByCurrentDate()
    {
        $sql = "SELECT ds.id_deskripsi, ds.id_data_dp, dp.nama, pj.nama_pj, kt.nama_kategori, ds.deskripsi, ds.id_status, st.nama_status, dp.user_create, st.icon
                , ds.deskripsi_user_create, deskripsi_user_date
                FROM kl_data_deskripsi AS ds
                JOIN kl_data_dp AS dp ON dp.id_data_dp = ds.id_data_dp
                JOIN kl_pj AS pj ON ds.id_pj = pj.id_pj
                JOIN kl_kategori AS kt ON ds.id_kategori = kt.id_kategori
                JOIN kl_status AS st ON ds.id_status = st.id_status
                WHERE date(dp.user_date_create) = CURRENT_DATE
                ORDER BY dp.user_date_create asc";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getdeskripsiByStatus($id_status)
    {
        $sql = "SELECT ds.id_deskripsi, ds.id_data_dp, dp.nama, pj.nama_pj, kt.nama_kategori, ds.deskripsi, dp.id_status, st.nama_status, dp.user_create, st.icon
                FROM kl_data_deskripsi AS ds
                JOIN kl_data_dp AS dp ON dp.id_data_dp = ds.id_data_dp
                JOIN kl_pj AS pj ON ds.id_pj = pj.id_pj
                JOIN kl_kategori AS kt ON ds.id_kategori = kt.id_kategori
                JOIN kl_status AS st ON ds.id_status = st.id_status
                WHERE ds.id_status = '$id_status'
                ORDER BY dp.user_date_create asc";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getdeskripsiAll()
    {
        $sql = "SELECT ds.id_deskripsi, ds.id_data_dp, dp.nama, pj.nama_pj, kt.nama_kategori, ds.deskripsi, ds.id_status, st.nama_status, dp.user_create
                ,ds.deskripsi_user_create, ds.deskripsi_user_date
                ,ds.penyebab, ds.penyebab_user_create, ds.penyebab_user_date
                ,ds.jawaban, ds.jawaban_user_create, ds.jawaban_user_date, st.icon
                FROM kl_data_deskripsi AS ds
                JOIN kl_data_dp AS dp ON dp.id_data_dp = ds.id_data_dp
                JOIN kl_pj AS pj ON ds.id_pj = pj.id_pj
                JOIN kl_kategori AS kt ON ds.id_kategori = kt.id_kategori
                JOIN kl_status AS st ON ds.id_status = st.id_status
                WHERE ds.id_status NOT IN ('4') order by ds.deskripsi_user_date desc";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }


    public static function getdeskripsiIDDeskripsi($id_deskripsi,$id_data_dp)
    {
        $sql = "SELECT ds.id_deskripsi, ds.id_data_dp, dp.nama, pj.nama_pj, kt.nama_kategori, ds.deskripsi, ds.id_status, st.nama_status, dp.user_create
                ,ds.deskripsi_user_create, ds.deskripsi_user_date
                ,ds.penyebab, ds.penyebab_user_create, ds.penyebab_user_date
                ,ds.jawaban, ds.jawaban_user_create, ds.jawaban_user_date, st.icon
                FROM kl_data_deskripsi AS ds
                JOIN kl_data_dp AS dp ON dp.id_data_dp = ds.id_data_dp
                JOIN kl_pj AS pj ON ds.id_pj = pj.id_pj
                JOIN kl_kategori AS kt ON ds.id_kategori = kt.id_kategori
                JOIN kl_status AS st ON ds.id_status = st.id_status
                WHERE ds.id_deskripsi = '$id_deskripsi' AND ds.id_data_dp = '$id_data_dp'";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }



    public static function updateTabelDeskripsi($id_deskripsi, $data) {
        $results = DB::table('kl_data_deskripsi')
            ->where('id_deskripsi',$id_deskripsi)
            ->update($data);
        return $results;
    }

    public static function updateTabelDeskripsistatus($id_deskripsi, $data) {
        $results = DB::table('kl_data_deskripsi')
            ->where('id_deskripsi',$id_deskripsi)
            ->update($data);
        return $results;
    }


}

