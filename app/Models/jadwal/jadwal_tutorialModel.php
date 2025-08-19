<?php

namespace App\Models\jadwal;

use DB;
use Illuminate\Database\Eloquent\Model;

class jadwal_tutorialModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getDataBYNIM($id,$kode_upbjj)
    {
        $sql = "SELECT distinct ts.no_surat, ts.kode_upbjj, ts.masa, ts.idtutor,dpm.kode_upbjj AS u
                , dp.namalengkap, dp.telepon, ts.idtutorial, ts.kode_pokjar, ts.status_approval, tm.nim, tm.nama
                , td.link, t.kode_mtk, td.kelas, td.tanggalmulai, td.idjadwal, jd.hari, jd.jam, td.idlokasi, lt.lokasi
                FROM z_t_surat_upbjj AS ts
                JOIN z_dp_tutor AS dp ON ts.idtutor = dp.idtutor
                JOIN z_tutorial AS t ON ts.idtutorial = t.idtutorial
                JOIN z_tutorial_detail AS td ON td.idtutorial = ts.idtutorial AND td.idtutor = dp.idtutor AND td.masa = ts.masa
                JOIN z_tutorial_mhs AS tm ON tm.masa = ts.masa AND tm.idtutor = ts.idtutor and tm.idtutorial = ts.idtutorial AND tm.kelas = td.kelas
                JOIN z_mjadwal AS jd ON td.idjadwal = jd.idjadwal AND jd.kode_upbjj = ts.kode_upbjj
                JOIN z_lokasi_tutorial AS lt ON td.idlokasi = lt.idlokasi
                JOIN m_data_pribadi AS dpm ON tm.nim = dpm.nim
                WHERE ts.masa = (SELECT MAX(a.masa) FROM z_t_surat_upbjj AS a limit 1)
                AND (ts.kode_upbjj = '$kode_upbjj' AND tm.nim = '$id' AND ts.masa = (SELECT MAX(a.masa) FROM z_t_surat_upbjj AS a limit 1))
				OR (tm.nim = '$id' AND dpm.kode_upbjj = '$kode_upbjj' AND ts.masa = (SELECT MAX(a.masa) FROM z_t_surat_upbjj AS a limit 1))";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }
    public static function getDataBYidtutor($id,$kode_upbjj)
    {
        $sql = "SELECT distinct ts.no_surat, ts.kode_upbjj, ts.masa, ts.idtutor
                , dp.namalengkap, dp.telepon, ts.idtutorial, ts.kode_pokjar, ts.status_approval
				 #, tm.nim, tm.nama
                , td.link, t.kode_mtk, td.kelas, td.tanggalmulai, td.idjadwal, jd.hari, jd.jam, td.idlokasi, lt.lokasi
                FROM z_t_surat_upbjj AS ts
                JOIN z_dp_tutor AS dp ON ts.idtutor = dp.idtutor
                JOIN z_tutorial AS t ON ts.idtutorial = t.idtutorial
                JOIN z_tutorial_detail AS td ON td.idtutorial = ts.idtutorial AND td.idtutor = dp.idtutor AND td.masa = ts.masa
                JOIN z_tutorial_mhs AS tm ON tm.masa = ts.masa AND tm.idtutor = ts.idtutor and tm.idtutorial = ts.idtutorial AND tm.kelas = td.kelas
                JOIN z_mjadwal AS jd ON td.idjadwal = jd.idjadwal AND jd.kode_upbjj = ts.kode_upbjj
                JOIN z_lokasi_tutorial AS lt ON td.idlokasi = lt.idlokasi
                WHERE ts.masa = (SELECT MAX(a.masa) FROM z_t_surat_upbjj AS a limit 1) and ts.status_approval = 'YA'
                AND ts.kode_upbjj = '$kode_upbjj'
                AND  ts.idtutor = '$id'";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getDataBYkelas($id,$kode_upbjj,$idtutorial)
    {
        $sql = "SELECT distinct ts.no_surat, ts.kode_upbjj, ts.masa, ts.idtutor
                , dp.namalengkap, dp.telepon, ts.idtutorial, ts.kode_pokjar, ts.status_approval, tm.nim, tm.nama
                , td.link, t.kode_mtk, mk.nama_mtk, td.kelas, td.tanggalmulai, td.idjadwal, jd.hari, jd.jam, k.nomor_hp
                FROM z_t_surat_upbjj AS ts
                JOIN z_dp_tutor AS dp ON ts.idtutor = dp.idtutor
                JOIN z_tutorial AS t ON ts.idtutorial = t.idtutorial
                JOIN z_tutorial_detail AS td ON td.idtutorial = ts.idtutorial AND td.idtutor = dp.idtutor AND td.masa = ts.masa
                JOIN z_tutorial_mhs AS tm ON tm.masa = ts.masa AND tm.idtutor = ts.idtutor and tm.idtutorial = ts.idtutorial AND tm.kelas = td.kelas
                JOIN z_mjadwal AS jd ON td.idjadwal = jd.idjadwal AND jd.kode_upbjj = ts.kode_upbjj
                JOIN m_data_pribadi AS d ON tm.nim = d.nim
                JOIN m_mata_kuliah AS mk ON t.kode_mtk = mk.kode_mtk
                LEFT JOIN m_mhs_kontak_info AS k ON d.nim = k.nim
                WHERE ts.masa = (SELECT MAX(a.masa) FROM z_t_surat_upbjj AS a limit 1)
                AND ts.status_approval = 'YA'
                AND ts.kode_upbjj = '$kode_upbjj' AND td.idtutorial = '$idtutorial'
                AND td.kelas = '$id'
                ORDER BY tm.nama asc";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }
    public static function getDataBYidkelas($id,$kode_upbjj)
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
                WHERE ts.masa = (SELECT MAX(a.masa) FROM z_t_surat_upbjj AS a limit 1)
                AND ts.status_approval = 'YA'
                AND ts.kode_upbjj = '$kode_upbjj'
                AND td.kelas = '$id'
                ORDER BY tm.nama asc";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function get_jadwal_ttm($masa,$kelas){
        $sql = "SELECT * FROM angket_jadwal_ttm AS a WHERE a.masa = '$masa' AND a.kelas = '$kelas'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function get_jadwal_ttm_by_masa($masa){
        $sql = "SELECT * FROM angket_jadwal_ttm AS a WHERE a.masa = '$masa' ";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function get_jadwal_ttm_by_masa_join($masa){
        $sql = "SELECT DISTINCT a.id, a.id_tutor, a.masa, a.kode_matakuliah
                FROM angket_jadwal_ttm AS a JOIN angket_jawaban AS b ON (a.masa = b.masa
                AND a.id_tutor = b.idtutor AND  a.kode_matakuliah = b.kode_mtk) WHERE a.masa = '$masa'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function simpan_jadwal_ttm($array){
        DB::table('angket_jadwal_ttm')
            ->insert($array);
    }
    public static function update_jadwal_ttm($id,$array) {
        DB::table('angket_jadwal_ttm')
            ->where('id',$id)
            ->update($array);

    }

    public static function insert_angket_penilaian($array){
        DB::table('angket_penilaian')
            ->insert($array);
    }
    public static function update_angket_penilaian($id,$array) {
        DB::table('angket_penilaian')
            ->where('id',$id)
            ->update($array);

    }


    public static function get_angket_penilaian($masa, $idtutor, $kodemtk){
        $sql = "SELECT * FROM angket_penilaian AS a WHERE a.masa = '$masa' and a.id_tutor = $idtutor and a.kode_matakuliah = '$kodemtk'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }
}

