<?php

namespace App\Models\srs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class QueryDatabaseDashboard extends Model
{

    use HasFactory;
    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function Get_LaporanAduan($jenis, $status)
    {
        $sql = "SELECT a.*, b.jenis, b.keterangan, a.keterangan as jawaban
                FROM kl_layanan AS a
                JOIN kl_jenis_layanan as b on a.id_jenis = b.id_jenis
                WHERE a.id_jenis = '$jenis' and a.status = '$status'  ORDER BY a.user_date_create";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function Get_LaporanAduan_By_ID($id)
    {
        $sql = "SELECT a.*, b.jenis, b.keterangan, a.keterangan as jawaban
                FROM kl_layanan AS a
                JOIN kl_jenis_layanan as b on a.id_jenis = b.id_jenis
                WHERE a.id = '$id' ";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function Get_JenisAduan()
    {
        $sql = "SELECT * FROM kl_jenis_layanan AS a WHERE a.flag = 1 ORDER BY a.jenis asc";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function Get_StatusAduan()
    {
        $sql = "SELECT * FROM kl_status AS a ORDER BY a.nama_status";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function ubah($id, $data_array)
    {
        $results = DB::table('kl_layanan')
            ->where('id', $id)
            ->update($data_array);
        return $results;

    }
}


