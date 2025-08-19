<?php

namespace App\Models\layanan;

use DB;
use Illuminate\Database\Eloquent\Model;

class layanan_dataAsalModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getdataAll(){
        $sql = "SELECT * FROM kl_asal as a order by a.nama_asal asc";
        $results=DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function hapus($id)
    {
        DB::table('kl_asal')
            ->where('id_asal',$id)
            ->delete();
    }

    public static function tambah($data)
    {
        $results = DB::table('kl_asal')
            ->insert($data);
        return $results;
    }

    public static function ubah($data,$id_asal)
    {
        $results = DB::table('kl_asal')
            ->where('id_asal',$id_asal)
            ->update($data);
        return $results;
    }
}

