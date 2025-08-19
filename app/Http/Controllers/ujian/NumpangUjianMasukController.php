<?php

namespace App\Http\Controllers\ujian;

use App\Http\Controllers\Controller;
use App\Http\Controllers\srs\QuerySRSController;
use App\Models\SettingModel;
use App\Models\srs\QuerySRS;
use App\Models\ujian\NumpangUjianModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


class NumpangUjianMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('roleadmin');

    }

    public function index()
    {

        return view('pages.ujian.NumpangUjianMasuk');
    }

    public function reload($id)
    {
//        $nim = '045340519';
        $nim = Crypt::decrypt($id);

        $masa = NumpangUjianModel::getMasaUjian();
        $masa = $masa[0]->masa;
        $d20an = NumpangUjianModel::getPesertaUjian($nim, $masa);
        $DPMahasiswa = (new \App\Http\Controllers\srs\QuerySRSController)->getdpbynim($nim);

        $jenis = 'masuk';
        $upbjj = (new \App\Http\Controllers\srs\QuerySRSController)->getupbjj();
        $tpu = NumpangUjianModel::getTPUTujuan($masa, $nim,$jenis);
        $sql = NumpangUjianModel::cekData($nim, $masa, $jenis);
//        $id = '1';
//        $getnomorsurat = NumpangUjianModel::getnomorsurat($masa, $nim, $id);
        $getnomorsurat = '';
        $nomorunit = SettingModel::getnomorsurat($id);
        return view('pages.ujian.NumpangUjianMasuk', compact('sql', 'DPMahasiswa', 'upbjj', 'tpu', 'masa', 'getnomorsurat', 'nomorunit'));
    }

    public function cari(Request $request)
    {
        $nim = $request->input('nim');
        if (empty($nim)) {
            return redirect()->back()->with(['warning' => 'Data tidak ditemukan']);
        } else {
            return redirect()->route('ujian.numpangmasuk.reload', ['id' => Crypt::encrypt($nim)]);
        }
    }

    public function get_d20an($id)
    {
        $nim = Crypt::decrypt($id);
        $masa = NumpangUjianModel::getMasaUjian();
        $masa = $masa[0]->masa;
        $d20an = NumpangUjianModel::getPesertaUjian($nim, $masa);
        $jenis = 'masuk';
//        $cek_data = NumpangUjianKeluarModel::get_DataNumpang_ujian($nim, $masa);
        if (empty($d20an)) {
            return redirect()->back()->with(['warning' => 'Data Ujian pada D20an tidak ditemukan']);
        } else {
            NumpangUjianModel::hapus_mtk_all($nim, $masa);
            foreach ($d20an as $item) {
                if ($item->hari == '1') {
                    if (!empty($item->kode_mtk_1)) {
                        $data_array = array(
                            'masa' => $item->masa,
                            'nim' => $item->nim,
                            'kode_mtk' => $item->kode_mtk_1,
                            'hari' => $item->hari,
                            'jam_ujian' => 1,
                            'jenis' => $jenis,
                            'kode_upbjj_ujian_asal' => $item->ujian_kode_upbjj,
                            'kode_tempat_ujian_asal' => $item->kode_tempat_ujian,
                            'nama_wilayah_ujian_asal' => $item->nama_wilayah_ujian,
                            'user_create' => Auth::user()->name,
                        );
                        NumpangUjianModel::insert($data_array);
                    } else {
                        $data_array = '';
                    }
                    if (!empty($item->kode_mtk_2)) {
                        $data_array = array(
                            'masa' => $item->masa,
                            'nim' => $item->nim,
                            'kode_mtk' => $item->kode_mtk_2,
                            'hari' => $item->hari,
                            'jam_ujian' => 2,
                            'jenis' => $jenis,
                            'kode_upbjj_ujian_asal' => $item->ujian_kode_upbjj,
                            'kode_tempat_ujian_asal' => $item->kode_tempat_ujian,
                            'nama_wilayah_ujian_asal' => $item->nama_wilayah_ujian,
                            'user_create' => Auth::user()->name,
                        );
                        NumpangUjianModel::insert($data_array);
                    } else {
                        $data_array = '';
                    }
                    if (!empty($item->kode_mtk_3)) {
                        $data_array = array(
                            'masa' => $item->masa,
                            'nim' => $item->nim,
                            'kode_mtk' => $item->kode_mtk_3,
                            'hari' => $item->hari,
                            'jam_ujian' => 3,
                            'jenis' => $jenis,
                            'kode_upbjj_ujian_asal' => $item->ujian_kode_upbjj,
                            'kode_tempat_ujian_asal' => $item->kode_tempat_ujian,
                            'nama_wilayah_ujian_asal' => $item->nama_wilayah_ujian,
                            'user_create' => Auth::user()->name,
                        );
                        NumpangUjianModel::insert($data_array);
                    } else {
                        $data_array = '';
                    }
                    if (!empty($item->kode_mtk_4)) {
                        $data_array = array(
                            'masa' => $item->masa,
                            'nim' => $item->nim,
                            'kode_mtk' => $item->kode_mtk_4,
                            'hari' => $item->hari,
                            'jam_ujian' => 4,
                            'jenis' => $jenis,
                            'kode_upbjj_ujian_asal' => $item->ujian_kode_upbjj,
                            'kode_tempat_ujian_asal' => $item->kode_tempat_ujian,
                            'nama_wilayah_ujian_asal' => $item->nama_wilayah_ujian,
                            'user_create' => Auth::user()->name,
                        );
                        NumpangUjianModel::insert($data_array);
                    } else {
                        $data_array = '';
                    }
                    if (!empty($item->kode_mtk_5)) {
                        $data_array = array(
                            'masa' => $item->masa,
                            'nim' => $item->nim,
                            'kode_mtk' => $item->kode_mtk_5,
                            'hari' => $item->hari,
                            'jam_ujian' => 5,
                            'jenis' => $jenis,
                            'kode_upbjj_ujian_asal' => $item->ujian_kode_upbjj,
                            'kode_tempat_ujian_asal' => $item->kode_tempat_ujian,
                            'nama_wilayah_ujian_asal' => $item->nama_wilayah_ujian,
                            'user_create' => Auth::user()->name,
                        );
                        NumpangUjianModel::insert($data_array);
                    } else {
                        $data_array = '';
                    }
                }
                if ($item->hari == '2') {
                    if (!empty($item->kode_mtk_1)) {
                        $data_array = array(
                            'masa' => $item->masa,
                            'nim' => $item->nim,
                            'kode_mtk' => $item->kode_mtk_1,
                            'hari' => $item->hari,
                            'jam_ujian' => 1,
                            'jenis' => $jenis,
                            'kode_upbjj_ujian_asal' => $item->ujian_kode_upbjj,
                            'kode_tempat_ujian_asal' => $item->kode_tempat_ujian,
                            'nama_wilayah_ujian_asal' => $item->nama_wilayah_ujian,
                            'user_create' => Auth::user()->name,
                        );
                        NumpangUjianModel::insert($data_array);
                    } else {
                        $data_array = '';
                    }
                    if (!empty($item->kode_mtk_2)) {
                        $data_array = array(
                            'masa' => $item->masa,
                            'nim' => $item->nim,
                            'kode_mtk' => $item->kode_mtk_2,
                            'hari' => $item->hari,
                            'jam_ujian' => 2,
                            'jenis' => $jenis,
                            'kode_upbjj_ujian_asal' => $item->ujian_kode_upbjj,
                            'kode_tempat_ujian_asal' => $item->kode_tempat_ujian,
                            'nama_wilayah_ujian_asal' => $item->nama_wilayah_ujian,
                            'user_create' => Auth::user()->name,
                        );
                        NumpangUjianModel::insert($data_array);
                    } else {
                        $data_array = '';
                    }
                    if (!empty($item->kode_mtk_3)) {
                        $data_array = array(
                            'masa' => $item->masa,
                            'nim' => $item->nim,
                            'kode_mtk' => $item->kode_mtk_3,
                            'hari' => $item->hari,
                            'jam_ujian' => 3,
                            'jenis' => $jenis,
                            'kode_upbjj_ujian_asal' => $item->ujian_kode_upbjj,
                            'kode_tempat_ujian_asal' => $item->kode_tempat_ujian,
                            'nama_wilayah_ujian_asal' => $item->nama_wilayah_ujian,
                            'user_create' => Auth::user()->name,
                        );
                        NumpangUjianModel::insert($data_array);
                    } else {
                        $data_array = '';
                    }
                    if (!empty($item->kode_mtk_4)) {
                        $data_array = array(
                            'masa' => $item->masa,
                            'nim' => $item->nim,
                            'kode_mtk' => $item->kode_mtk_4,
                            'hari' => $item->hari,
                            'jam_ujian' => 4,
                            'jenis' => $jenis,
                            'kode_upbjj_ujian_asal' => $item->ujian_kode_upbjj,
                            'kode_tempat_ujian_asal' => $item->kode_tempat_ujian,
                            'nama_wilayah_ujian_asal' => $item->nama_wilayah_ujian,
                            'user_create' => Auth::user()->name,
                        );
                        NumpangUjianModel::insert($data_array);
                    } else {
                        $data_array = '';
                    }
                    if (!empty($item->kode_mtk_5)) {
                        $data_array = array(
                            'masa' => $item->masa,
                            'nim' => $item->nim,
                            'kode_mtk' => $item->kode_mtk_5,
                            'hari' => $item->hari,
                            'jam_ujian' => 5,
                            'jenis' => $jenis,
                            'kode_upbjj_ujian_asal' => $item->ujian_kode_upbjj,
                            'kode_tempat_ujian_asal' => $item->kode_tempat_ujian,
                            'nama_wilayah_ujian_asal' => $item->nama_wilayah_ujian,
                            'user_create' => Auth::user()->name,
                        );
                        NumpangUjianModel::insert($data_array);
                    } else {
                        $data_array = '';
                    }
                }
            }
            return redirect()->route('ujian.numpangmasuk.reload', ['id' => Crypt::encrypt($nim)]);
        }
    }

    public function del_numpang($id1, $id2)
    {
        $nim = Crypt::decrypt($id1);
        $id = Crypt::decrypt($id2);
        NumpangUjianModel::hapus_mtk($id);
        return redirect()->route('ujian.numpangmasuk.reload', ['id' => Crypt::encrypt($nim)]);
    }

    public function del_tpu($id1, $id2)
    {
        $nim = Crypt::decrypt($id1);
        $id = Crypt::decrypt($id2);
        NumpangUjianModel::hapus_tpu($id);
        return redirect()->route('ujian.numpangmasuk.reload', ['id' => Crypt::encrypt($nim)]);
    }
}
