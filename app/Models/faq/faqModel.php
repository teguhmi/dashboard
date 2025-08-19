<?php

namespace App\Models\faq;

use DB;
use Illuminate\Database\Eloquent\Model;

class faqModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getKategoriAll()
    {
        $sql = "SELECT  * FROM faq_kategori AS a ORDER BY a.urut";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getKategoriBYid($id)
    {
        $sql = "SELECT  * FROM faq_kategori AS a where a.id_faq = '$id' ORDER BY a.urut";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getKategorisub($id)
    {
        $sql = "SELECT  * FROM faq_kategori_sub AS a where a.id_faq = '$id' ORDER BY a.id_faq_sub";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));

        return $results;
    }
    public static function getKategori()
    {
        $sql = "SELECT DISTINCT a.id_faq, b.keterangan, b.icon
                FROM faq_deskripsi  AS a JOIN faq_kategori AS b ON a.id_faq = b.id_faq ORDER BY b.urut";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }
    public static function getMedsos()
    {
        $sql = "SELECT  * FROM media_sosial AS a ORDER BY a.nama_medsos asc";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }
    public static function getFAQAll()
    {
        $sql = "SELECT a.*, b.keterangan FROM faq_deskripsi  AS a JOIN faq_kategori AS b ON a.id_faq = b.id_faq
               ORDER BY a.id_faq , a.urut ";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getFAQbyID($id)
    {

        $sql = "SELECT a.*, b.keterangan FROM faq_deskripsi  AS a JOIN faq_kategori AS b ON a.id_faq = b.id_faq
                WHERE a.id_faq = '$id' ORDER BY a.id_faq, a.urut ";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

//    public static function getFAQby_ID($id)
//    {
//
//        $sql = "SELECT a.*, b.keterangan FROM faq_deskripsi  AS a JOIN faq_kategori AS b ON a.id_faq = b.id_faq
//                WHERE a.id = '$id' ORDER BY a.id_faq , a.urut ";
//        $results = DB::connection(self::$db)
//            ->select(DB::raw($sql));
//        return $results;
//
//    }
//    public static function getFAQ($id)
//    {
//        $sql = "SELECT a.*, b.keterangan FROM faq_deskripsi  AS a JOIN faq_kategori AS b ON a.id_faq = b.id_faq
//                WHERE a.id_faq = '$id' ORDER BY a.id_faq , a.urut";
//        $results = DB::connection(self::$db)
//            ->select(DB::raw($sql));
//        return $results;
//
//    }


    public static function getUrut($id)
    {
        #$id = decrypt($id);
        $sql = "SELECT MAX(a.urut) AS urut FROM faq_deskripsi AS a WHERE a.id_faq = '$id' LIMIT 1";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function hapus_deskripsi($id) {
        DB::table('faq_deskripsi')
            ->where('id',$id)
            ->delete();
    }

    public static function update_deskripsi($id,$data_array) {
        DB::table('faq_deskripsi')
            ->where('id',$id)
            ->update($data_array);

    }

    public static function simpan_deskripsi($data_array){
        DB::table('faq_deskripsi')
            ->insert($data_array);
    }
}

