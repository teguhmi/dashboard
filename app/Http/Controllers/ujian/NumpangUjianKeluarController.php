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

class NumpangUjianKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('roleadmin');

    }

    public function index()
    {

        return view('pages.ujian.NumpangUjianKeluar');
    }

    public function cari1(Request $request)
    {
//        $nim = '045340519';
//        $masa = '20231';
//        $sql = NumpangUjianModel::getPesertaUjian($nim, $masa);
//        dd($sql);
    }

    public function cariTPU(Request $request)
    {
        $upbjj = $request->input('idupbjj');

        if (empty($upbjj)) {
            $upbjj = $request->input('upbjj');
        }

        $hasil = "<option value='0' disabled selected>Pilih Lokasi Ujian</option>";
        $query = NumpangUjianModel::getTPU($upbjj);
        foreach ($query as $data) {
            $hasil .= "<option value='$data->kode_wilayah_ujian'>$data->nama_wilayah_ujian </option>";
        }
        return $hasil;

    }

    public function insertTPUTujuan(Request $request)
    {
        $tpu = $request->input('tpu');
        $nim = $request->input('nim');
        $masa = $request->input('masa');
        $upbjj = $request->input('upbjj');
        $hari = $request->input('hari');
        $jenis = $request->input('jenis');

        $u = QuerySRSController::getupbjj();
        $a = NumpangUjianModel::getTPU($upbjj);
        $DPMahasiswa = QuerySRSController::getdpbynim($nim);
        if (empty($DPMahasiswa)) {
            return redirect()->back()->with(['warning' => 'NIM tidak ditemukan']);
        }
        foreach ($u->data->dataUpbjj as $item) {
            if ($upbjj == $item->kode_upbjj) {
                $kodeupbjj = $item->kode_upbjj;
                $namaupbjj = $item->nama_upbjj;
            }
        }
        foreach ($a as $item) {
            if ($tpu == $item->kode_wilayah_ujian) {
                $kode_wilayah_ujian = $item->kode_wilayah_ujian;
                $nama_wilayah_ujian = $item->nama_wilayah_ujian;
            }
        }
        if (empty($tpu)) {
            return redirect()->back()->with(['warning' => 'Tempat Ujian belum dipilih']);
        } else {
            $cek = NumpangUjianModel::cekTPUTujuan($masa, $nim, $hari);
            if (empty($cek)) {
                $data_array = array(
                    'masa' => $masa,
                    'hari' => $hari,
                    'nim' => $nim,
                    'nama_mahasiswa' => $DPMahasiswa['nama_mahasiswa'],
                    'kode_upbjj_ujian_tujuan' => $kodeupbjj,
                    'nama_upbjj_ujian_tujuan' => $namaupbjj,
                    'kode_tempat_ujian_tujuan' => $kode_wilayah_ujian,
                    'nama_wilayah_ujian_tujuan' => $nama_wilayah_ujian,
                    'jenis' => $jenis,
                    'user_create' => Auth::user()->name,
                );
                NumpangUjianModel::insertTPUTujuan($data_array);

            } else {
                $id = $cek[0]->id;
                $data_array = array(
                    'masa' => $masa,
                    'hari' => $hari,
                    'kode_upbjj_ujian_tujuan' => $kodeupbjj,
                    'nama_upbjj_ujian_tujuan' => $namaupbjj,
                    'kode_tempat_ujian_tujuan' => $kode_wilayah_ujian,
                    'nama_wilayah_ujian_tujuan' => $nama_wilayah_ujian,
                    'jenis' => $jenis,
                );
                NumpangUjianModel::updateTPUTujuan($id, $data_array);
            }
        }
        return redirect()->back()->with(['success' => 'Tempat Ujian berhasil tersimpan']);
    }

    public function reload($id)
    {
//        $nim = '045340519';
        $nim = Crypt::decrypt($id);
        $masa = NumpangUjianModel::getMasaUjian();
        $masa = $masa[0]->masa;
        $d20an = NumpangUjianModel::getPesertaUjian($nim, $masa);
        $DPMahasiswa = QuerySRSController::getdpbynim($nim);
        if(empty($DPMahasiswa)) {
            return redirect()->back()->with(['warning' => 'Data tidak ditemukan atau NIM salah']);
        } elseif($DPMahasiswa['kode_upbjj'] != config('app.kode_upbjj')) {
            return redirect()->back()->with(['warning' => 'Bukan mahasiswa ' . config('app.upbjj')]);
        }
        $jenis = 'keluar';
        $upbjj = QuerySRSController::getupbjj();
        $tpu = NumpangUjianModel::getTPUTujuan($masa, $nim, $jenis);
        $sql = NumpangUjianModel::cekData($nim, $masa, $jenis);
        $id = '1';
        $getnomorsurat = NumpangUjianModel::getnomorsurat($masa, $nim, $id);
        $nomorunit = SettingModel::getnomorsurat($id);
        return view('pages.ujian.NumpangUjianKeluar', compact('sql', 'DPMahasiswa', 'upbjj', 'tpu', 'masa', 'getnomorsurat', 'nomorunit'));
    }

    public function cari(Request $request)
    {
        $nim = $request->input('nim');
        if (empty($nim)) {
            return redirect()->back()->with(['warning' => 'Data tidak ditemukan']);
        } else {
            return redirect()->route('ujian.numpangkeluar.reload', ['id' => Crypt::encrypt($nim)]);
        }
    }

    public function get_d20an($id)
    {
        $nim = Crypt::decrypt($id);
        $masa = NumpangUjianModel::getMasaUjian();
        $masa = $masa[0]->masa;
        $d20an = NumpangUjianModel::getPesertaUjian($nim, $masa);
        $jenis = 'keluar';
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
                        );
                        NumpangUjianModel::insert($data_array);
                    } else {
                        $data_array = '';
                    }
                }
            }
            return redirect()->route('ujian.numpangkeluar.reload', ['id' => Crypt::encrypt($nim)]);
        }
    }

    public function del_numpang($id1, $id2)
    {
        $nim = Crypt::decrypt($id1);
        $id = Crypt::decrypt($id2);
        NumpangUjianModel::hapus_mtk($id);
        return redirect()->route('ujian.numpangkeluar.reload', ['id' => Crypt::encrypt($nim)]);
    }

    public function del_tpu($id1, $id2)
    {
        $nim = Crypt::decrypt($id1);
        $id = Crypt::decrypt($id2);
        NumpangUjianModel::hapus_tpu($id);
        return redirect()->route('ujian.numpangkeluar.reload', ['id' => Crypt::encrypt($nim)]);
    }

    public function print_surat($id1, $id2)
    {
        $nim = Crypt::decrypt($id1);
        $masa = Crypt::decrypt($id2);
        $sql = NumpangUjianModel::getDataNumpagUjian($nim, $masa);
        if (empty($sql)) {
            return redirect()->back()->with(['error' => ' Gagal proses Surat, perhatikan kembali Hari Ujian dengan Matakuliah pilihan']);
        }
        $kode_upbjj = $sql[0]->kode_upbjj_ujian_tujuan;
        $upbjj = QuerySRSController::getupbjjbyKodeUPBJJ($kode_upbjj);
//        $kop = QuerySRS::getkopsurat();
        $DPMahasiswa = QuerySRSController::getdpbynim($nim);

//return view('pages.ujian.pdf.pdf_surat_numpang_ujian',compact('sql','DPMahasiswa','masa'));
        $id = '1';
        $getnomorsurat = NumpangUjianModel::getnomorsurat($masa, $nim, $id);
        $id_surat = $getnomorsurat[0]->id;
        $qr = $getnomorsurat[0]->penandatangan . "\n" . secure_url('/view/surat/' . base64_encode($id_surat)) . '/' . base64_encode('numpang') . "\n";
        $pages = \View::make('pages.ujian.pdf.pdf_surat_numpang_ujian', compact('sql', 'DPMahasiswa', 'masa', 'upbjj', 'qr', 'getnomorsurat'))->render();

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
            ->setOption('margin-top', 5)
            ->setOption('encoding', 'utf-8')
            ->setOption('disable-smart-shrinking', true);
        return $pdf->inline( 'numpang_' . $masa . '_' . $DPMahasiswa['nama_mahasiswa'] . '_' . $DPMahasiswa['nama_mahasiswa'] . '_.pdf');

    }

    public function simpan_nomorsurat(Request $request)
    {
        $nim = $request->input('nim');
        $masa = $request->input('masa');
        $nomor = $request->input('nomor');
        $unit = $request->input('unit');
        $ids = $request->input('ids');
        $kop = QuerySRS::getkopsurat();
        if ($ids > 0) {
            $data_array = array(
                'nomor_surat' => 'B/' . $nomor . $unit,
                'nomor_handphone' => $request->input('hp'),
                'email' => $request->input('email'),
            );
            NumpangUjianModel::updateNomorSurat($data_array, $ids);
        } else {
            $data_array = array(
                'id_surat' => '1',
                'masa' => $masa,
                'nim' => $nim,
                'nomor_surat' => 'B/' . $nomor . $unit,
                'nomor_handphone' => $request->input('hp'),
                'email' => $request->input('email'),
                'penandatangan' => $kop[0]->penandatangan,
                'nama_penandatangan' => $kop[0]->nama_penandatangan,
                'nip_penandatangan' => $kop[0]->nip_penandatangan,
                'tanggal_surat' => date('Y-m-d'),
                'baris_kop_1' => $kop[0]->baris_kop_1,
                'baris_kop_2' => $kop[0]->baris_kop_2,
                'baris_kop_3' => $kop[0]->baris_kop_3,
                'baris_kop_4' => $kop[0]->baris_kop_4,
                'baris_kop_5' => $kop[0]->baris_kop_5,
                'baris_kop_6' => $kop[0]->baris_kop_6,
                'baris_kop_7' => $kop[0]->baris_kop_7,
                'baris_kop_8' => $kop[0]->baris_kop_8,
                'baris_kop_9' => $kop[0]->baris_kop_9,
                'user_create' => Auth::user()->name,

            );
            NumpangUjianModel::insertNomorSurat($data_array);
        }

        return redirect()->route('ujian.numpangkeluar.reload', ['id' => Crypt::encrypt($nim)]);
    }

//    public function laporan_numpang_keluar(Request $request,$jenis) {
//        $id = $request->input('id');
//        if(empty($id)) {
//           return view('pages.ujian.Laporan_PesertaNumpangKeluar',compact('jenis'));
//        } else {
//            if($jenis == 'daftarnumpang') {
//                $sql = NumpangUjianModel::get_DataNumpangUjian($id);
//            }
//
//            return view('pages.ujian.Laporan_PesertaNumpangKeluar',compact('sql','jenis'));
//        }
//    }
}
