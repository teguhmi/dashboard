<?php

namespace App\Models\layanan\mahasiswa;

use DB;
use Illuminate\Database\Eloquent\Model;

class layanan_MahasiswaModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getDataJenisLayananAll(){
        $sql = "SELECT * FROM kl_jenis_layanan as a where a.flag = '1' order by a.urutan";
        $results=DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function getLayananbyNIM($nim){
        $sql = "SELECT a.*, b.keterangan, a.keterangan as jawaban FROM kl_layanan AS a
                JOIN kl_jenis_layanan AS b ON a.id_jenis = b.id_jenis
                WHERE a.nim = '$nim' order by a.user_date_create";
        $results=DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function getLayananbyNIMmasa($nim,$masa,$jenis){
        $sql = "SELECT a.*, b.keterangan FROM kl_layanan AS a
                JOIN kl_jenis_layanan AS b ON a.id_jenis = b.id_jenis
                WHERE a.nim = '$nim' and a.masa = '$masa' and a.id_jenis = $jenis";
        $results=DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function simpan($array){
        $results = DB::table('kl_layanan')
            ->insert($array);
        return $results;
    }

    public static function getLayananbyNIMJenis($nim,$jenis){
        $sql = "SELECT a.*, b.keterangan FROM kl_layanan AS a
                JOIN kl_jenis_layanan AS b ON a.id_jenis = b.id_jenis
                WHERE a.nim = '$nim' and a.id_jenis = '$jenis' and a.status NOT IN ('selesai','gagal')";
        $results=DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function hapus($id)
    {
        DB::table('kl_layanan')
            ->where('id',$id)
            ->delete();
    }

    public static function ubah($id,$data_array)
    {
        DB::table('kl_layanan')
            ->where('id',$id)
            ->update($data_array);
    }
}

