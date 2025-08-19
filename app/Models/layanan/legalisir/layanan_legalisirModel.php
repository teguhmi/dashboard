<?php

namespace App\Models\layanan\legalisir;

use DB;
use Illuminate\Database\Eloquent\Model;

class layanan_legalisirModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getTransaksiLegalisir($nim)
    {
        $sql = "SELECT * FROM legalisir AS a WHERE  DATE(a.user_date_create) = DATE(NOW()) AND a.nim = '$nim' ORDER BY a.user_date_create DESC";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function BuatNotaLegalisir($id)
    {
        $sql = "SELECT IFNULL(MAX(substr(id_nota,5)), 0) + 1 AS urut from legalisir
	                  where left(id_nota,4) = '$id' limit 1";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function GetNotaLegalisir($id)
    {
        $sql = "SELECT * FROM legalisir as a where a.id = '$id'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function simpan($data)
    {
        $results = DB::table('legalisir')
            ->insert($data);
        return $results;
    }
    public static function hapus($id)
    {
        DB::table('legalisir')
            ->where('id', $id)
            ->delete();
    }
}

