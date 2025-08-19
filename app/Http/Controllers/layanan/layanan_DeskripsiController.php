<?php

namespace App\Http\Controllers\layanan;

use App\Http\Controllers\Controller;
use App\Models\layanan\layanan_dataAsalModel;
use App\Models\layanan\layanan_dataDeskripsiModel;
use App\Models\layanan\layanan_dataKategoriModel;
use App\Models\layanan\layanan_dataKPModel;
use App\Models\layanan\layanan_dataPJModel;
use App\Models\layanan\layanan_dataStatusModel;
use App\Models\layanan\layanan_FormModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class layanan_DeskripsiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rolepjb:admin,frontdesk')->except('index');
    }
    public function index()
    {
        $dp = layanan_FormModel::getDPbyNotInDeskripsi();
        $deskripsi = layanan_dataDeskripsiModel::getdeskripsiAll();
        return view('pages.layanan.layanan_data_deskripsi', compact('dp', 'deskripsi'));
    }

    public function index_edit($id1, $id2)
    {
        $id_deskripsi = decrypt($id1);
        $id_data_dp = decrypt($id2);
        $asal = layanan_dataAsalModel::getdataAll();
        $kp = layanan_dataKPModel::getdataAll();
        $kategori = layanan_dataKategoriModel::getdataAll();
        $pj = layanan_dataPJModel::getdataAll();
        $status = layanan_dataStatusModel::getdataAll();
        if (!empty($id_deskripsi)) {
            $dp = layanan_FormModel::getDPbyID($id_data_dp);
            $deskripsi = layanan_dataDeskripsiModel::getdeskripsiIDDeskripsi($id_deskripsi, $id_data_dp);
            return view('pages.layanan.layanan_data_deskripsi_edit', compact('dp', 'deskripsi', 'asal', 'kp', 'kategori', 'pj', 'status'));
        }
    }

    public function update(Request $request)
    {
        $status = $request->input('id2');
        $id_status = $request->input('id4');
        $id_deskripsi = decrypt($request->input('id1'));
        $keterangan = $request->input('keterangan');
        $deskripsi = $request->input('id3');
        if ($keterangan == $deskripsi) {
            return redirect()->back()->with('warning', 'Data Gagal Ditambahkan ' . $status . ' tidak ada perubahan');
        } else {
            try {
                if ($status == 'deskripsi') {
                    $data = array(
                        'deskripsi' => $keterangan,
                    );
                    layanan_dataDeskripsiModel::updateTabelDeskripsi($id_deskripsi, $data);
                }
                if ($status == 'penyebab') {
                    if (empty($keterangan)) {
                        $id_status = '1';
                    }
                    $data = array(
                        'penyebab' => $keterangan,
                        'penyebab_user_create' => Auth::user()->name,
                        'penyebab_user_date' => date('Y-m-d H:i:s'),
                        'id_status' => $id_status,
                    );
                    layanan_dataDeskripsiModel::updateTabelDeskripsi($id_deskripsi, $data);
                }
                if ($status == 'jawaban') {
                    if (empty($keterangan)) {
                        $id_status = '2';
                    }
                    $data = array(
                        'jawaban' => $keterangan,
                        'jawaban_user_create' => Auth::user()->name,
                        'jawaban_user_date' => date('Y-m-d H:i:s'),
                        'id_status' => $id_status,
                    );
                    layanan_dataDeskripsiModel::updateTabelDeskripsi($id_deskripsi, $data);
                }
                return redirect()->back()->with('success', 'Data ' . $status . ' Tersimpan ');
            } catch (\Illuminate\Database\QueryException $exception) {
                return redirect()->back()->with('error', 'Terjadi kesalahan');
//                dd($exception);
            }
        }
    }

    public function update_status($id1)
    {
        $id_deskripsi = decrypt($id1);
        try {
            $data = array(
                'id_status' => '4',
                'status_user_create' => Auth::user()->name,
                'status_user_date' => date('Y-m-d H:i:s'),
            );
            layanan_dataDeskripsiModel::updateTabelDeskripsistatus($id_deskripsi, $data);
            return redirect()->route('layanan.deskripsi.index');
        } catch (\Illuminate\Database\QueryException $exception) {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }

    }
}
