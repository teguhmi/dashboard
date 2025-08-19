<?php

namespace App\Http\Controllers\layanan;

use App\Http\Controllers\Controller;

class layananFormController extends Controller
{
    public function index()
    {
        return view('pages.layanan.layanan_home');
    }
    public function form_layanan()
    {
        return view('pages.layanan.layanan_form_dp');
    }

}
