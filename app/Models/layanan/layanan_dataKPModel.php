<?php

namespace App\Models\layanan;

use DB;
use Illuminate\Database\Eloquent\Model;

class layanan_dataKPModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getdataAll(){
        $sql = "SELECT * FROM kl_kp as kp order by kp.nama_kp asc";
        $results=DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function hapus($id)
    {
        DB::table('kl_kp')
            ->where('id_kp',$id)
            ->delete();
    }

    public static function tambah($data)
    {
        $results = DB::table('kl_kp')
            ->insert($data);
        return $results;
    }

    public static function ubah($data,$id_kp)
    {
        $results = DB::table('kl_kp')
            ->where('id_kp',$id_kp)
            ->update($data);
        return $results;
    }
}

