<?php

namespace App\Models\layanan;

use DB;
use Illuminate\Database\Eloquent\Model;

class layanan_dataPJModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getdataAll(){
        $sql = "SELECT * FROM kl_pj as pj order by pj.nama_pj asc";
        $results=DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function hapus($id)
    {
        DB::table('kl_pj')
            ->where('id_pj',$id)
            ->delete();
    }

    public static function tambah($data)
    {
        $results = DB::table('kl_pj')
            ->insert($data);
        return $results;
    }

    public static function ubah($data,$id_pj)
    {
        $results = DB::table('kl_pj')
            ->where('id_pj',$id_pj)
            ->update($data);
        return $results;
    }
}

