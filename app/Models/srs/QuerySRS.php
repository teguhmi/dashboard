<?php

namespace App\Models\srs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class QuerySRS extends Model
{
    use HasFactory;
    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getDPbyNIM($nim){

        $sql = "SELECT dp.nim, dp.nama_mahasiswa, dp.kode_upbjj, u.nama_upbjj
                FROM m_data_pribadi AS dp
                JOIN m_upbjj AS u ON dp.kode_upbjj = u.kode_upbjj
                WHERE dp.nim = '$nim'";

        $results=DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getDPbyNIMTgllahir($nim,$tgl_lahir){

        $sql = "SELECT dp.nim, dp.nama_mahasiswa, dp.kode_upbjj, u.nama_upbjj, dp.masa_registrasi_awal, dp.kode_program_studi, p.nama_program_studi
                FROM m_data_pribadi AS dp
                JOIN m_upbjj AS u ON dp.kode_upbjj = u.kode_upbjj
                JOIN m_program_studi as p on dp.kode_program_studi = p.kode_program_studi

                WHERE dp.nim = '$nim' and dp.tanggal_lahir_mahasiswa = '$tgl_lahir'";

        $results=DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getkopsurat(){

        $sql = "select * from z_kop_surat";

        $results=DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

}
