<?php

namespace App\Http\Controllers\layanan\legalisir;

use App\Http\Controllers\Controller;
use App\Models\SettingModel;
use Illuminate\Http\Request;
class legalisir_form extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request)
    {
        $nim = $request->input($nim);
        if(empty($nim)) {
            return view('pages.layanan.legalisir.legalisir_form');
        } else {
            $DPMahasiswa = SettingModel::get_dp($nim);
            dd($DPMahasiswa);
            return view('pages.layanan.legalisir.legalisir_form',compact('DPMahasiswa'));
        }

    }

}
