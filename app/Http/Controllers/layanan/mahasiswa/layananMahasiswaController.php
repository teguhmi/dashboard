<?php

namespace App\Http\Controllers\layanan\mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Controllers\srs\QuerySRSController;
use App\Models\layanan\mahasiswa\layanan_MahasiswaModel;
use App\Models\srs\QuerySRS5G;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Image;

class layananMahasiswaController extends Controller
{
    public function index()
    {
        return view('pages.layanan.mahasiswa.mahasiswa_home');
    }

    public function index_layanan(Request $request)
    {
        $requestIP = $request->ip();

        $whitelist = collect([
            '127.0.0.1',
            '172.16.36.55/27'
        ]);

        if ($whitelist->contains($request->ip())) {
            return redirect()->route('home');
        }


        $nim = $request->input('nim');
        $token = $request->input('_token');
        $tgl_lahir = $request->input('tgl_lahir');

//        $nik = $request->input('nik');
        if (!empty($nim)) {
            try {
                $this->validate($request, [
                    'captcha' => 'required|captcha'
                ],
                    ['captcha.captcha' => 'Kode captcha belum sesuai.']);
            } catch (ValidationException $e) {

            }
            $DPMahasiswa = QuerySRSController::getdpbynim($nim);
            $jenisLayanan = self::JenisLayanan();

            if (!empty($DPMahasiswa)) {
//                if ($nik != $DPMahasiswa['nik']) {
//                    $pesan = 'Data tidak ditemukan atau belum sesuai';
//                    return view('pages.layanan.mahasiswa.form_layanan_mahasiswa', compact('pesan'));
//                }
//                if ($tgl_lahir != $DPMahasiswa['tanggal_lahir']) {
//                    $pesan = 'Data tidak ditemukan atau belum sesuai';
//                    return view('pages.layanan.mahasiswa.form_layanan_mahasiswa', compact('pesan'));
//                }

                if ($DPMahasiswa['kode_upbjj'] != config('app.kode_upbjj')) {
                    $pesan = 'Aplikasi ini hanya diperuntukan mahasiswa  ' . config('app.upbjj');
                    return view('pages.layanan.mahasiswa.form_layanan_mahasiswa', compact('pesan'));
                }
                if ($DPMahasiswa['status_dp'] == 'DL') {
                    $pesan = $DPMahasiswa['nama_mahasiswa'] . ' sudah dinyatakan lulus, aplikasi ini hanya untuk mahasiswa aktif';
                    return view('pages.layanan.mahasiswa.form_layanan_mahasiswa', compact('pesan'));
                }
                if ($DPMahasiswa['status_dp'] != 'DA') {
                    $pesan = $DPMahasiswa['nama_mahasiswa'] . ' status bukan mahasiswa aktif, silakah hubungi ' . config('app.upbjj');
                    return view('pages.layanan.mahasiswa.form_layanan_mahasiswa', compact('pesan'));
                }

                $filepath = public_path('storage/foto/' . $DPMahasiswa['nim'] . '/' . $DPMahasiswa['nim'] . '_ktm.jpg');
                $dataLayanan = layanan_MahasiswaModel::getLayananbyNIM($nim);
                if (file_exists($filepath)) {
                    $file_stats = stat($filepath);
                    if ($file_stats) {
                        $tgl_foto = date('d-m-Y', $file_stats["ctime"]);
                        $tgl_foto = Carbon::parse($tgl_foto)->format('Y-m-d');
                        $day = Carbon::now()->format('Y-m-d');
                    }

                    if ($tgl_foto == $day) {
                        $upload = 'false';
                    } else {
                        $upload = 'true';
                    }

                } else {
                    $upload = 'true';
                    $filepath = '';

                }
                return view('pages.layanan.mahasiswa.form_layanan_mahasiswa', compact('jenisLayanan', 'DPMahasiswa', 'upload', 'dataLayanan', 'filepath'));

            } else {

                return view('pages.layanan.mahasiswa.form_layanan_mahasiswa');

            }
        } else {
            return view('pages.layanan.mahasiswa.form_layanan_mahasiswa');
        }
    }

    public function upload_file(Request $request)
    {
        $nim = decrypt($request->input('nim'));
        if (empty($nim)) {
            return redirect()->back()->with(['error' => 'NIM tidak sesuai']);
        } else {
            $DPMahasiswa = QuerySRSController::getdpbynim($nim);
            if (empty($DPMahasiswa)) {
                return redirect()->back()->with(['error' => 'NIM tidak sesuai']);
            } else {
                if ($request->hasFile('foto')) {
                    $file = $request->file('foto');
                    $filename = $DPMahasiswa['nim'] . '_ktm.jpg';
                    $path = public_path('storage/foto/' . $DPMahasiswa['nim']);
                    $ext = $file->extension();
                    $fileSize = filesize($file);
                    $imagedata = getimagesize($file);
                    $width = $imagedata[0];
                    $height = $imagedata[1];
                    if ($ext != 'jpg') {
                        return redirect()->back()->with(['error' => 'File tidak sesuai, file diunggah bukan jpg']);
                    }
                    if ($fileSize > 1048576) {
                        return redirect()->back()->with(['error' => 'File gagal diunggah, Ukuran file lebih dari 1MB']);
                    }
                    if ($width < '354' || $height < '472') {
                        return redirect()->back()->with(['error' => 'Ukuran file tidak sesuai yaitu 3x4 atau 354x472 Pixel']);
                    }
                    if (!is_dir($path)) {
                        mkdir($path, 0777, true);
                    }
                    $img = Image::make($file);
                    $img->resize(354, 472, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->save($path . '/' . $filename);
                    return redirect()->back()->with(['success' => 'Terimakasih,  File berhasil di unggah']);
                } else {
                    return redirect()->back()->with(['error' => 'File tidak ada...']);
                }
            }

        }

    }

    public function uploadCropImage(Request $request)
    {
        $nim = $request->input('nim');
        $DPMahasiswa = QuerySRSController::getdpbynimCrop($nim);
        if (!empty($DPMahasiswa)) {
            $folderPath = public_path('storage/foto/' . $DPMahasiswa['nim']);
            $imageName = $DPMahasiswa['nim'] . '_ktm.jpg';
            $imageFullPath = $folderPath . '/' . $imageName;
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            $image_parts = explode(";base64,", $request->image);
            $image_base64 = base64_decode($image_parts[1]);
//            $image_type_aux = explode("image/", $image_parts[0]);
//            $image_type = $image_type_aux[1];
//            $file = $folderPath . $nim . '.jpg';
            if (file_exists($imageFullPath)) {
                unlink($imageFullPath);
            }
            file_put_contents($imageFullPath, $image_base64);
            $file = $imageFullPath;
            if (!$file) {
                return redirect()->back()->with(['error' => 'Error file image']);
            } else {
                $img = Image::make($file);
                $img->save($imageFullPath);
            }
        } else {
            return redirect()->back()->with(['error' => 'NIM tidak ditemukan']);
        }


    }

    public function simpan(Request $request)
    {

        $nim = decrypt($request->input('nim'));
        $jenis = $request->input('jenis_surat');
        $masa = QuerySRSController::getMasaAktif();
        $masa = $masa['masa'];

        $DPMahasiswa = QuerySRSController::getdpbynim($nim);
        if ($DPMahasiswa['kode_upbjj'] != config('app.kode_upbjj')) {
            $pesan = 'Aplikasi ini hanya diperuntukan mahasiswa ' . config('app.upbjj');
            return view('pages.layanan.mahasiswa.form_layanan_mahasiswa', compact('pesan'));
        }

//        if($jenis == '1') {
        $cekpengajuan = layanan_MahasiswaModel::getLayananbyNIMJenis($nim, $jenis);
//        }
//        if($jenis == '2') {
//            $cekpengajuan = layanan_MahasiswaModel::getLayananbyNIMmasa($nim,$masa,$jenis);
//        }

        if (!empty($cekpengajuan)) {
            return redirect()->back()->with(['warning' => $cekpengajuan[0]->keterangan . ' sudah diajukan sebelumnya']);
        } elseif ($jenis == '2' && !file_exists(public_path('storage/foto/' . $DPMahasiswa['nim'] . '/' . $DPMahasiswa['nim'] . '_ktm.jpg'))) {
            return redirect()->back()->with(['warning' => 'Permohonan gagal di proses, silakan unggah foto terlebih dahulu']);
        } else {
            if ($jenis == '3') {
                $password = 'Ut' . str_replace("/", "", $DPMahasiswa['tanggal_lahir_mahasiswa']);
            } else {
                $password = null;
            }
        }

        $array = array(
            'id_jenis' => $request->input('jenis_surat'),
            'nim' => $DPMahasiswa['nim'],
            'nama_mahasiswa' => $DPMahasiswa['nama_mahasiswa'],
            'handphone' => $request->input('nomor_handphone'),
            'email' => $DPMahasiswa['nim'] . '@ecampus.ut.ac.id',
            'status' => 'baru',
            'password' => $password,
            'masa' => $masa,
            'keluhan' => $request->input(html_entity_decode('txtketerangan')),
        );
        layanan_MahasiswaModel::simpan($array);
        return redirect()->back()->with(['success' => 'Terimakasih, pengajuan telah tersimpan dan akan segera kami proses']);
    }

    public function hapus($id, $jenis)
    {
        if ($jenis == 'hapus') {
            $id = decrypt($id);
            $data_array = array('status' => 'batal');
            layanan_MahasiswaModel::ubah($id, $data_array);
            return redirect()->back()->with(['success' => 'Data Berhasil dibatalkan']);
        } else {
            return redirect()->back()->with(['success' => 'Data Gagal dibatalkan']);
        }

    }

    public static function JenisLayanan()
    {
        $datajenisLayanan = layanan_MahasiswaModel::getDataJenisLayananAll();
        if (!empty($datajenisLayanan)) {
            foreach ($datajenisLayanan as $rows) {
                $now = Carbon::now('Asia/Jakarta')->format('Y-m-d');
                $tanggal_tutup = date($rows->tanggal_tutup);
                $tanggal_buka = date($rows->tanggal_buka);
                if ($tanggal_buka <= $now && $now <= $tanggal_tutup) {
                    $status = 'buka';
                } else {
                    $status = 'tutup';
                }
                if (($rows->flag_operasional == 1 && $status == 'buka') || $rows->flag_operasional == 0 && $rows->flag == 1) {
                    $jenisLayanan[] = array(
                        'id_jenis' => $rows->id_jenis,
                        'jenis' => $rows->jenis,
                        'keterangan' => $rows->keterangan,
                        'flag' => $rows->flag,
                        'urutan' => $rows->urutan,
                        'tanggal_buka' => $rows->tanggal_buka,
                        'tanggal_tutup' => $rows->tanggal_tutup,
                        'flag_operasional' => $rows->flag_operasional,
                    );
                }

            }
        }
        return $jenisLayanan;
    }

    public static function Get_JenisLayanan_by_ID(Request $request)
    {
        $id = $request->input('id');
        if (empty($id)) {
            return redirect(route('home'));
        } else {
            $results = DB::table('kl_jenis_layanan')
                ->where('id_jenis', $id)
                ->get();
            return $results;
        }

    }
}
