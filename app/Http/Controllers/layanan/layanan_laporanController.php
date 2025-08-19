<?php

namespace App\Http\Controllers\layanan;

use App\Http\Controllers\Controller;
use App\Models\layanan\layanan_Laporan_Model;
use Illuminate\Http\Request;

class layanan_laporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $datastatus = layanan_Laporan_Model::getDataStatus();
//        $sql = layanan_Laporan_Model::getDataAll();
        return view('pages.layanan.layanan_laporan', compact('datastatus'));
    }


    public function search(Request $request)
    {
        $data = $request->all();
        $awal = $request->input('tanggal_awal');
        $akhir = $request->input('tanggal_akhir');
        $status = $request->input('status');
        if (!empty($status)) {
            $sql = layanan_Laporan_Model::getDataByStatus($status);
        } else {
            $sql = layanan_Laporan_Model::getDataByDate($awal, $akhir);
        }
        $datastatus = layanan_Laporan_Model::getDataStatus();
        return view('pages.layanan.layanan_laporan', compact('sql', 'datastatus'));

    }

    public function index_iso()
    {
        $awal = '';
        $akhir = '';
        $jenis ='';
        return view('pages.layanan.layanan_laporan_iso',compact('jenis', 'awal', 'akhir'));
    }

    public function search_iso(Request $request)
    {
        $awal = $request->input('tanggal_awal');
        $akhir = $request->input('tanggal_akhir');
        $jenis = $request->input('iso');
        if(empty($awal || $akhir || $jenis)) {
            return redirect()->back()->with("error","Terdapat data yang belum Terisi");
        } else {
            $sql = layanan_Laporan_Model::getDataByDate($awal, $akhir);
            return view('pages.layanan.layanan_laporan_iso', compact('sql', 'jenis', 'awal', 'akhir'));
        }

    }

    public function pdf_iso($id1, $id2, $id3)
    {
        $jenis = decrypt($id1);
        $awal = $id2;
        $akhir = $id3;

        $sql = layanan_Laporan_Model::getDataByDate($awal, $akhir);
        if (empty($sql)) {
            return redirect()->back();
        }
        if ($jenis == 'rk20') {
            $view = \View::make('pages.layanan.pdf.JJ03RK02RII0', compact('sql','awal','akhir'))->render();
        }
        if ($jenis == 'rk21') {
            $view = \View::make('pages.layanan.pdf.JJ03RK02RII1', compact('sql','awal','akhir'))->render();
        }
        if ($jenis == 'rk60') {
            $view = \View::make('pages.layanan.pdf.JJ03RK06RII0', compact('sql','awal','akhir'))->render();
        }
        if ($jenis == 'rk61') {
            $view = \View::make('pages.layanan.pdf.JJ03RK06RII1', compact('sql','awal','akhir'))->render();
        }


        $pdf = \App::make('snappy.pdf.wrapper');
        $pdf->loadHTML($view)
            ->setOption('page-size', 'LEGAL')
            ->setOrientation('landscape')
            ->setOption('encoding', 'UTF-8')
            ->setOption('margin-top', '10')
            ->setOption('margin-bottom', '15')
            ->setOption('margin-left', '15')
            ->setOption('margin-right', '5');
        return $pdf->inline($jenis . '.pdf');
    }

    public function jumlah()
    {
        $user = layanan_Laporan_Model::getUser() ;
        $data = layanan_Laporan_Model::getJumlahDeskripsiBulan();
        $a = count($data);
        $b = count($user);
        $deskripsi = 0;
        foreach ($b as $row) {
          echo $row;

        }

        for($i=0;$i <= $b-1;$i++){
            for($x=0;$x <= $a-1;$x++)
            {
                if($user[$i]->name = $data[$x]->deskripsi_user_create) {
                    $deskripsi = $deskripsi + 1;
                }
                echo $deskripsi. '<br>';
            }
        }


//        if(haystack[i]===needle){return true;}
//    }
//    return false;

    }
}
