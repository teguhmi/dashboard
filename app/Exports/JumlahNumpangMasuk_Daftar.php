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

class JumlahNumpangMasuk_Daftar implements WithEvents, FromCollection, WithHeadings, ShouldAutoSize
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

        $results = NumpangUjianMasukModel::getdaftarmatakuliahujianmasuk($masaujian, $jenis, $tanggalawal, $tanggalakhir);

        $no = 1;
        foreach ($results as $row) {
            $data_array[] = array(
                'no' => $no++,
                'masa' => $row->masa,
                'nim' => $row->nim,
                'nama_mahasiswa' => $row->nama_mahasiswa,
                'kode_mtk' => $row->kode_mtk,
                'hari' => $row->hari,
                'jam_ujian' => $row->jam_ujian,
                'kode_upbjj_ujian_asal' => $row->kode_upbjj_ujian_asal,
                'nama_wilayah_ujian_asal' => $row->nama_wilayah_ujian_asal,
                'kode_upbjj_ujian_tujuan' => $row->kode_upbjj_ujian_tujuan,
                'nama_wilayah_ujian_tujuan' => $row->nama_wilayah_ujian_tujuan,
//                'jenis' => $row->jenis,

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
        $h1 = 'Daftar PesertaUjian Tatap Muka ' . config('app.upbjj');
        $h2 = 'Periode Tanggal ' . $this->tanggalawal . ' s/d '. $this->tanggalakhir;
        return [
            [$h1],
            [$h2],
            [],
            ['Nomor', 'Masa', 'NIM', 'Nama Mahasiswa', 'Kode Matakuliah', 'Hari', 'Jam', 'Kode TPU Asal', 'Nama TPU asal', 'Kode TPU', 'Tempat Ujian'],

        ];
    }
}
