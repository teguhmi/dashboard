<?php

namespace App\Models\layanan;

use DB;
use Illuminate\Database\Eloquent\Model;

class layanan_LaporanBBModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getDataAll()
    {
        $sql = "SELECT date(a.deskripsi_user_date) AS tanggal, a.id_deskripsi, al.nama_asal, dp.nim, dp.nama, a.deskripsi, pj.nama_pj, a.target_selesai, a.jawaban, a.jawaban_user_date, a.id_status, s.nama_status
                FROM kl_data_deskripsi AS a
                JOIN kl_data_dp AS dp ON a.id_data_dp = dp.id_data_dp
                JOIN kl_asal AS al ON dp.id_asal = al.id_asal
                JOIN kl_pj AS pj ON a.id_pj = pj.id_pj
                JOIN kl_status AS s ON a.id_status = s.id_status";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }


}

