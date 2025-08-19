<?php

namespace App\Exports;

use App\Models\presensi\presensiModel;
use DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PresensiExport implements FromCollection, WithHeadings, ShouldAutoSize
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
        $id = $this->id;
        $results = presensiModel::getDaftarPeserta($id);
//            $data_array = array('nim','nama');
//            $results = DB::connection(self::$db)
//                ->table('presensi')
//                ->select('nim', 'nama', 'institusi', 'telepon', 'kode_program_studi', 'nama_program_studi', 'masa_registrasi_awal', 'user_date_create')
//                ->join('presensi_data', 'presensi.id_kegiatan', '=', 'presensi_data.id_kegiatan')
//                ->where('presensi.id_kegiatan', $id)
//                ->get();
        foreach ($results as $row) {
            $data_array[] = array(
                'nim' => $row->nim,
                'nama' => $row->nama,
                'institusi' => $row->institusi,
                'telepon' => $row->telepon,
                'program_studi' => $row->kode_program_studi . ' / ' . $row->nama_program_studi,
                'masa_registrasi_awal' => $row->masa_registrasi_awal,
                'tanggal_absen' => $row->user_date_create,
            );
        }

        return collect($data_array);
    }

    public function headings(): array
    {
        return ['NIM', 'Nama Mahasiswa', 'Institusi', 'No Telepon', 'Program Studi', 'Reg Awal', 'Tanggal Presensi'];
    }


}
