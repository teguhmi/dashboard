<?php

namespace App\Models\angket;

use DB;
use Illuminate\Database\Eloquent\Model;

class angketetmModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getAngketETM()
    {
        $sql = "SELECT a.id_data_angket, a.id_jenis_angket, b.keterangan, a.nomor, a.pertanyaan
                FROM angket_data AS a
                JOIN angket_jenis AS b ON a.id_jenis_angket = b.id_jenis_angket
                WHERE a.id_jenis_angket = '1'";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }
    public static function getAngketpola()
    {
        $sql = "SELECT a.`key`,a.keterangan FROM angket_pola_jawab AS a WHERE a.id_jenis_angket = '1'";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function simpanAngketJawab($data)
    {

        DB::table('angket_jawaban')->insert($data);

    }

    public static function cekjawaban($idkelas, $nim, $idjenisangket,$masa)
    {

        $sql = "SELECT * from angket_jawaban as a where a.nim = '$nim' and a.kelas = '$idkelas' and a.id_jenis_angket = '$idjenisangket' and a.masa =  '$masa'";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function cek_angket($masa, $nim,$kodemtk, $jenis)
    {

        $sql = "SELECT * from angket_jawaban as a where a.nim = '$masa' and a.nim = '$nim' and a.kode_mtk = '$kodemtk' and a.id_jenis_angket = $jenis";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

}

