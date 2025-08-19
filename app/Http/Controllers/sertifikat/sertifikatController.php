<?php

namespace App\Http\Controllers\sertifikat;

use App\Http\Controllers\Controller;
use App\Imports\SertifikatImport;
use App\Models\sertifikat\sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class sertifikatController extends Controller
{
    public function __construct()
    {
        $this->middleware('roleadmin:admi:')->except('sertifikat_index', 'sertifikat_pdf', 'sertifikat_find');
    }

    public function sertifikat_index()
    {
        return view('pages.sertifikat.sertifikat_search');
    }

    public function sertifikat_find(Request $request)
    {
        $this->validate($request, [
            'captcha' => 'required|captcha'
        ],
            ['captcha.captcha' => 'Kode captcha belum sesuai.']);
        $id = addslashes($request->input('id'));
        $hasil = sertifikat::get_data_sertifikat($id);
        if (!empty($hasil)) {
            return view('pages.sertifikat.sertifikat_search', compact('hasil'));
        } else {
            return redirect('sertifikat')->with(['warning' => 'Data tidak ditemukan']);
        }
    }

    public function sertifikat_pdf($id)
    {
        $id = decrypt($id);
        $hasil = sertifikat::getsertifikatByID($id);
        if (empty($hasil)) {
            return redirect()->back();
        } else {
            $xy_nama = $hasil[0]->xy_nama;
            $xy_sebagai = $hasil[0]->xy_sebagai;
            $nama = $hasil[0]->nama;
            $nim = $hasil[0]->nim;
            $sebagai = $hasil[0]->sebagai;
            $nama_file_1 = $hasil[0]->nama_file_1;
            $nama_file_2 = $hasil[0]->nama_file_2;
            $color = $hasil[0]->color;
            $pages = array();
            if (!empty($nama_file_1)) {
                $pages[] = \View::make('pages.sertifikat.pdf_sertifikat_ut_template_center', compact('xy_nama', 'xy_sebagai', 'nama', 'sebagai', 'nama_file_1', 'color','nim'))->render();
            }
            if (!empty($nama_file_2)) {
                $pages[] = \View::make('pages.sertifikat.pdf_sertifikat_ut_template_center', compact('nama_file_2', 'color'))->render();
            }
            $pdf = \App::make('snappy.pdf.wrapper');
            $pdf->loadHTML($pages)
                ->setOption('page-size', 'A4')
                ->setOrientation('landscape')
                ->setOption('no-background', false)
                ->setOption('background', true)
                ->setOption('disable-javascript', true)
                ->setOption('print-media-type', true)
                ->setOption('margin-bottom', 0)
                ->setOption('margin-left', 0)
                ->setOption('margin-right', 0)
                ->setOption('margin-top', 0)
                ->setOption('encoding', 'utf-8')
                ->setOption('disable-smart-shrinking', true);
            return $pdf->inline($id . '.pdf');
        }
    }

    public function sertifikat_konfigurasi(Request $request)
    {

        $getSertifikat = sertifikat::getsertifikatAll();
        $id_sertifikat = '0';
        if (!empty($getSertifikat)) {
            return view('pages.sertifikat.sertifikat_konfigurasi', compact('getSertifikat', 'id_sertifikat'));
        } else {

            return view('pages.sertifikat.sertifikat_konfigurasi');
        }
    }


    public function sertifikat_new(Request $request)
    {
        $id = $request->input('id_sertifikat');
        $data = array(
            'jenis_kegiatan' => $request->input('jenis_kegiatan'),
            'nama_kegiatan' => $request->input('nama_kegiatan'),
            'xy_nama' => $request->input('xy_nama'),
            'xy_sebagai' => $request->input('xy_sebagai'),
            'color' => $request->input('warna'),
//            'tanggal_buka' => $request->input('tanggal_buka') . ' ' . $request->input('jam_buka'),
//            'tanggal_tutup' => $request->input('tanggal_tutup') . ' ' . $request->input('jam_tutup'),
//            'jam_buka' => $request->input('jam_buka'),
//            'jam_tutup' => $request->input('jam_tutup'),
        );

        if ($id > 0) {
            $query = sertifikat::update_datasertifikatkonfigurasi($id, $data);
            return redirect()->back()->with(['success' => 'Data Berhasil di perbaiki']);
        } else {
            $id = sertifikat::insert_sertifikatkonfigurasi($data);
            $request->validate([
                'file' => ['required', 'max:5000'],
                'file_2' => ['required', 'max:5000']
            ]);
            if ($request->hasFile('file')) {
                $extension = $request->file('file')->getClientOriginalExtension();
                $fileNameToStore = $id . '.' . $extension;
                $request->file('file')->storeAs('public/template_seminar', $fileNameToStore);
                $data_file = array(
                    'nama_file_1' => $fileNameToStore,
                );
                $update = sertifikat::update_sertifikatkonfigurasi($id, $data_file);
            }
            return redirect()->back()->with(['success' => 'Data Tersimpan']);
        }

    }

    public function sertifikat_import_view(Request $request)
    {
        $id_sertifikat = '0';
        $getSertifikat = sertifikat::getsertifikatAll();
        if (!empty($getSertifikat)) {
            return view('pages.sertifikat.sertifikat_import_peserta', compact('getSertifikat', 'id_sertifikat'));
        } else {
            return redirect(route('sertifikat'))->with(['warning' => 'Belum ada Data Sertifikat']);
        }
    }

    public function sertifikat_import_reload($id)
    {
        $id = decrypt($id);
        $id_sertifikat = $id;
        $getSertifikat = sertifikat::getsertifikatAll();
        $hasil = sertifikat::getsertifikatByID_Sertifikat($id);
        if (!empty($getSertifikat)) {
            return view('pages.sertifikat.sertifikat_import_peserta', compact('getSertifikat', 'id_sertifikat', 'hasil'))->with(['success' => 'Data berhasi dihapus']);;
        } else {
            return redirect(route('sertifikat'))->with(['warning' => 'Belum ada Data Sertifikat']);
        }

    }

    public function sertifikat_import_select(Request $request)
    {

        $id = $request->input('option');
        $id_sertifikat = $id;
        if (empty($id)) {
            return redirect(route('sertifikat.import.view'))->with(['info' => 'Data Kegiatan Belum di pilih...']);
        }
        $getSertifikat = sertifikat::getsertifikatAll();
        $hasil = sertifikat::getsertifikatByID_Sertifikat($id);
        if (!empty($getSertifikat)) {
            return view('pages.sertifikat.sertifikat_import_peserta', compact('getSertifikat', 'hasil', 'id_sertifikat'));
        } else {
            return redirect(route('sertifikat.import.view'))->with(['warning' => 'Belum ada Data Sertifikat']);
        }
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        // membuat nama file unik
        $nama_file = $file->hashName();

        //temporary file
        $path = $file->storeAs('public/excel/', $nama_file);

        // import data
        $import = Excel::import(new SertifikatImport(), storage_path('app/public/excel/' . $nama_file));

        //remove from server
        Storage::delete($path);

        if ($import) {
            //redirect
            return redirect()->route('sertifikat.import.view')->with(['success' => 'Data Berhasil Diimport!']);
        } else {
            //redirect
            return redirect()->route('sertifikat.import.view')->with(['error' => 'Data Gagal Diimport!']);
        }
    }

    public function sertifikat_hapus_peserta($id, $id_sertifikat)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            try {
                sertifikat::deletePeserta($id);
                return redirect('sertifikat/import/' . $id_sertifikat . '/reload')->with(['success' => 'Data berhasi dihapus']);
            } catch (\Illuminate\Database\QueryException $exception) {
                return redirect()->route('sertifikat.import.view')->with(['error' => 'Error hapus data peserta']);
            }
        } else {
            return redirect()->route('sertifikat.import.view')->with(['error' => 'Gagal menghapus data']);
        }

    }

    public function sertifikat_hapus_conf($id_sertifikat)
    {
        if (Auth::check()) {
            $id = decrypt($id_sertifikat);
            try {
                sertifikat::deleteConf($id);
                return redirect('sertifikat/conf')->with(['success' => 'Data berhasi dihapus']);
            } catch (\Illuminate\Database\QueryException $exception) {
                return redirect('sertifikat/conf')->with(['warning' => 'Error, Data tidak dapat dihapus']);
            }
        } else {
            return redirect()->back()->with(['error' => 'Gagal menghapus data']);
        }

    }

    public function sertifikat_hapus_file($id1, $id2, $id3)
    {
        $id_sertifikat = decrypt($id1);
        $nama_file = decrypt($id2);
        $jenis = $id3;
        if (!empty($id_sertifikat)) {
            if ($jenis == 'file_1') {
                $data = array(
                    'nama_file_1' => NULL,
                );
                sertifikat::update_nama_file($id_sertifikat, $data);
            }
            if ($jenis == 'file_2') {
                $data = array(
                    'nama_file_2' => NULL,
                );
                sertifikat::update_nama_file($id_sertifikat, $data);
            }
            return redirect()->back()->with('success', 'File berhasil dihapus...');
        } else {
            return redirect()->back()->with('success', 'File Gagal dihapus...');
        }

    }

    public function sertifikat_new_peserta(Request $request)
    {
        $data = array(
            'id_sertifikat' => $request->input('id_sertifikat'),
            'nim' => $request->input('nim'),
            'nama' => $request->input('nama'),
            'institusi' => $request->input('institusi'),
            'hp' => $request->input('hp'),
            'sebagai' => $request->input('sebagai'),
            'flag' => 1,
        );
        $id_sertifikat = Crypt::encrypt($request->input('id_sertifikat'));
        sertifikat::insert_sertifikatpeserta($data);
        return redirect('sertifikat/import/' . $id_sertifikat . '/reload')->with(['success' => 'Data ' . $request->input('nama') . ' berhasi tersimpan']);
    }

    public function sertifikat_preview($id1, $id2)
    {
        $type = $id2;
        if ($type == 'sertifikattemplate') {
            $file = decrypt($id1);
            if (file_exists(public_path('storage/template_seminar/' . $file))) {
                $img = file_get_contents(public_path('storage/template_seminar/' . $file));
                $header = array(
                    'Content-Type', 'image/png',
                );
                return response($img)->header('Content-Type', 'image/png');
            } else {
                return redirect()->back()->with(['warning' => 'File Template tidak ditemukan']);
            }
        }

    }

    public function sertifikat_upload_template(Request $request)
    {
        $id = decrypt($request->input('mid_sertifikat'));
//        dd($id);
//        $request->validate([
//            'file_1' => ['required', 'max:5000'],
//            'file_2' => ['required', 'max:5000']
//        ]);
        $file_1 = $request->file('file_1');
        $file_2 = $request->file('file_2');
        try {
            if (!empty($file_1)) {
                if ($request->hasFile('file_1')) {
                    $extension = $request->file('file_1')->getClientOriginalExtension();
                    $file = $id . '.' . $extension;
                    $request->file('file_1')->storeAs('public/template_seminar', $file);
                    $data_file = array(
                        'nama_file_1' => $file,
                    );
                    sertifikat::update_sertifikatkonfigurasi($id, $data_file);

                }
            }
            if (!empty($file_2)) {

                if ($request->hasFile('file_2')) {
                    $extension = $request->file('file_2')->getClientOriginalExtension();
                    $file = $id . '_2' . '.' . $extension;
                    $request->file('file_2')->storeAs('public/template_seminar', $file);
                    $data_file = array(
                        'nama_file_2' => $file,
                    );
                    sertifikat::update_sertifikatkonfigurasi($id, $data_file);
                }
            }
            return redirect('sertifikat/conf')->with(['success' => 'File berhasil di unggah']);
        } catch (\Illuminate\Database\QueryException $exception) {
            return redirect('sertifikat/conf')->with(['warning' => 'File GAGAL di unggah']);
        }
    }
}
