<?php

namespace App\Exports;

use App\Models\angket\angketEvaluasiModel;
use App\Models\presensi\presensiModel;
use DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HasilEvaluasiTutor implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;
    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        $masa = $this->id;
        $results =angketEvaluasiModel::get_penilaian($masa);

        foreach ($results as $row) {
            $data_array[] = array(
                'masa'=>$row->masa,
                'id_tutor' => $row->id_tutor,
                'nama' => $row->nama_lengkap,
                'kode_matakuliah' => $row->kode_matakuliah,
                'nama_matakuliah' => $row->nama_matakuliah,
                'nilai_etm' => $row->nilai_etm,
                'hasil' => $row->hasil,
                'rekomendasi' => $row->rekomendasi,
                'saran' => $row->saran,
            );
        }

        return collect($data_array);
    }

    public function headings(): array
    {
        return ['Masa', 'ID Tutor', 'Nama Tutor', 'Kode Matakulah', 'Nama Matakuliah', 'Nilai Evaluasi', 'Hasil','Rekomendasi','Saran'];
    }


}
