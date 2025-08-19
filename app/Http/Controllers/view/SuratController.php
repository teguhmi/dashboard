<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use App\Http\Controllers\srs\QuerySRSController;
use App\Models\ujian\NumpangUjianKeluarModel;
use App\Models\view\SuratModel;
use Illuminate\Support\Facades\Crypt;


class SuratController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');

    }

    public function index($id,$jenis)
    {
        $id = base64_decode($id);
        $jenis = base64_decode($jenis);


        if($jenis == 'numpang') {
            $surat = SuratModel::getnumpang($id);
            if(!empty($surat)) {
                $nim = $surat[0]->nim;
                $masa = $surat[0]->masa;
                $id_surat = $surat[0]->id_surat;
                $sql = NumpangUjianKeluarModel::getDataNumpagUjian($nim, $masa);
                $jenissurat = SuratModel::getjenissurat($id_surat);
                $DPMahasiswa = QuerySRSController::getdpbynim($nim);
            }
            return view('pages.layanan.view.view_surat_numpang_ujian',compact('surat','sql','jenissurat','masa','DPMahasiswa'));
        } else {
            return redirect('home');
        }

    }


}
