<?php

namespace App\Models\layanan\orientasi;

use DB;
use Illuminate\Database\Eloquent\Model;

class layanan_OrientasiModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function dp_mahasiswa()
    {
        $sql = "SELECT * FROM m_data_pribadi as a WHERE a.kode_jenis_program IS null LIMIT 250";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function update_m_data_pribadi($nim,$data_array)
    {
        $results = DB::table('m_data_pribadi')
            ->where('nim', $nim)
            ->update($data_array);
        return $results;
    }
}

