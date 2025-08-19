<?php

namespace App\Http\Controllers\srs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuerySRS extends Controller
{
    public function GetNIM(Request $request){
        $nim = $request->input('nim');

        if (!empty($nim)) {
            $sql = QuerySRS::getDPbyNIM($nim);
            $data = array(
                'nim' => $sql[0]->nim,
                'nama_mahasiswa' => $sql[0]->nama_mahasiswa,

            );
            echo json_encode($data);

        }
    }
}
