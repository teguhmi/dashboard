<?php

namespace App\Models\angket;

use DB;
use Illuminate\Database\Eloquent\Model;

class angketetuModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getAngketETU()
    {
        $sql = "SELECT a.id_data_angket, a.id_jenis_angket, b.keterangan, a.nomor, a.pertanyaan
                FROM angket_data AS a
                JOIN angket_jenis AS b ON a.id_jenis_angket = b.id_jenis_angket
                WHERE a.id_jenis_angket = '2'";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }
    public static function getAngketpola()
    {
        $sql = "SELECT a.`key`,a.keterangan FROM angket_pola_jawab AS a WHERE a.id_jenis_angket = '2' order by a.key asc";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getAngketJawaban($masa,$idtutor,$kodemtk)
    {
        $sql = "SELECT * FROM angket_jawaban AS a WHERE  a.id_jenis_angket = '2'
                AND a.masa = '$masa' AND a.idtutor = '$idtutor' AND a.kode_mtk = '$kodemtk'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }
    public static function getAngketJawabanSaran($etu)
    {
        $sql = "SELECT * FROM angket_jawaban_saran AS a WHERE a.kelas = '$etu' and a.id_jenis_angket = '2'";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function simpanAngketJawab($data)
    {

        DB::table('angket_jawaban')->insert($data);

    }

    public static function simpanAngketJawabSaran($data)
    {

        DB::table('angket_jawaban_saran')->insert($data);

    }

    public static function cekjawaban($idkelas,$idtutor,$idjenisangket,$masa)
    {

        $sql = "SELECT * from angket_jawaban as a where a.idtutor = '$idtutor' and a.kelas = '$idkelas' and a.id_jenis_angket = '$idjenisangket' and a.masa =  '$masa' ";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getetuHasil($masa,$idtutor,$kodemtk)
    {
        $sql = "SELECT * FROM angket_jawaban AS a
                join angket_data AS b ON a.id_jenis_angket = b.id_jenis_angket AND a.nomor_soal = b.nomor
                WHERE a.id_jenis_angket = '2'
                AND a.masa = '$masa'
                AND a.idtutor = '$idtutor'
                AND a.kode_mtk = '$kodemtk'
                ";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function HapusETU($masa,$idtutor,$kodemtk)
    {

        DB::table('angket_jawaban_saran')
            ->where('masa',$masa)
            ->where('idtutor',$idtutor)
            ->where('kode_mtk',$kodemtk)
            ->where('id_jenis_angket', 2)
            ->delete();

        DB::table('angket_jawaban')
            ->where('masa',$masa)
            ->where('idtutor',$idtutor)
            ->where('kode_mtk',$kodemtk)
            ->where('id_jenis_angket', 2)
            ->delete();

        DB::table('angket_penilaian')
            ->where('masa',$masa)
            ->where('id_tutor',$idtutor)
            ->where('kode_matakuliah',$kodemtk)
            ->delete();

    }

    public static function getDataBYidkelas($id,$kode_upbjj,$masa)
    {
        $sql = "SELECT distinct ts.no_surat, ts.kode_upbjj, ts.masa, ts.idtutor
                , dp.namalengkap, dp.telepon, ts.idtutorial, ts.kode_pokjar, ts.status_approval
                , td.link, t.kode_mtk, mk.nama_mtk, td.kelas, td.tanggalmulai, td.idjadwal, jd.hari, jd.jam
                FROM z_t_surat_upbjj AS ts
                JOIN z_dp_tutor AS dp ON ts.idtutor = dp.idtutor
                JOIN z_tutorial AS t ON ts.idtutorial = t.idtutorial
                JOIN z_tutorial_detail AS td ON td.idtutorial = ts.idtutorial AND td.idtutor = dp.idtutor AND td.masa = ts.masa
                JOIN z_tutorial_mhs AS tm ON tm.masa = ts.masa AND tm.idtutor = ts.idtutor and tm.idtutorial = ts.idtutorial AND tm.kelas = td.kelas
                JOIN z_mjadwal AS jd ON td.idjadwal = jd.idjadwal AND jd.kode_upbjj = ts.kode_upbjj
                JOIN m_data_pribadi AS d ON tm.nim = d.nim
                JOIN m_mata_kuliah AS mk ON t.kode_mtk = mk.kode_mtk
                LEFT JOIN m_mhs_kontak_info AS k ON d.nim = k.nim
                WHERE ts.status_approval = 'YA'
                AND ts.masa = '$masa'
                AND ts.kode_upbjj = '$kode_upbjj'
                AND td.kelas = '$id'
                ORDER BY tm.nama ";
//        ts.masa = (SELECT MAX(a.masa) FROM z_t_surat_upbjj AS a limit 1) AND
        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }

}

