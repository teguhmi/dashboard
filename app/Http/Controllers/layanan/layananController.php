<?php

namespace App\Http\Controllers\layanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class layananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index(Request $request)
    {

        return view('pages.layanan.layanan_home');
    }
    public function form_layanan()
    {
        return view('pages.layanan.layanan_form_dp');
    }

}
