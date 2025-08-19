<?php

namespace App\Models\layanan\mahasiswa;

use DB;
use Illuminate\Database\Eloquent\Model;

class layanan_wifiIDModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getPermohonanwifiIDbyStatus($status)
    {
        $sql = "SELECT a.*,b.jenis, b.keterangan FROM kl_layanan AS a
                JOIN kl_jenis_layanan AS b ON a.id_jenis = b.id_jenis
                WHERE a.status = '$status' and a.id_jenis = '2'
                order by a.user_date_create asc";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getPermohonanwifiIDbynim($nim)
    {
        $sql = "SELECT a.*,b.jenis, b.keterangan FROM kl_layanan AS a
                JOIN kl_jenis_layanan AS b ON a.id_jenis = b.id_jenis
                WHERE a.nim = '$nim' and a.id_jenis = '2'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function update_password($data, $nim, $masa)
    {
        $results = DB::table('kl_layanan')
            ->where('masa', $masa)
            ->where('nim', $nim)
            ->where('id_jenis', '2')
            ->update($data);
        return $results;
    }
    public static function update_idWA($data, $nim, $masa)
    {
        $results = DB::table('kl_layanan')
            ->where('masa', $masa)
            ->where('nim', $nim)
            ->where('id_jenis', '2')
            ->update($data);
        return $results;
    }
}

