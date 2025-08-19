<?php

namespace App\Models\view;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class SuratModel extends Model
{
    use HasFactory;
    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getnumpang($id)
    {

        $sql = "select * from ujian_numpang_surat as a where a.id = '$id'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }
    public static function getjenissurat($id_surat)
    {

        $sql = "select * from surat_jenis as a where a.id = '$id_surat'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

}
