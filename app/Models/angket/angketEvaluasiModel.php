<?php

namespace App\Models\angket;

use App\Models\jadwal\jadwal_tutorialModel;
use DB;
use Illuminate\Database\Eloquent\Model;

class angketEvaluasiModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function get_penilaian($masa)
    {
        $sql = "SELECT DISTINCT a.masa, a.id_tutor, b.nama_lengkap,
                b.kode_matakuliah, b.nama_matakuliah, a.nilai_etm, a.hasil, a.rekomendasi, a.saran
                FROM angket_penilaian AS a
                JOIN angket_jadwal_ttm AS b ON a.masa = b.masa AND a.id_tutor = b.id_tutor AND  a.kode_matakuliah = b.kode_matakuliah
                WHERE a.masa = '$masa' ORDER by b.nama_lengkap
        ";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function get_evaluasi($masa, $idtutor, $kode_mtk)
    {
        $sql = "SELECT DISTINCT a.id, a.id_tutor, a.masa, a.kode_matakuliah
                FROM angket_jadwal_ttm AS a left JOIN angket_jawaban AS b ON (a.masa = b.masa
                AND a.id_tutor = b.idtutor AND  a.kode_matakuliah = b.kode_mtk) WHERE a.masa = '$masa' AND a.id_tutor = '$idtutor' AND a.kode_matakuliah = '$kode_mtk'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function get_jadwal_ttm($masa, $idtutor, $kode_mtk)
    {
        $sql = "SELECT * FROM angket_jadwal_ttm AS a WHERE a.masa = '$masa' AND a.id_tutor = '$idtutor' AND a.kode_matakuliah = '$kode_mtk'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function get_hasil_etu($masa, $idtutor, $kode_mtk)
    {
        $sql = "SELECT * FROM angket_penilaian AS a WHERE a.masa = '$masa' AND a.id_tutor = '$idtutor' AND a.kode_matakuliah = '$kode_mtk'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function jumlah_etm($masa)
    {
        $sql = "SELECT a.masa, a.idtutor, a.kode_mtk, COUNT(DISTINCT a.nim) AS etm FROM angket_jawaban AS a WHERE a.masa ='$masa' GROUP BY a.masa, a.kode_mtk, a.idtutor";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function get_sync_tutor($masa,$idtutor,$kodemtk)
    {
        $sql = "SELECT * FROM angket_jadwal_ttm as a WHERE a.masa = '$masa' AND a.id_tutor = '$idtutor' AND a.kode_matakuliah = '$kodemtk' ";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function evaluasi($masa, $idtutor, $kodemtk)
    {
//        $sql = $this->get_evaluasi($masa,$idtutor,$kode_mtk);
//        $sql = jadwal_tutorialModel::get_jadwal_ttm_by_masa_join($masa);
//        if (empty($sql)) {
//            return redirect()->back()->with(['error' => 'Data ' . $masa . ' tidak ditemukan']);
//        } else {
//            foreach ($sql as $items) {

        /* Data ETM */
//        $J1 = 0;
//        $J2 = 0;
        $total = 0;
//        $count = 0;
        /* Mengambil data angket dari db dashboard*/
        $query = angketTutorModel::getETMByKelas_1($masa, $idtutor, $kodemtk);
//                $angketetu = angketTutorModel::getETUByKelas_1($masa, $idtutor, $kodemtk);
//                $i = 0;
//                if (!empty($query) && !empty($angketetu)) {
//                    foreach ($query as $type) {
//                        $i = $i + 1;
//
//                    }
//
//                    if ($i >= 5) {
        if (!empty($query))
            foreach ($query as $data) {
                $h1[] = $data->H_1;
                $h2[] = $data->H_2;
                $h3[] = $data->H_3;
                $h4[] = $data->H_4;
                $h5[] = $data->H_5;
                $h6[] = $data->H_6;
                $h7[] = $data->H_7;
                $h8[] = $data->H_8;
                $h9[] = $data->H_9;
                $h10[] = $data->H_10;
                $h11[] = $data->H_11;
                $h12[] = $data->H_12;
                $h13[] = $data->H_13;
                $h14[] = $data->H_14;
                $h15[] = $data->H_15;

                for ($i = 1; $i <= 15; $i++) {
                    $a = $b = 'H_' . $i;
                    $total = $total + number_format((float)($data->$a), 2, '.', '');
                }
                $total = number_format((float)($total / 15), 2, '.', '');

            }
        $ratarata = array(
            'j1' => number_format((float)(array_sum($h1) / count($h1)), 2, '.', ''),
            'j2' => number_format((float)(array_sum($h2) / count($h2)), 2, '.', ''),
            'j3' => number_format((float)(array_sum($h3) / count($h3)), 2, '.', ''),
            'j4' => number_format((float)(array_sum($h4) / count($h4)), 2, '.', ''),
            'j5' => number_format((float)(array_sum($h5) / count($h5)), 2, '.', ''),
            'j6' => number_format((float)(array_sum($h6) / count($h6)), 2, '.', ''),
            'j7' => number_format((float)(array_sum($h7) / count($h7)), 2, '.', ''),
            'j8' => number_format((float)(array_sum($h8) / count($h8)), 2, '.', ''),
            'j9' => number_format((float)(array_sum($h9) / count($h9)), 2, '.', ''),
            'j10' => number_format((float)(array_sum($h10) / count($h10)), 2, '.', ''),
            'j11' => number_format((float)(array_sum($h11) / count($h11)), 2, '.', ''),
            'j12' => number_format((float)(array_sum($h12) / count($h12)), 2, '.', ''),
            'j13' => number_format((float)(array_sum($h13) / count($h13)), 2, '.', ''),
            'j14' => number_format((float)(array_sum($h14) / count($h14)), 2, '.', ''),
            'j15' => number_format((float)(array_sum($h15) / count($h15)), 2, '.', ''),

        );

        /* END Data ETM */

        /* Data ETU */
        $key_a = 'Memenuhi semua aspek penilaian tutor';
        $key_b = 'Memenuhi aspek 1 dan 2 penilaian tutor';
        $key_c = 'Tidak memenuhi aspek 1 dan 2 penilaian tutor';

        $a_ya = angketTutorModel::getETU_a_ya($masa, $idtutor, $kodemtk);
        $b_ya = angketTutorModel::getETU_b_ya($masa, $idtutor, $kodemtk);
        $jumlah_ya = $a_ya + $b_ya;

        if ($a_ya[0]->jumlah == 2) {
            $a_status = 'MAD';
        }
        if ($a_ya[0]->jumlah <= 1) {
            $a_status = 'TMA';
        }

        if ($a_status == 'MAD' && $b_ya[0]->jumlah == 3) {
            $hasil = $key_a;
        } elseif ($a_status == 'MAD' && $b_ya[0]->jumlah < 3) {
            $hasil = $key_b;
        } else {
            $hasil = $key_c;
        }

        $a_tidak = angketTutorModel::getETU_a_tidak($masa, $idtutor, $kodemtk);
        $b_tidak = angketTutorModel::getETU_b_tidak($masa, $idtutor, $kodemtk);
        $jumlah_tidak = $a_tidak + $b_tidak;
        /* END Data ETU */
        if ($total >= 3 && $hasil == $key_a) {
            $rekomendasi = 'Ditugaskan kembali untuk matakuliah yang sama';
        } elseif ($total >= 3 && $hasil == $key_b) {
            $rekomendasi = 'Ditugaskan kembali dengan perbaikan  pemenuhan administrasi pada semester selanjutnya';

        } elseif ($total >= 3 && $hasil == $key_c) {
            $rekomendasi = 'Tidak ditugaskan lagi';

        } elseif (($total >= 2.5 || $total < 3) && $hasil == $key_a) {
            $rekomendasi = 'Ditugaskan kembali dengan peningkatan kompetensi untuk matakuliah yang ditutorkan';

        } elseif (($total >= 2.5 || $total < 3) && $hasil == $key_b) {
            $rekomendasi = 'Ditugaskan kembali dengan peningkatan kompetensi untuk matakuliah yang ditutorkan dan perbaikan  pemenuhan administrasi pada semester selanjutnya';

        } elseif (($total >= 2.5 || $total < 3) && $hasil == $key_c) {
            $rekomendasi = 'Tidak ditugaskan lagi';

        } elseif (($total < 2.5) && $hasil == $key_a) {
            $rekomendasi = 'Dipertimbangkan untuk ditugaskan kembali untuk matakuliah yang sama dengan peningkatan kompetensi (apabila tidak tersedia tutor lain)';

        } elseif (($total < 2.5) && $hasil == $key_b) {
            $rekomendasi = 'Tidak ditugaskan lagi';

        } elseif (($total < 2.5) && $hasil == $key_c) {
            $rekomendasi = 'Tidak ditugaskan lagi';
        }


        $saran = angketTutorModel::getSaranByKelas($masa, $idtutor, $kodemtk);
        if (empty($saran)) {
            $saran = '-';
        } else {
            $saran = $saran[0]->saran;
        }


        $array = array(
            'masa' => $masa,
            'id_tutor' => $idtutor,
            'kode_matakuliah' => $kodemtk,
            'nilai_etm' => $total,
            'hasil' => $hasil,
            'rekomendasi' => $rekomendasi,
            'saran' => $saran,

        );

        $getid = jadwal_tutorialModel::get_angket_penilaian($masa, $idtutor, $kodemtk);
        if (empty($getid)) {
            jadwal_tutorialModel::insert_angket_penilaian($array);
        } else {
            $id = $getid[0]->id;
            jadwal_tutorialModel::update_angket_penilaian($id, $array);
        }
    }

//            }
//        }
//    }
}

