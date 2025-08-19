<?php

namespace App\Models\layanan;

use DB;
use Illuminate\Database\Eloquent\Model;

class layanan_dataKategoriModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getdataAll(){
        $sql = "SELECT * FROM kl_kategori as a order by a.nama_kategori asc";
        $results=DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function hapus($id)
    {
        DB::table('kl_kategori')
            ->where('id_kategori',$id)
            ->delete();
    }

    public static function tambah($data)
    {
        $results = DB::table('kl_kategori')
            ->insert($data);
        return $results;
    }

    public static function ubah($data,$id_kategori)
    {
        $results = DB::table('kl_kategori')
            ->where('id_kategori',$id_kategori)
            ->update($data);
        return $results;
    }
}

