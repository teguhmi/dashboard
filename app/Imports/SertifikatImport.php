<?php

namespace App\Imports;

use App\Models\sertifikat\sertifikat;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class SertifikatImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Sertifikat([
           "id_sertifikat" => $row["id_sertifikat"],
           "nim" => $row["nim"],
           "nama" => $row["nama"],
           "hp" => $row["hp"],
           "institusi" => $row["institusi"],
           "sebagai" => $row["sebagai"],
           "flag" => '1'
        ]);
    }
}
