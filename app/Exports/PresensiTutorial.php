<?php

namespace App\Exports;

use App\Models\presensi\presensiModel;
use App\Models\srs\QuerySRS5G;
use DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class PresensiTutorial implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;
    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    protected $masa, $id_kelas, $id_tutorial;

    public function __construct($masa, $id_kelas, $id_tutorial)
    {
        $this->masa = $masa;
        $this->id_kelas = $id_kelas;
        $this->id_tutorial = $id_tutorial;


    }

    public function collection()
    {
        $masa = $this->masa;
        $id_kelas = $this->id_kelas;
        $id_tutorial = $this->id_tutorial;
        $results = QuerySRS5G::getttmbykelas($masa, $id_kelas, $id_tutorial);

        if (!empty($results)) {
            foreach ($results as $row) {
                $data_array[] = array(
                    'nim' => $row->nim,
                    'nama' => $row->nama,

                );
            }
        }
        return collect($data_array);
    }

    public function registerEvents(): array
    {
        $style = [
            'font' => [
                'bold' => true,
                'size' => 12,
            ]
        ];
        return [
            AfterSheet::class => function (AfterSheet $event) use ($style) {
                $event->sheet->getStyle('A1:Z1')->applyFromArray($style); // Merge cells for Header 2 - Multiple Columns
                $event->sheet->mergeCells('A1:Z1'); // Merge cells for Header 2 - Multiple Columns
                $event->sheet->getStyle('A2:Z2')->applyFromArray($style); // Merge cells for Header 2 - Multiple Columns
                $event->sheet->mergeCells('A2:Z2'); // Merge cells for Header 2 - Multiple Columns
            },
        ];
    }

    public function headings(): array
    {
        return ['NIM', 'Nama Mahasiswa'];
    }


}
