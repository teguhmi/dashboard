<?php

namespace App\Http\Controllers\faq;

use App\Http\Controllers\Controller;
use App\Models\faq\faqModel;
use Illuminate\Http\Request;

class faqDeskripsi extends Controller
{
    public function index(Request $request)
    {
        $jenis = $request->input('jenis');
        $id = $request->input('id');
        $deskripsi = faqModel::getFAQAll();
        $kategori = faqModel::getKategoriAll();
        if (empty($id)) {
            return view('pages.faq.faq_deskripsi', compact( 'kategori'));
        } else{
            $id = decrypt($request->input('id'));
        }

        if (empty($id) || empty($jenis)) {
//            $deskripsi = faqModel::getFAQAll();
            $kategori = faqModel::getKategoriAll();
            if (!empty($deskripsi) || !empty($kategori)) {
                return view('pages.faq.faq_deskripsi', compact('kategori'));
            } else {
                return view('pages.faq.faq_deskripsi');
            }
        } else {
            return $this->reload($id, $jenis);
        }

    }

    public function reload($id, $jenis)
    {
        $kategori = faqModel::getKategoriAll();
        if ($jenis == 'getKategori') {
            $deskripsi = faqModel::getFAQbyID($id);
        } else {
            $deskripsi = faqModel::getFAQAll();
        }
        if (!empty($deskripsi) || !empty($kategori)) {
            return view('pages.faq.faq_deskripsi', compact('deskripsi', 'kategori'));
        } else {
            return view('pages.faq.faq_deskripsi');
        }
    }

    public function simpan(Request $request)
    {
        $data = $request->all();

        $iddeskripsi = $request->input('modal_id');
        $id_faq = $request->input('kategori');
        $tanya = $request->input('tanya');
        $jawab = $request->input('jawab');
        $nomorurut = $request->input('nomorurut');
        $jawab = str_replace(array("\r\n", "\n", "\r"), ' ', $jawab);

        if (empty($iddeskripsi) && !empty($id_faq)) {
            $id = $id_faq;
            $urut = faqModel::getUrut($id);
            if (empty($urut)) {
                $urut = 1;
            } else {
                $urut = faqModel::getUrut($id);
                if (!empty($urut)) {
                    $urut = $urut[0]->urut + 1;
                }
            }
            $data_array = array(
                'id_faq' => $id,
                'pertanyaan' => $tanya,
                'jawaban' => $jawab,
                'urut' => $urut,
            );
            faqModel::simpan_deskripsi($data_array);
        } else {
            $id = $iddeskripsi;
            $data_array = array(
                'id_faq' => $id_faq,
                'pertanyaan' => $tanya,
                'jawaban' => $jawab,
                'urut' => $nomorurut,
            );
            faqModel::update_deskripsi($id, $data_array);
        }

        return redirect()->back()->with("success", "Data berhasil Tersimpan");

    }

    public function opsi($id, $jenis)
    {
        $id = decrypt($id);
        if (empty($id)) {
            return redirect()->back()->with("error", "Error ID");
        }
        if ($jenis == 'hapus') {
            faqModel::hapus_deskripsi($id);
        }

        return redirect()->back()->with("success", "Data berhasil dihapus");
    }
}
