<?php

namespace App\Http\Controllers\faq;

use App\Http\Controllers\Controller;
use App\Models\faq\faqModel;
use Illuminate\Http\Request;

class faqController extends Controller
{
    public function index()
    {
        $kategori = faqModel::getKategori();
        $medsos = faqModel::getMedsos();
        $id = encrypt(1);
        $faq = faqModel::getFAQbyID($id);
        if (!empty($kategori)) {
            return view('pages.faq.faq_menu', compact('kategori', 'medsos', 'faq'));
        } else {
            return view('pages.faq.faq_menu');
        }

    }

    public function getFAQ($id)
    {
        if (!empty($id)) {
            $id = decrypt($id);
        }
        $faq = faqModel::getFAQbyID($id);
        $kategori = faqModel::getKategori();
        $medsos = faqModel::getMedsos();
        if (!empty($faq)) {
            return view('pages.faq.faq_menu', compact('kategori', 'medsos', 'faq'));
        } else {
            return redirect()->back();
        }

    }

    public function kategori($id)
    {

    }
}
