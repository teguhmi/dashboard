<?php

namespace App\Http\Controllers\faq;

use App\Http\Controllers\Controller;
use App\Models\faq\faqModel;
use Illuminate\Http\Request;

class faqKategori extends Controller
{
    public function index(Request $request)
    {
        $jenis = $request->input('jenis');
        $kategori = faqModel::getKategoriAll();
        if($jenis == 'getKategori') {
            dd($jenis);
        } else {
            if(!empty($kategori)) {
                return view('pages.faq.faq_kategori',compact('kategori'));
            } else {
                return view('pages.faq.faq_kategori');
            }
        }



    }

    public function reload($id) {


    }
}
