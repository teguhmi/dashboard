<?php

namespace App\Http\Controllers\angket;

use App\Http\Controllers\Controller;
use App\Models\angket\angketetuModel;
use App\Models\angket\angketEvaluasiModel;
use App\Models\angket\angketTutorModel;
use App\Models\jadwal\jadwal_tutorialModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class angketETUController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rolepjb:admin,regjian,bblba,pjb,pjw');
    }

    public static function index($id1, $id2, $id3, $id4)
    {

        $kode_upbjj = config('app.kode_upbjj');

        $masa = decrypt($id1);
        $idtutor = decrypt($id2);
        $kodemtk = decrypt($id3);
        $jenis = $id4;


        $etu = $id1;
        $hasiletu = angketetuModel::getAngketJawaban($masa, $idtutor, $kodemtk);

        if (empty($hasiletu)) {
            $status = '';
            $hasiletu = '';
        } else {
            $status = 'update';
        }


        $qetu = angketTutorModel::getETUByKelas_2($masa, $idtutor, $kodemtk);

        if(!empty($qetu)) {
            $kelas = array(
                'masa' => $qetu[0]->masa,
                'idtutor' => $qetu[0]->idtutor,
                'idtutorial' => $qetu[0]->idtutorial,
                'nama_tutor' => $qetu[0]->nama_tutor,
                'kelas' => $qetu[0]->kelas,
                'kode_mtk' => $qetu[0]->kode_mtk,
                'nama_mtk' => $qetu[0]->nama_mtk,

            );

        }
        $data = angketetuModel::getAngketETU();
        $pola = angketetuModel::getAngketpola();

        if (!empty($data)) {
            return view('pages.angket.angketetu', compact('data', 'pola', 'kelas', 'hasiletu', 'status'));
        }
    }

    public static function simpan(Request $request)
    {
        $i = '0';
        $idkelas = $request->input('kelas');
        $kode_upbjj = config('app.kode_upbjj');
        $idtutorial = $request->input('idtutorial');
        $idtutor = $request->input('idtutor');
        $masa = $request->input('masa');
        $nama_tutor = $request->input('nama_tutor');
        $kode_mtk = $request->input('kode_mtk');
        $nama_mtk = $request->input('nama_mtk');
        $idjenisangket = '2';
        $cekdata = angketetuModel::cekjawaban($idkelas, $idtutor, $idjenisangket, $masa);


        if (!empty($idkelas)) {
            $id = $idkelas;
            $kelas = angketetuModel::getDataBYidkelas($id, $kode_upbjj, $masa);


        }
        if (!empty($cekdata)) {
//            return redirect()->route('angket.tutor.cariid', ['id' => Crypt::encrypt($idtutor)]);
            return redirect()->back()->with(['warning' => 'Anda sudah mengisi angket tutor ' . $nama_tutor]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $data = array(
                'kode_upbjj' => $kode_upbjj,
                'masa' => $masa,
                #'nim' => $nim,
                'idtutorial' => $idtutorial,
                'idtutor' => $idtutor,
                'nama_tutor' => $nama_tutor,
                'kode_mtk' => $kode_mtk,
                'nama_mtk' => $nama_mtk,
//                'kabupaten' => $kelas[0]->id_tutor,
//                'kode_pokjar' => $kelas[0]->kode_pokjar,
//                'nama_pokjar' => $kelas[0]->id_tutor,
                'kelas' => $idkelas,
                'id_jenis_angket' => $idjenisangket,
                'nomor_soal' => $request->input('nomor_soal_' . $i),
                'jawaban' => $request->input('jawaban_' . $i),
                'user_create' => Auth::user()->name,
            );
            angketetuModel::simpanAngketJawab($data);
        }
        $saran = $request->input('saran');
        if (!empty($saran)) {
            $data = array(
                'masa' => $masa,
                'id_jenis_angket' => $idjenisangket,
                'kelas' => $idkelas,
                'idtutorial' => $idtutorial,
                'idtutor' => $idtutor,
                'kode_mtk' => $kode_mtk,
                'saran' => $saran,
            );
            angketetuModel::simpanAngketJawabSaran($data);
        }
        $kodemtk = $kode_mtk;
        angketEvaluasiModel::evaluasi($masa,$idtutor,$kodemtk);

        return redirect()->route('angket.reload', ['id' => Crypt::encrypt($masa)])->with(['success' => 'Data Tersimpan']);

    }
}
