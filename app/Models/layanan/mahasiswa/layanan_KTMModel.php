<?php

namespace App\Models\layanan\mahasiswa;

//use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class layanan_KTMModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getPermohonanKTMbyStatus($status){
        $sql = "SELECT a.*,b.jenis, b.keterangan FROM kl_layanan AS a
                JOIN kl_jenis_layanan AS b ON a.id_jenis = b.id_jenis
                WHERE a.status = '$status' and a.id_jenis = '1'";
        $results=DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function update_ktm($id,$data_array)
    {
        $results = DB::table('kl_layanan')
            ->where('id', $id)
            ->update($data_array);
        return json_decode($results);
    }
}

