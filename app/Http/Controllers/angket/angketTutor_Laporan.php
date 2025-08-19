<?php

namespace App\Http\Controllers\angket;

use App\Http\Controllers\Controller;
use App\Models\angket\angketetuModel;
use App\Models\angket\angketTutorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class angketTutor_Laporan extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        #$this->middleware('rolepjb:admin,regjian,bblba,pjb,pjw,user');
    }

    public function index()
    {
        return view('pages.angket.angkettutor');
    }

    public function search(Request $request)
    {
        $id = $request->input('id');
        if (empty($id)) {
            $query = angketTutorModel::getTutorialByTutorAll();
            return view('pages.angket.angkettutor', compact('query'));
        }
        $query = angketTutorModel::getTutorialByTutor($id);
        return view('pages.angket.angkettutor', compact('query'));

    }

    public function search2($id1,$id2)
    {
        $masa = decrypt($id1);
        $idtutor = decrypt($id2);
        $query = angketTutorModel::getTutorialByTutor($id);
        return view('pages.angket.angkettutor', compact('query'));
    }


    public function rekomendasi($id1, $id2)
    {
        $kelas = decrypt($id1);
        $jenis = $id2;
        if (empty($kelas)) {
            return redirect()->back();
        }

        /* Data ETM */
        $J1 = 0;
        $J2 = 0;
        $total = 0;
        $query = angketTutorModel::getETMByKelas($kelas);

        if (empty($query)) {
            return redirect()->back();
        } else {
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
        }

        /* END Data ETM */

        /* Data ETU */
        $key_a = 'Memenuhi semua aspek penilaian tutor';
        $key_b = 'Memenuhi aspek 1 dan 2 penilaian tutor';
        $key_c = 'Tidak memenuhi aspek 1 dan 2 penilaian tutor';

        $a_ya = angketTutorModel::getETU_a_ya($kelas);
        $b_ya = angketTutorModel::getETU_b_ya($kelas);
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
        $a_tidak = angketTutorModel::getETU_a_tidak($kelas);
        $b_tidak = angketTutorModel::getETU_b_tidak($kelas);
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


        $saran = angketTutorModel::getSaranByKelas($kelas);
        if (empty($saran)) {
            $saran = '-';
        } else {
            $saran = $saran[0]->saran;
        }

        if ($jenis == 'rekomendasi') {

            return view('pages.angket.angketrekomendasi', compact('query', 'total', 'saran', 'hasil', 'rekomendasi'));
        }

        if ($jenis == 'dataetm') {
            $view = \View::make('pages.angket.pdf.angketetmhasil', compact('query', 'total', 'ratarata'))->render();
            $pdf = \App::make('snappy.pdf.wrapper');
            $pdf->loadHTML($view)
                ->setOption('page-size', 'A4')
                ->setOrientation('portrait')
                ->setOption('print-media-type', true)
                ->setOption('margin-bottom', 5)
                ->setOption('margin-left', 5)
                ->setOption('margin-right', 5)
                ->setOption('margin-top', 2)
                ->setOption('encoding', 'utf-8')
                ->setOption('disable-smart-shrinking', true);
            return $pdf->inline($kelas . '.pdf');
        }

        if ($jenis == 'dataetu') {
            $dataetu = angketetuModel::getetuHasil($kelas);
            $view = \View::make('pages.angket.pdf.angketetuhasil', compact('query', 'hasil', 'dataetu', 'saran', 'rekomendasi'))->render();
            $pdf = \App::make('snappy.pdf.wrapper');
            $pdf->loadHTML($view)
                ->setOption('page-size', 'A4')
                ->setOrientation('portrait')
                ->setOption('print-media-type', true)
                ->setOption('margin-bottom', 5)
                ->setOption('margin-left', 5)
                ->setOption('margin-right', 5)
                ->setOption('margin-top', 2)
                ->setOption('encoding', 'utf-8')
                ->setOption('disable-smart-shrinking', true);
            return $pdf->inline($kelas . '.pdf');
        }
        if ($jenis == 'datarekomendasi') {

            $dataetu = angketetuModel::getetuHasil($kelas);
            $view = \View::make('pages.angket.pdf.angketrekomendasihasil', compact('query', 'total', 'saran', 'hasil', 'rekomendasi'))->render();
            $pdf = \App::make('snappy.pdf.wrapper');
            $pdf->loadHTML($view)
                ->setOption('page-size', 'A4')
                ->setOrientation('landscape')
                ->setOption('print-media-type', true)
                ->setOption('margin-bottom', 5)
                ->setOption('margin-left', 5)
                ->setOption('margin-right', 5)
                ->setOption('margin-top', 2)
                ->setOption('encoding', 'utf-8')
                ->setOption('disable-smart-shrinking', true);
            return $pdf->inline($kelas . '.pdf');
        }
        if ($jenis == 'hapusetu') {
            try {
                angketetuModel::HapusETU($kelas);
                return redirect()->route('angket.tutor.cariid', ['id' =>Crypt::encrypt($query[0]->idtutor)])->with(['success' => 'Data Berhasil Dihapus']);
            } catch (\Illuminate\Database\QueryException $exception) {
                return redirect()->route('angket.tutor.cariid', ['id' =>Crypt::encrypt($query[0]->idtutor)])->with(['success' => 'Gagal hapus data peserta']);
            }
        } else {
            return route('home');
        }
    }
}
