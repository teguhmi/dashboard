<?php

namespace App\Models\sertifikat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class sertifikat extends Model
{

    use HasFactory;

    protected $table = 'sertifikat';
    protected $fillable = [ 'id_sertifikat','nim','nama','hp','institusi','sebagai','flag'];


    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function get_data_sertifikat($id){

        $sql = "SELECT * FROM sertifikat AS a
                JOIN sertifikat_konfigurasi AS b ON a.id_sertifikat = b.id_sertifikat
                WHERE a.nama LIKE '%$id%' OR b.nama_kegiatan = '$id%' OR a.nim = '$id' ";

        $results=DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getsertifikatByID($id){

        $sql = "SELECT * FROM sertifikat AS a
                JOIN sertifikat_konfigurasi AS b ON a.id_sertifikat = b.id_sertifikat
                WHERE a.id = $id";

        $results=DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getsertifikatAll(){
        $sql = "SELECT * FROM sertifikat_konfigurasi AS a where a.flag = '1' ORDER by a.tanggal_buka DESC";

        $results=DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getsertifikatByID_Sertifikat($id){

        $sql = "SELECT * FROM sertifikat AS a
                JOIN sertifikat_konfigurasi AS b ON a.id_sertifikat = b.id_sertifikat
                WHERE a.id_sertifikat = $id";

        $results=DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function deletePeserta($id)
    {
        DB::table('sertifikat')
            ->where('id',$id)
            ->delete();
    }

    public static function deleteConf($id)
    {
        DB::table('sertifikat_konfigurasi')
            ->where('id_sertifikat',$id)
            ->delete();
    }

    public static function insert_sertifikatkonfigurasi($data)
    {

        $results = DB::table('sertifikat_konfigurasi')
            ->insertGetId($data);
        return $results;
    }

    public static function insert_sertifikatpeserta($data)
    {

        $results = DB::table('sertifikat')
            ->insert($data);
        return $results;
    }

    public static function update_sertifikatkonfigurasi($id,$data_file)
    {

        DB::table('sertifikat_konfigurasi')
            ->where('id_sertifikat', $id)
            ->update($data_file);
    }
    public static function update_datasertifikatkonfigurasi($id,$data)
    {

        DB::table('sertifikat_konfigurasi')
            ->where('id_sertifikat', $id)
            ->update($data);
    }

    public static function update_nama_file($id_sertifikat,$data)
    {
        DB::table('sertifikat_konfigurasi')
            ->where('id_sertifikat', $id_sertifikat)
            ->update($data);
    }

}

