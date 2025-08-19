<?php

namespace App\Http\Controllers\layanan;

use App\Http\Controllers\Controller;
use App\Models\layanan\layanan_FormModel;
use App\Models\layanan\layanan_dataAsalModel;
use App\Models\layanan\layanan_dataKPModel;
use App\Models\layanan\layanan_dataKategoriModel;
use App\Models\layanan\layanan_dataPJModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class
layanan_DPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rolepjb:admin,frontdesk')->except('index');
    }

    public function index()
    {
        return view('pages.layanan.layanan_home');
    }


}
