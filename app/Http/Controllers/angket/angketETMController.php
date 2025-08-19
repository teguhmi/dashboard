<?php

namespace App\Http\Controllers\angket;

use App\Http\Controllers\Controller;
use App\Models\angket\angketetmModel;
use App\Models\jadwal\jadwal_tutorialModel;
use App\Models\srs\QuerySRS;
use App\Models\srs\QuerySRS5G;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class angketETMController extends Controller
{


    public function index($id1, $id2, $id3, $id4)
    {
        $kode_upbjj = config('app.kode_upbjj');
        if (!empty($id1)) {
            $idkelas = decrypt($id1);
        } else {
            $idkelas = null;
        }

        if (!empty($id2)) {
            $nim = decrypt($id2);
        } else {
            $nim = null;
        }

        if (!empty($id3)) {
            $masa = decrypt($id3);
        } else {
            $masa = null;
        }

        $nama_tutor = $id4;

        if (!empty($idkelas)) {
//            $id = $idkelas;
            $kelas = QuerySRS5G::getDataBYidkelas($masa, $idkelas);
        }
        $data = angketetmModel::getAngketETM();
        $pola = angketetmModel::getAngketpola();
        $idjenisangket = '1';
        $cek_data = angketetmModel::cekjawaban($idkelas, $nim, $idjenisangket, $masa);

        if (!empty($data)) {
            return view('pages.angket.angketetm', compact('data', 'pola', 'kelas', 'nim', 'cek_data', 'nama_tutor'));
        }
    }

    public function simpan(Request $request)
    {

        $i = '0';
        $idkelas = $request->input('kelas');
        $masa = $request->input('masa');
        $nim = $request->input('nim');
        $nama_tutor = $request->input('nama_tutor');
        $kode_upbjj = config('app.kode_upbjj');
        $idjenisangket = '1';
//        $masa = '20221';
        $cekdata = angketetmModel::cekjawaban($idkelas, $nim, $idjenisangket, $masa);
        $getdatasrs = QuerySRS::getDPbyNIM($nim);
        if (!empty($idkelas)) {
            $id = $idkelas;
            $kelas = QuerySRS5G::getDataBYidkelas($masa, $idkelas);
        }
        if (!empty($cekdata)) {
            return redirect()->back()->with(['warning' => 'Anda sudah mengisi angket tutor ' . $kelas->data[0]->id_tutor]);
        }

        for ($i = 1; $i <= 15; $i++) {
            $data = array(
                'kode_upbjj' => $kelas->data[0]->kode_upbjj,
                'masa' => $kelas->data[0]->masa,
                'nim' => $nim,
                'idtutorial' => $kelas->data[0]->id_tutorial,
                'idtutor' => $kelas->data[0]->id_tutor,
//                'nama_tutor' => $kelas->data[0]->namalengkap,
                'nama_tutor' => $nama_tutor,
                'kode_mtk' => $kelas->data[0]->kode_matakuliah,
                'nama_mtk' => $kelas->data[0]->nama_matakuliah,
//                'kabupaten' => $kelas[0]->id_tutor,
//                'kode_pokjar' => $kelas->data[0]->kode_pokjar,
//                'nama_pokjar' => $kelas[0]->id_tutor,
                'kelas' => $kelas->data[0]->id_kelas,
                'id_jenis_angket' => $idjenisangket,
                'nomor_soal' => $request->input('nomor_soal_' . $i),
                'jawaban' => $request->input('jawaban_' . $i),
                'user_create' => $getdatasrs[0]->nama_mahasiswa,
            );
            angketetmModel::simpanAngketJawab($data);
        }
        return redirect()->back()->with(['success' => 'Data Berhasil Tersimpan']);
    }

    public function search($id1, $id2, $id3)
    {

        $kode_upbjj = config('app.kode_upbjj');

        if (!empty($id1)) {
            $id = decrypt($id1);
            $query_kelas = jadwal_tutorialModel::getDataBYidkelas($id, $kode_upbjj);
        }

        if (!empty($id2)) {
            $nim = decrypt($id2);
            $sqlDP = QuerySRS::getDPbyNIM($nim);
        }

        if (!empty($id3)) {
            $id = decrypt($id3);
            $query_tutor = jadwal_tutorialModel::getDataBYidtutor($id, $kode_upbjj);
        }

        dd($query_kelas, $sqlDP, $query_tutor);
    }

}
