<?php

namespace App\Models\jadwal;

use DB;
use Illuminate\Database\Eloquent\Model;

class jadwal_TutorModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getDPTutorbyID($id, $upbjj)
    {
        $sql = "SELECT * FROM z_dp_tutor as a where a.idtutor = '$id' and a.kode_upbjj= '$upbjj' ";
        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getDPTutorbyIDtgllahir($id, $tanggal_lahir, $upbjj)
    {
        $sql = "SELECT * FROM z_dp_tutor as a where a.idtutor = '$id' and a.tanggallahir = '$tanggal_lahir' and a.kode_upbjj = '$upbjj'";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getmtkampu($id)
    {
        $sql = "SELECT a.idtutor, a.kode_mtk, a.buku, m.nama_mtk
                FROM z_mtk_ampu AS a
                JOIN m_mata_kuliah AS m ON a.kode_mtk = m.kode_mtk
                WHERE a.idtutor = '$id' order by m.nama_mtk";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getKelas($id)
    {
        $upbjj = config('app.kode_upbjj');
        $sql = "SELECT distinct a.masa, a.idtutor, b.namalengkap, c.kode_mtk, m.nama_mtk
                FROM z_tutorial_detail AS a
                JOIN z_dp_tutor AS b ON a.idtutor = b.idtutor
                JOIN z_tutorial AS c ON a.idtutorial = c.idtutorial
                JOIN m_mata_kuliah AS m ON c.kode_mtk = m.kode_mtk
                JOIN z_t_surat_upbjj AS i ON a.idtutor = i.idtutor AND a.idtutorial = i.idtutorial
                WHERE  a.idtutor = '$id' AND i.status_approval = 'YA' and b.kode_upbjj ='$upbjj'
                ORDER BY  a.masa desc,m.nama_mtk asc";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getPendidikanTutor($id)
    {

        $sql = "SELECT distinct dp.idtutor, dp.namalengkap, p.kodept, pt.namapt, p.bidangstudi, p.kode_pendidikan_akhir, a.nama_pendidikan_akhir
                FROM z_dp_tutor AS dp
                JOIN z_pendidikan_tutor AS p ON dp.idtutor = p.idtutor
                JOIN z_pta AS pt ON p.kodept = pt.kodept
                JOIN m_pendidikan_akhir AS a ON p.kode_pendidikan_akhir = a.kode_pendidikan_akhir
                WHERE dp.idtutor = '$id' AND a.status_aktif = '1'";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getMatakuliah($kodemtk)
    {

        $sql = "SELECT DISTINCT a.kode_mtk, a.nama_mtk, a.nama_mtk_singkat
                FROM m_mata_kuliah AS a WHERE a.kode_mtk =  '$kodemtk'";

        $results = DB::connection(self::$db4g)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getAjuanMatakuliah($id)
    {

        $sql = "SELECT * FROM tutorial_ajuan_matakuliah as a where a.idtutor = '$id' ";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function insert($data)
    {
        $results = DB::table('tutorial_ajuan_matakuliah')
            ->insertOrIgnore($data);
        return $results;
    }
    public static function hapusmtk($idmtk)
    {
        DB::table('tutorial_ajuan_matakuliah')
            ->where('id', $idmtk)
            ->delete();
    }
    public static function cekMatakuliah($masa,$id,$kodemtk)
    {
        $sql = "SELECT * FROM tutorial_ajuan_matakuliah as a where a.idtutor = '$id' and a.masa = '$masa' AND a.kode_mtk = '$kodemtk'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function pdf($masa,$id)
    {

    }
}

