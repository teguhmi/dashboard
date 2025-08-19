<?php

namespace App\Http\Controllers\jadwal;

use App\Http\Controllers\Controller;
use App\Models\jadwal\jadwal_TutorModel;
use App\Models\SettingModel;
use App\Models\srs\QuerySRS5G;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Response;
use PDFS;
use File;

class tutorController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->input('id');
        $upbjj = config('app.kode_upbjj');
//        $masa = SettingModel::get_masa();
//        $masa = $masa[0]->masa;
        if (empty($id)) {
            return view('pages.jadwal.tutor.tutor_dp');
        } else {

            $matakuliahampu = QuerySRS5G::gtmatakuliahampu($id);
            $kelas = QuerySRS5G::getttmbytutorall($id);
            $pendidikantutor = QuerySRS5G::getPendidikanTutor($id);
            $ajuanmatakuliah = jadwal_TutorModel::getAjuanMatakuliah($id);
            if (Auth::check()) {
                $DPtutor = QuerySRS5G::getDPTutor($id);
                return view('pages.jadwal.tutor.tutor_dp', compact('DPtutor', 'matakuliahampu', 'kelas', 'pendidikantutor', 'ajuanmatakuliah'));
            } else {
                $this->validate($request, [
                    'captcha' => 'required|captcha'
                ],
                    ['captcha.captcha' => 'Kode captcha belum sesuai.']);
                $tanggal_lahir = $request->input('tanggal_lahir');
                $DPtutor = QuerySRS5G::getDPTutor($id);
                if ($DPtutor['tanggal_lahir'] != $tanggal_lahir) {
                    return redirect()->back()->with('error', 'Data tidak ditemukan !');
                } else {
                    return view('pages.jadwal.tutor.tutor_dp', compact('DPtutor', 'matakuliahampu', 'kelas', 'pendidikantutor', 'ajuanmatakuliah'));
                }
            }
        }
    }

    public function index_reload($id)
    {
        $id = decrypt($id);
        $upbjj = config('app.kode_upbjj');
//        $masa = SettingModel::get_masa();
//        $masa = $masa[0]->masa;
        if (empty($id)) {
            return view('pages.jadwal.tutor.tutor_dp');
        } else {

            $matakuliahampu = jadwal_TutorModel::getmtkampu($id);
            $kelas = jadwal_TutorModel::getKelas($id);
            $pendidikantutor = jadwal_TutorModel::getPendidikanTutor($id);
            $ajuanmatakuliah = jadwal_TutorModel::getAjuanMatakuliah($id);
            $DPtutor = jadwal_TutorModel::getDPTutorbyID($id, $upbjj);
        }
        if (empty($DPtutor)) {
            return redirect()->back()->with('error', 'Data tidak ditemukan !');
        } else {
            return view('pages.jadwal.tutor.tutor_form_tutorial', compact('DPtutor', 'matakuliahampu', 'kelas', 'pendidikantutor', 'masa', 'ajuanmatakuliah'));
        }
    }


    public function formubahdp($id)
    {
        $id = decrypt($id);
        dd($id);
    }

    public function formtutorial(Request $request)
    {
        $id = $request->input('id');
        if (empty($id)) {
            return view('pages.jadwal.tutor.tutor_form_tutorial');
        } else {
            $this->validate($request, [
                'captcha' => 'required|captcha'
            ],
                ['captcha.captcha' => 'Kode captcha belum sesuai.']);
            $upbjj = config('app.kode_upbjj');
            $masa = SettingModel::get_masa();
            $masa = $masa[0]->masa;
            $tanggal_lahir = $request->input('tanggal_lahir');
            $DPtutor = jadwal_TutorModel::getDPTutorbyIDtgllahir($id, $tanggal_lahir, $upbjj);
            $matakuliahampu = jadwal_TutorModel::getmtkampu($id);
            $kelas = jadwal_TutorModel::getKelas($id);
            $pendidikantutor = jadwal_TutorModel::getPendidikanTutor($id);
            $ajuanmatakuliah = jadwal_TutorModel::getAjuanMatakuliah($masa, $id);
            $pesan = "Data tidak ditemukan";
            if (empty($DPtutor)) {
                return view('pages.jadwal.tutor.tutor_form_tutorial', compact('pesan'));
            } else {
                return view('pages.jadwal.tutor.tutor_form_tutorial', compact('DPtutor', 'matakuliahampu', 'kelas', 'pendidikantutor', 'masa', 'ajuanmatakuliah'));
            }
        }
    }

    public function formtutorial_simpan(Request $request)
    {
        $id = decrypt($request->input('id'));
        $masa = $request->input('masa');
        $kodemtk = $request->input('mtk');
        $nama_mtk = jadwal_TutorModel::getMatakuliah($kodemtk);
        $cek = jadwal_TutorModel::cekMatakuliah($masa, $id, $kodemtk);
        if (!empty($cek)) {
            return redirect()->route('tutor.formtutorial_reload', ['id' => Crypt::encrypt($id)])->with('error', 'Matakuliah Sudah ada...');
        } else {
            $data = array(
                'idtutor' => $id,
                'masa' => $masa,
                'kode_mtk' => $kodemtk,
                'nama_matakuliah' => $nama_mtk[0]->nama_mtk,
            );
            jadwal_TutorModel::insert($data);
        }
        return redirect()->route('tutor.formtutorial_reload', ['id' => Crypt::encrypt($id)])->with('success', 'Matakuliah Berhasil Tersimpan');
    }

    public function formtutorial_hapus($idmtk, $id)
    {
        $idmtk = decrypt($idmtk);
        $id = decrypt($id);
        jadwal_TutorModel::hapusmtk($idmtk);
        return redirect()->route('tutor.formtutorial_reload', ['id' => Crypt::encrypt($id)])->with('warning', 'Matakuliah Berhasil dihapus');
    }

    public function formtutorial_pdf($id, $masa, $t)
    {
        $id = decrypt($id);
        $masa = decrypt($masa);
        if ($t == 'view') {
            $file = ('storage/berkas_tutor/' . $masa . '/' . $masa . $id . '.pdf');
            if (file_exists($file)) {
                return Response::make(file_get_contents($file), 200, [
                    'content-type' => 'application/pdf',
                ]);
            } else {
                return redirect()->route('tutor.formtutorial_reload', ['id' => Crypt::encrypt($id)])->with('error', 'File tidak ditemukan');
            }
        }
        if ($t == 'pdf') {
            $upbjj = config('app.kode_upbjj');
            $DPtutor = jadwal_TutorModel::getDPTutorbyID($id, $upbjj);
            $ajuanmatakuliah = jadwal_TutorModel::getAjuanMatakuliah($masa, $id);
            $pdf = null;
            $pages = \View::make('pages.jadwal.tutor.pdf_form_tutorial', compact('masa', 'DPtutor', 'ajuanmatakuliah'))->render();
            $pdf = \App::make('snappy.pdf.wrapper');
            $pdf->loadHTML($pages)
                ->setOption('page-size', 'A4')
                ->setOrientation('portrait')
                ->setOption('no-background', false)
                ->setOption('background', true)
                ->setOption('disable-javascript', true)
                ->setOption('print-media-type', true)
                ->setOption('margin-bottom', 0)
                ->setOption('margin-left', 0)
                ->setOption('margin-right', 0)
                ->setOption('margin-top', 10)
                ->setOption('encoding', 'utf-8');
            return $pdf->inline($id . '.pdf');
        }
    }

    public function formtutorial_upload(Request $request)
    {
        $id = decrypt($request->input('mid'));
        $masa = decrypt($request->input('mmasa'));

        $file_1 = $request->file('file_1');
        $path = ('storage/berkas_tutor/' . $masa);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        try {
            if (!empty($file_1)) {
                if ($request->hasFile('file_1')) {
                    $extension = $request->file('file_1')->getClientOriginalExtension();
                    if ($extension != 'pdf') {
                        return redirect()->route('tutor.formtutorial_reload', ['id' => Crypt::encrypt($id)])->with(['error' => ' File tidak sesuai, file diunggah harus PDF']);
                    }
                    $file = $masa . $id . '.' . $extension;
                    $request->file('file_1')->storeAs($path, $file);
                    $file_1->move($path, $file);
                }
            }
            return redirect()->route('tutor.formtutorial_reload', ['id' => Crypt::encrypt($id)])->with('success', 'File berhasil di unggah');
        } catch (\Illuminate\Database\QueryException $exception) {
            return redirect()->route('tutor.formtutorial_reload', ['id' => Crypt::encrypt($id)])->with('warning', 'File GAGAL di unggah');
        }
    }
}


