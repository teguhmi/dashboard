<?php

namespace App\Http\Controllers\layanan\orientasi;

use App\Http\Controllers\Controller;
use App\Models\layanan\orientasi\layanan_OrientasiModel;
use App\Models\srs\QuerySRS5G;
use Illuminate\Http\Request;

class layananOrientasiController extends Controller
{
    public function index()
    {
        $data = layanan_OrientasiModel::dp_mahasiswa();
       if(!empty($data)) {
           foreach ($data as $items) {
               $nim = $items->nim;
               $DPMahasiswa = QuerySRS5G::getdpbynim($nim);

               $data_array = array(
                   'nim'=>$DPMahasiswa['nim'],
                   'nama_mahasiswa'=>$DPMahasiswa['nama_mahasiswa'],
                   'kode_fakultas'=>$DPMahasiswa['kode_fakultas'],
                   'nama_fakultas'=>$DPMahasiswa['nama_fakultas'],
                   'singkatan_fakultas'=>$DPMahasiswa['singkatan_fakultas'],
                   'kode_jenis_program'=>$DPMahasiswa['kode_jenis_program'],
                   'nama_jenis_program'=>$DPMahasiswa['keterangan'],
                   'kode_program_studi'=>$DPMahasiswa['kode_program_studi'],
                   'nama_program_studi'=>$DPMahasiswa['nama_program_studi'],
                   'nama_singkat_program_studi'=>$DPMahasiswa['nama_singkat_program_studi'],
                   'jenjang_program_studi'=>$DPMahasiswa['jenjang_program_studi'],
                   'masa_registrasi_awal'=>$DPMahasiswa['masa_awal_registrasi'],
                   'masa_registrasi_akhir'=>$DPMahasiswa['masa_akhir_registrasi'],
                   'kode_upbjj'=>$DPMahasiswa['kode_upbjj'],
                   'nama_upbjj'=>$DPMahasiswa['nama_upbjj'],
                   'nomor_hp_1'=>$DPMahasiswa['nomor_hp_mahasiswa'],
                   'nomor_hp_2'=>$DPMahasiswa['nomor_hp_1'],
                   'nomor_hp_3'=>$DPMahasiswa['nomor_hp_2'],
                   'email'=>$DPMahasiswa['email'],
                   'alamat_mahasiswa'=>$DPMahasiswa['alamat_mahasiswa'],
                   'kode_kabko'=>$DPMahasiswa['kode_kabko'],
                   'nama_kabko'=>$DPMahasiswa['nama_kabko'],
                   'pokjar'=>$DPMahasiswa['pokjar'],
                   'status_dp'=>$DPMahasiswa['status_dp'],
               );
               layanan_OrientasiModel::update_m_data_pribadi($nim,$data_array);
           }
       }

    }

}
