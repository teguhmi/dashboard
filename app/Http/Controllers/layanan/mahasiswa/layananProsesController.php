<?php

namespace App\Http\Controllers\layanan\mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class layananProsesController extends Controller
{
    public function index(Request $request)
    {
        $jenis = $request->input('jenis');
        if (empty($jenis)) {
            $jenis = '';
        }
        if($jenis == 'KTM') {
            dd($jenis);
        }
        return view('pages.layanan.mahasiswa.form_layanan_proses',compact('jenis'));
    }

}
