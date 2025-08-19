<?php

namespace App\Exports;


use App\Models\srs\QuerySRSController;
use App\Models\ujian\NumpangUjianMasukModel;
use App\Models\wisuda\wisuda_pusat\WisudaPesertaModel;
use DB;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Auth;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class JumlahNumpangMasuk implements WithEvents, FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $masaujian, $jenis, $tanggalawal, $tanggalakhir;

    function __construct($masaujian, $jenis, $tanggalawal, $tanggalakhir)
    {
        $this->masaujian = $masaujian;
        $this->jenis = $jenis;
        $this->tanggalawal = $tanggalawal;
        $this->tanggalakhir = $tanggalakhir;
    }

    public function collection()
    {

        $masaujian = $this->masaujian;
        $jenis = $this->jenis;
        $tanggalawal = $this->tanggalawal;
        $tanggalakhir = $this->tanggalakhir;

        $results = NumpangUjianMasukModel::getjumlahmatakuliahujianmasuk($masaujian, $jenis, $tanggalawal, $tanggalakhir);

        $no = 1;
        foreach ($results as $row) {
            $data_array[] = array(
                'no' => $no++,
                'kode_tpu' => $row->kode_tpu,
                'nama_tpu' => $row->nama_tpu,
                'kode_mtk' => $row->kode_mtk,
                'total' => $row->total,

            );
        }
        return collect($data_array);
    }

    public function registerEvents(): array
    {
        $style = [
            'font' => [
                'bold' => true,
                'size' => 12
            ]
        ];
        return [
            AfterSheet::class => function (AfterSheet $event) use ($style) {
                $event->sheet->getStyle('A1:E1')->applyFromArray($style); // Merge cells for Header 2 - Multiple Columns
                $event->sheet->getStyle('A2:E2')->applyFromArray($style); // Merge cells for Header 2 - Multiple Columns
                $event->sheet->mergeCells('A1:E1'); // Merge cells for Header 2 - Multiple Columns
                $event->sheet->mergeCells('A2:E2'); // Merge cells for Header 2 - Multiple Columns
            },
        ];
    }

    public function headings(): array
    {
        $h1 = 'Jumlah Kebutuhan Naskah Ujian Tatap Muka ' . config('app.upbjj');
        $h2 = 'Periode Tanggal ' . $this->tanggalawal . ' s/d '. $this->tanggalakhir;
        return [
            [$h1],
            [$h2],
            [],
            ['Nomor', 'Kode TPU', 'Nama TPU', 'Kode Matakuliah', 'Total'],

        ];
    }
}
