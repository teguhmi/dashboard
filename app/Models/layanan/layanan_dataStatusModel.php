<?php

namespace App\Models\layanan;

use DB;
use Illuminate\Database\Eloquent\Model;

class layanan_dataStatusModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getdataAll(){
        $sql = "SELECT * FROM kl_status as pj order by pj.nama_status asc";
        $results=DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function hapus($id)
    {
        DB::table('kl_status')
            ->where('id_pj',$id)
            ->delete();
    }

    public static function tambah($data)
    {
        $results = DB::table('kl_status')
            ->insert($data);
        return $results;
    }

    public static function ubah($data,$id_pj)
    {
        $results = DB::table('kl_status')
            ->where('id_pj',$id_pj)
            ->update($data);
        return $results;
    }
}

