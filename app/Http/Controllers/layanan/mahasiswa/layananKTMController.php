<?php

namespace App\Http\Controllers\layanan\mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\layanan\mahasiswa\layanan_KTMModel;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Crypt;
use ZipArchive;

class layananKTMController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rolepjb:admin,frontdesk')->except('index');
    }

    public function index(Request $request)
    {
        $jenis = $request->input('jenis');
        $status = $request->input('status');

        if ($jenis == 'ktm') {
            $sql = layanan_KTMModel::getPermohonanKTMbyStatus($status);
            if (empty($sql)) {
                return redirect()->back()->with('Error', 'Data tidak ditemukan');
            }
            return view('pages.layanan.mahasiswa.form_layanan_KTM', compact('sql'));
        } else {
            return view('pages.layanan.mahasiswa.form_layanan_KTM');
        }

    }

    public function reload($jenis, $status)
    {
        $jenis = Crypt::decrypt($jenis);
        $status = Crypt::decrypt($status);

        if ($jenis == 'ktm') {
            $sql = layanan_KTMModel::getPermohonanKTMbyStatus($status);
            if (empty($sql)) {
                return redirect()->back()->with('Error', 'Data tidak ditemukan');
            }
            return view('pages.layanan.mahasiswa.form_layanan_KTM', compact('sql'));
        }
    }

    public function validasi($id, $jenis)
    {
        $id = Crypt::decrypt($id);
        if ($jenis == 'valid') {
            $data_array = array(
                'status' => 'proses',
                'flag_foto' => '1',
                'keterangan' => NULL,
            );
        }
        if ($jenis == 'bs') {
            $data_array = array(
                'status' => 'gagal',
                'flag_foto' => '0',
                'keterangan' => 'Foto Belum sesuai ketentuan, info WA: 081586762727',
            );
        }
        layanan_KTMModel::update_ktm($id, $data_array);
//        return redirect()->back()->with('success', 'Data berhasil diperbaharui');
        $jenis = 'ktm';
        $status = 'baru';
        return redirect()->route('layanan.ktm.reload',['jenis'=> Crypt::encrypt($jenis),'status'=>Crypt::encrypt($status)])->with(['success' => 'Data berhasil diperbaharui']);
    }

    public function UnduhFile($id)
    {
        try {
            $status = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            //
        }
        $hasil = layanan_KTMModel::getPermohonanKTMbyStatus($status);
        $zip = new ZipArchive();
        $namafile = 'KTM_' . $status . '_' . date('d-m-Y_h-i-s') . '.zip';
        $zipFile = public_path('storage/tmp/' . $namafile);
        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            foreach ($hasil as $key) {
                $nim = $key->nim;
                $file =  public_path ('storage/foto/' . $nim . '/' . $nim . '_ktm.jpg');
                if (file_exists($file)) {
                    $relativeNameInZipFile = basename($nim . '.jpg');
                    $zip->addFile($file, $relativeNameInZipFile);

                }
            }
        }
        $zip->close();
        $headers = array('Content-Type' => 'application/zip',);
        return response()->download($zipFile, $namafile, $headers);

    }
}
