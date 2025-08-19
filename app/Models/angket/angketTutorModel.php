<?php

namespace App\Models\angket;

use DB;
use Illuminate\Database\Eloquent\Model;

class angketTutorModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getJadwalTutorialAll()
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
                AND ts.kode_upbjj = '$upbjj'
                ORDER BY dp.namalengkap
                ";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }


    public static function getETMByKelas($kelas)
    {
        $sql = "SELECT a.masa, a.nim, a.idtutor, a.kelas, a.nama_tutor, a.kode_mtk, a.nama_mtk,
                MAX(case when a.nomor_soal = 1 THEN a.jawaban END)  AS H_1,
                MAX(case when a.nomor_soal = 2 THEN a.jawaban END)  AS H_2,
                MAX(case when a.nomor_soal = 3 THEN a.jawaban END)  AS H_3,
                MAX(case when a.nomor_soal = 4 THEN a.jawaban END)  AS H_4,
                MAX(case when a.nomor_soal = 5 THEN a.jawaban END)  AS H_5,
                MAX(case when a.nomor_soal = 6 THEN a.jawaban END)  AS H_6,
                MAX(case when a.nomor_soal = 7 THEN a.jawaban END)  AS H_7,
                MAX(case when a.nomor_soal = 8 THEN a.jawaban END)  AS H_8,
                MAX(case when a.nomor_soal = 9 THEN a.jawaban END)  AS H_9,
                MAX(case when a.nomor_soal = 10 THEN a.jawaban END)  AS H_10,
                MAX(case when a.nomor_soal = 11 THEN a.jawaban END)  AS H_11,
                MAX(case when a.nomor_soal = 12 THEN a.jawaban END)  AS H_12,
                MAX(case when a.nomor_soal = 13 THEN a.jawaban END)  AS H_13,
                MAX(case when a.nomor_soal = 14 THEN a.jawaban END)  AS H_14,
                MAX(case when a.nomor_soal = 15 THEN a.jawaban END)  AS H_15
                FROM angket_jawaban AS a
                WHERE a.id_jenis_angket = '1' and a.kelas = '$kelas'
                GROUP BY  a.masa, a.nim, a.idtutor, a.kelas, a.nama_tutor, a.kode_mtk, a.nama_mtk

                ";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }


    public static function getETUByKelas($kelas)
    {
        $sql = "SELECT * FROM angket_jawaban as a WHERE a.kelas = '$kelas' and a.id_jenis_angket = '2'
                ";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }


    public static function getETMByKelas_1($masa,$idtutor,$kodemtk)
    {

        $sql = "SELECT a.masa, a.nim, a.idtutor, a.kelas, a.nama_tutor, a.kode_mtk, a.nama_mtk,
                MAX(case when a.nomor_soal = 1 THEN a.jawaban END)  AS H_1,
                MAX(case when a.nomor_soal = 2 THEN a.jawaban END)  AS H_2,
                MAX(case when a.nomor_soal = 3 THEN a.jawaban END)  AS H_3,
                MAX(case when a.nomor_soal = 4 THEN a.jawaban END)  AS H_4,
                MAX(case when a.nomor_soal = 5 THEN a.jawaban END)  AS H_5,
                MAX(case when a.nomor_soal = 6 THEN a.jawaban END)  AS H_6,
                MAX(case when a.nomor_soal = 7 THEN a.jawaban END)  AS H_7,
                MAX(case when a.nomor_soal = 8 THEN a.jawaban END)  AS H_8,
                MAX(case when a.nomor_soal = 9 THEN a.jawaban END)  AS H_9,
                MAX(case when a.nomor_soal = 10 THEN a.jawaban END)  AS H_10,
                MAX(case when a.nomor_soal = 11 THEN a.jawaban END)  AS H_11,
                MAX(case when a.nomor_soal = 12 THEN a.jawaban END)  AS H_12,
                MAX(case when a.nomor_soal = 13 THEN a.jawaban END)  AS H_13,
                MAX(case when a.nomor_soal = 14 THEN a.jawaban END)  AS H_14,
                MAX(case when a.nomor_soal = 15 THEN a.jawaban END)  AS H_15
                FROM angket_jawaban AS a
                WHERE a.id_jenis_angket = '1' and a.masa = '$masa' and a.idtutor = '$idtutor' and a.kode_mtk = '$kodemtk'
                GROUP BY  a.masa, a.nim, a.idtutor, a.kelas, a.nama_tutor, a.kode_mtk, a.nama_mtk

                ";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getETUByKelas_1($masa,$idtutor,$kodemtk)
    {
        $sql = "SELECT * FROM angket_jawaban as a WHERE  a.id_jenis_angket = '2' and a.masa = '$masa' and a.idtutor = '$idtutor' and a.kode_mtk = '$kodemtk'
                ";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }
    public static function getETUByKelas_2($masa,$idtutor,$kodemtk)
    {
        $sql = "SELECT * FROM angket_jawaban as a WHERE  a.id_jenis_angket = '1' and a.masa = '$masa' and a.idtutor = '$idtutor' and a.kode_mtk = '$kodemtk'
                ";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }
    public static function getTutorialByTutor($id)
    {
        $upbjj = config('app.kode_upbjj');
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
                WHERE
                ts.status_approval = 'YA'
                AND ts.kode_upbjj = '$upbjj'
                AND (ts.idtutor = '$id' OR dp.namalengkap LIKE '%$id%')
                AND tm.masa >= '2021'
                ORDER BY tm.masa desc, dp.namalengkap asc
                ";
//ts.masa = (SELECT MAX(a.masa) FROM z_t_surat_upbjj AS a limit 1) AND
        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function getTutorialBymasa($id)
    {
        $upbjj = config('app.kode_upbjj');
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
                WHERE
                ts.status_approval = 'YA'
                AND ts.kode_upbjj = '$upbjj'
                AND ts.masa = '$id'
                ORDER BY ts.masa desc, dp.namalengkap asc
                ";
//ts.masa = (SELECT MAX(a.masa) FROM z_t_surat_upbjj AS a limit 1) AND
        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function getTutorialByTutorAll()
    {
        $upbjj = config('app.kode_upbjj');
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
                AND ts.kode_upbjj = '$upbjj'
                ORDER BY ts.masa desc, dp.namalengkap asc
                ";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getMasaIjinKelas()
    {
        $upbjj = config('app.kode_upbjj');
        $sql = "SELECT DISTINCT (a.masa) FROM z_t_surat_upbjj as a WHERE a.kode_upbjj = '$upbjj' AND a.masa >= '20221' ORDER BY a.masa desc";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;
    }
    public static function getSaranByKelas($masa,$idtutor,$kodemtk)
    {
        $sql = "SELECT * FROM angket_jawaban_saran as a
                WHERE a.id_jenis_angket = '2'
                AND a.masa = '$masa'
                AND a.idtutor = '$idtutor'
# AND a.kode_mtk = '$kodemtk'
                ";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getETU_a_tidak($masa,$idtutor,$kodemtk)
    {
        $sql = "SELECT COUNT(a.nomor_soal) AS jumlah FROM angket_jawaban AS a
                WHERE a.id_jenis_angket = '2'
                AND a.nomor_soal IN ('1','2') AND a.jawaban = '0'
                AND a.masa = '$masa'
                AND a.idtutor = '$idtutor'
                AND a.kode_mtk = '$kodemtk'
                ";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getETU_a_ya($masa,$idtutor,$kodemtk)
    {
        $sql = "SELECT COUNT(distinct(a.nomor_soal)) AS jumlah
                FROM angket_jawaban AS a WHERE a.id_jenis_angket = '2'
                AND a.nomor_soal IN ('1','2') AND a.jawaban = '1'
                AND a.masa = '$masa'
                AND a.idtutor = '$idtutor'
                AND a.kode_mtk = '$kodemtk'
                ";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getETU_b_tidak($masa,$idtutor,$kodemtk)
    {
        $sql = "SELECT COUNT(distinct(a.nomor_soal)) AS jumlah FROM angket_jawaban AS a WHERE
                a.id_jenis_angket = '2'
                AND a.nomor_soal IN ('3','4','5')
                AND a.jawaban = '0'
                AND a.masa = '$masa'
                AND a.idtutor = '$idtutor'
                AND a.kode_mtk = '$kodemtk'
                ";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getETU_b_ya($masa,$idtutor,$kodemtk)
    {
        $sql = "SELECT COUNT(a.nomor_soal) AS jumlah FROM angket_jawaban AS a
                WHERE a.id_jenis_angket = '2' AND a.nomor_soal IN ('3','4','5')
                AND a.jawaban = '1'
                AND a.masa = '$masa'
                AND a.idtutor = '$idtutor'
                AND a.kode_mtk = '$kodemtk'
                ";

        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }


}

