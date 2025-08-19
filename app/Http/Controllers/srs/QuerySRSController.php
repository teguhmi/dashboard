<?php

namespace App\Http\Controllers\srs;

use App\Http\Controllers\Controller;
use App\Models\srs\QuerySRS;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class QuerySRSController extends Controller
{
    Public static function GetDP(Request $request)
    {
        $nim = $request->input('nim');
        if (!empty($nim)) {
            $sql = QuerySRS::getDPbyNIM($nim);
            if (!empty($sql)) {
                $data = array(
                    'nim' => $sql[0]->nim,
                    'nama_mahasiswa' => $sql[0]->nama_mahasiswa,
                    'kode_upbjj' => $sql[0]->kode_upbjj,
                    'nama_upbjj' => $sql[0]->nama_upbjj,
                );
                echo json_encode($data);
            }
        }
    }

    Public static function login_5G()
    {
        try {
            $data = array(
                'email' => config('app.5guser'),
                'password' => config('app.5gpassword')
            );
            $url = config('app.5gbaseurl') . "v1/auth";
            $client = new \GuzzleHttp\Client();
            $response = $client->post($url, [
                'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
                'body' => json_encode($data)
            ]);
            $body = $response->getBody();

            return $obj = json_decode($body);
        } catch (\Exception $e) {
//            dd($e);
        }
    }

    Public static function getMasaAktif()
    {

        $url = config('app.5gbaseurl') . "v1/masa-aktif?kodeKegiatan=AKRG";
        $login = self::login_5G();
        $token = $login->token;
        if ($login->status == false) {
            Echo "Error";
        } else {
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ];
        }
        $client = new Client();
        try {
            $response = $client->request('get', $url, [
                'headers' => $headers,
                'form_param' => [
                    'kodeKegiatan' => 'AKRG'
                ]
            ]);
            $body = $response->getBody();
            $obj = json_decode($body);
            $data = array(
                'masa' => $obj->data->masa,
                'keterangan' => $obj->data->keterangan,
                'tahun_akademik' => $obj->data->tahun_akademik,
                'masa_registrasi' => $obj->data->masa_registrasi,
            );

        } catch (GuzzleException $e) {

        }
        return $data;
    }

    Public static function getdpbynim($nim)
    {
        $url = config('app.5gbaseurl') . 'v1/data-pribadi/' . $nim;
        $login = self::login_5G();
        $token = $login->token;
        if (empty($token)) {
            Echo "Error";
        } else {
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ];
        }
        $client = new Client();
        try {
            $response = $client->request('GET', $url,
                [
                    'headers' => $headers,
                ]);
            $body = $response->getBody();
            if (empty($body)) {
                $body = '';
            }
            $obj = json_decode($body);
            if (empty($obj)) {
                $data = array(
                    'status' => 'Data tidak ditemukan',
                );
            } else {
                $data = array(
                    'nim' => $obj->data->nim,
                    'nama_mahasiswa' => $obj->data->nama_mahasiswa,
                    'tempat_lahir_mahasiswa' => $obj->data->tempat_lahir_mahasiswa,
                    'tanggal_lahir_mahasiswa' => $obj->data->tanggal_lahir_mahasiswa,
                    'nik' => $obj->data->nik,
                    'status_dp' => $obj->data->status_data_pribadi->kode_status_dp,
                    'keterangan_dp' => $obj->data->status_data_pribadi->keterangan,
                    'kode_fakultas' => $obj->data->info_ut->program_studi->fakultas->kode_fakultas,
                    'singkatan_fakultas' => $obj->data->info_ut->program_studi->fakultas->singkatan,
                    'nama_fakultas' => $obj->data->info_ut->program_studi->fakultas->nama_fakultas,
                    'program_studi' => $obj->data->info_ut->program_studi->nama_program_studi,
                    'kode_program_studi' => $obj->data->info_ut->program_studi->kode_program_studi,
                    'nama_program_studi' => $obj->data->info_ut->program_studi->nama_program_studi,
//                    'ipk' => $obj->data->info_ut->ipk_dp,
//                    'sks' => $obj->data->info_ut->sks_dp,
                    'kode_upbjj' => $obj->data->info_ut->upbjj->kode_upbjj,
                    'nama_upbjj' => $obj->data->info_ut->upbjj->nama_upbjj,
                    'alamat_upbjj' => $obj->data->info_ut->upbjj->alamat_upbjj,
                    'nomor_hp_mahasiswa' => $obj->data->info_kontak->nomor_hp_mahasiswa,
                    'masa_awal_registrasi' => $obj->data->masa_reg_awal->masa,
                    'masa_awal_keterangan' => $obj->data->masa_reg_awal->keterangan,
                    'masa_awal_tahun_akademik' => $obj->data->masa_reg_awal->tahun_akademik,
                    'masa_akhir_registrasi' => $obj->data->masa_reg_akhir->masa,
                    'masa_akhir_keterangan' => $obj->data->masa_reg_akhir->keterangan,
                    'masa_akhir_tahun_akademik' => $obj->data->masa_reg_akhir->tahun_akademik,
                );
            }
            return $data;
//            echo json_encode($data);

        } catch (GuzzleException $e) {

        }


    }

    Public static function getdpbynimAJAX(Request $request)
    {
        $nim = $request->input('nim');
        $url = config('app.5gbaseurl') . 'v1/data-pribadi/' . $nim;
        $login = self::login_5G();
        $token = $login->token;
        if (empty($token)) {
            Echo "Error";
        } else {
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ];
        }
        $client = new Client();
        try {
            $response = $client->request('GET', $url,
                [
                    'headers' => $headers,
                ]);
            $body = $response->getBody();
            if (empty($body)) {
                $body = '';
            }
            $obj = json_decode($body);
//            dd($obj);
            if (empty($obj)) {
                $data = array(
                    'status' => 'Data tidak ditemukan',
                );
            } else {
                $data = array(
                    'nim' => $obj->data->nim,
                    'nama_mahasiswa' => $obj->data->nama_mahasiswa,
//                    'tempat_lahir_mahasiswa' => $obj->data->tempat_lahir_mahasiswa,
//                    'tanggal_lahir_mahasiswa' => $obj->data->tanggal_lahir_mahasiswa,
//                    'nik' => $obj->data->nik,
                    'status_dp' => $obj->data->status_data_pribadi->kode_status_dp,
                    'keterangan_dp' => $obj->data->status_data_pribadi->keterangan,
                    'kode_fakultas' => $obj->data->info_ut->program_studi->fakultas->kode_fakultas,
                    'singkatan_fakultas' => $obj->data->info_ut->program_studi->fakultas->singkatan,
                    'nama_fakultas' => $obj->data->info_ut->program_studi->fakultas->nama_fakultas,
                    'program_studi' => $obj->data->info_ut->program_studi->nama_program_studi,
                    'kode_program_studi' => $obj->data->info_ut->program_studi->kode_program_studi,
                    'nama_program_studi' => $obj->data->info_ut->program_studi->nama_program_studi,
                    'ipk' => $obj->data->info_ut->ipk_dp,
                    'sks' => $obj->data->info_ut->sks_dp,
                    'kode_upbjj' => $obj->data->info_ut->upbjj->kode_upbjj,
                    'nama_upbjj' => $obj->data->info_ut->upbjj->nama_upbjj,
                    'masa_awal_registrasi' => $obj->data->masa_reg_awal->masa,
                    'masa_awal_keterangan' => $obj->data->masa_reg_awal->keterangan,
                    'masa_awal_tahun_akademik' => $obj->data->masa_reg_awal->tahun_akademik,
                    'masa_akhir_registrasi' => $obj->data->masa_reg_akhir->masa,
                    'masa_akhir_keterangan' => $obj->data->masa_reg_akhir->keterangan,
                    'masa_akhir_tahun_akademik' => $obj->data->masa_reg_akhir->tahun_akademik,
                );
            }
//            return $data;
            echo json_encode($data);

        } catch (GuzzleException $e) {

        }


    }

    Public static function getdpbynimCrop($nim)
    {
        $url = config('app.5gbaseurl') . 'v1/data-pribadi/' . $nim;
        $login = self::login_5G();
        $token = $login->token;
        if (empty($token)) {
            Echo "Error";
        } else {
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ];
        }
        $client = new Client();
        try {
            $response = $client->request('GET', $url,
                [
                    'headers' => $headers,
                ]);
            $body = $response->getBody();
            if (empty($body)) {
                $body = '';
            }
            $obj = json_decode($body);
//            dd($obj);
            if (empty($obj)) {
                $data = array(
                    'status' => 'Data tidak ditemukan',
                );
            } else {
                $data = array(
                    'nim' => $obj->data->nim,
                    'nama_mahasiswa' => $obj->data->nama_mahasiswa,
//                    'tempat_lahir_mahasiswa' => $obj->data->tempat_lahir_mahasiswa,
//                    'tanggal_lahir_mahasiswa' => $obj->data->tanggal_lahir_mahasiswa,
//                    'nik' => $obj->data->nik,
                    'status_dp' => $obj->data->status_data_pribadi->kode_status_dp,
                    'keterangan_dp' => $obj->data->status_data_pribadi->keterangan,
                    'kode_fakultas' => $obj->data->info_ut->program_studi->fakultas->kode_fakultas,
                    'singkatan_fakultas' => $obj->data->info_ut->program_studi->fakultas->singkatan,
                    'nama_fakultas' => $obj->data->info_ut->program_studi->fakultas->nama_fakultas,
                    'program_studi' => $obj->data->info_ut->program_studi->nama_program_studi,
                    'kode_program_studi' => $obj->data->info_ut->program_studi->kode_program_studi,
                    'nama_program_studi' => $obj->data->info_ut->program_studi->nama_program_studi,
                    'ipk' => $obj->data->info_ut->ipk_dp,
                    'sks' => $obj->data->info_ut->sks_dp,
                    'kode_upbjj' => $obj->data->info_ut->upbjj->kode_upbjj,
                    'nama_upbjj' => $obj->data->info_ut->upbjj->nama_upbjj,
                    'masa_awal_registrasi' => $obj->data->masa_reg_awal->masa,
                    'masa_awal_keterangan' => $obj->data->masa_reg_awal->keterangan,
                    'masa_awal_tahun_akademik' => $obj->data->masa_reg_awal->tahun_akademik,
                    'masa_akhir_registrasi' => $obj->data->masa_reg_akhir->masa,
                    'masa_akhir_keterangan' => $obj->data->masa_reg_akhir->keterangan,
                    'masa_akhir_tahun_akademik' => $obj->data->masa_reg_akhir->tahun_akademik,
                );
            }
            return $data;
//            echo json_encode($data);

        } catch (GuzzleException $e) {

        }


    }

    public static function getupbjj()
    {
        $login = self::login_5G();
        $token = $login->token;
        if (empty($token)) {
            Echo "Error";
        } else {
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ];
        }
        $client = new Client();
        try {
            $url = config('app.5gbaseurl') . 'v1/upbjj';
            $response = $client->request('GET', $url, [
                'headers' => $headers
            ]);

            $body = $response->getBody();
            $obj = json_decode($body);

            return $obj;
        } catch (GuzzleException $e) {
            dd($e);
        }
    }

    Public static function getupbjjbyKodeUPBJJ($kode_upbjj)
    {
        $login = self::login_5G();
        $token = $login->token;
        if (empty($token)) {
            Echo "Error";
        } else {
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ];
        }
        $client = new Client();
        try {
            $url = config('app.5gbaseurl') . 'v1/upbjj?kodeUpbjj=' . $kode_upbjj;
            $response = $client->request('GET', $url, [
                'headers' => $headers
            ]);

            $body = $response->getBody();
            $obj = json_decode($body);
            return $obj;
        } catch (GuzzleException $e) {
            dd($e);
        }
    }

}
