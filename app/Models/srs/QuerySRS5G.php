<?php

namespace App\Models\srs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class QuerySRS5G extends Model
{
    public static function login_5G()
    {
        try {
            $data = array(
                'email' => config('app.5guser'),
                'password' => config('app.5gpassword')
            );
            $url = config('app.5gbaseurl') . '/v1/auth';
            $client = new Client();
            $response = $client->POST($url, [
                'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
                'body' => json_encode($data)
            ]);
            $body = $response->getBody();
            return $obj = json_decode($body);
        } catch (GuzzleException $e) {
            dd($e);
        }

    }

    public static function getdpbynim($nim)
    {

        $login = self::login_5G();
        $token = $login->token;

        $url = config('app.5gbaseurl') . '/v1/data-pribadi/' . $nim;
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
                if (empty($obj->data->info_pokjar->pokjar->nama_pokjar)) {
                    $pokjar = '';
                } else {
                    $pokjar = $obj->data->info_pokjar->pokjar->nama_pokjar;
                }
                $data = array(
                    'nim' => $obj->data->nim,
                    'nama_mahasiswa' => $obj->data->nama_mahasiswa,
                    'tempat_lahir_mahasiswa' => $obj->data->tempat_lahir_mahasiswa,
                    'tanggal_lahir_mahasiswa' => $obj->data->tanggal_lahir_mahasiswa,
                    'nik' => $obj->data->nik,
                    'status_dp' => $obj->data->status_data_pribadi->kode_status_dp,
                    'keterangan_dp' => $obj->data->status_data_pribadi->keterangan,
                    'kode_jenis_program' => $obj->data->info_ut->program_studi->jenis_program->kode_jenis_program,
                    'keterangan' => $obj->data->info_ut->program_studi->jenis_program->keterangan,
                    'kode_fakultas' => $obj->data->info_ut->program_studi->fakultas->kode_fakultas,
                    'singkatan_fakultas' => $obj->data->info_ut->program_studi->fakultas->singkatan,
                    'nama_fakultas' => $obj->data->info_ut->program_studi->fakultas->nama_fakultas,
                    'program_studi' => $obj->data->info_ut->program_studi->nama_program_studi,
                    'kode_program_studi' => $obj->data->info_ut->program_studi->kode_program_studi,
                    'nama_program_studi' => $obj->data->info_ut->program_studi->nama_program_studi,
                    'nama_singkat_program_studi' => $obj->data->info_ut->program_studi->nama_singkat_ps,
                    'jenjang_program_studi' => $obj->data->info_ut->program_studi->jenjang_prodi->nama_jenjang,
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
                    'nomor_hp_mahasiswa' => $obj->data->info_kontak->nomor_hp_mahasiswa,
                    'nomor_hp_1' => $obj->data->info_kontak->nomor_hp_mahasiswa2,
                    'nomor_hp_2' => $obj->data->info_kontak->nomor_kontak_kerabat,
                    'email' => $obj->data->info_kontak->alamat_email_mahasiswa,
                    'alamat_mahasiswa' => $obj->data->info_kontak->alamat_mahasiswa,
//                    'kode_kabko' => $obj->data->info_kontak->pos->kabupaten_kota->kode_kabko,
//                    'nama_kabko' => $obj->data->info_kontak->pos->kabupaten_kota->nama_kabko,
                    'pokjar' => $pokjar,
                );
            }
            return $data;

        } catch (GuzzleException $e) {

        }
    }

    Public static function getttmbynim($masa, $id)
    {
        $login = self::login_5G();
        $token = $login->token;
        $url = config('app.5gbaseurl') . '/v1/tutorial?masa=' . $masa . '&nim=' . $id;
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

            return $obj;
        } catch (GuzzleException $e) {

        }

    }

    public static function getttmbytutor($masa, $id)
    {

        $login = self::login_5G();
        $token = $login->token;
        $url = config('app.5gbaseurl') . '/v1/tutorial?masa=' . $masa . '&id_tutor=' . $id;
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
            return $obj = json_decode($body);
        } catch (GuzzleException $e) {

        }
    }

    public static function getttmbymasa($id)
    {
        $kodeupbjj = config('app.kode_upbjj');
        $login = self::login_5G();
        $token = $login->token;
        $url = config('app.5gbaseurl') . '/v1/tutorial?masa=' . $id . '&kode_upbjj=' . $kodeupbjj;
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

            foreach ($obj->data as $items) {
                $data_array[] = array(
                    'masa' => $id,
                    'id_tutor' => $items->id_tutor,
                    'nama_lengkap' => $items->nama_lengkap,
                    'id_tutorial' => $items->id_tutorial,
                    'status_approval' => $items->status_approval,
                    'approved' => $items->approved,
                    'kelas' => $items->id_kelas,
                    'kode_matakuliah' => $items->kode_matakuliah,
                    'nama_matakuliah' => $items->nama_matakuliah,
                    'nama_hari' => $items->nama_hari,
                    'jam' => $items->jam,
                    'lokasi' => $items->lokasi,
                );
            }
            return $data_array;
        } catch (GuzzleException $e) {

        }
    }

    public static function getttmbykelas($masa, $id_kelas, $id_tutorial)
    {
        $login = self::login_5G();
        $token = $login->token;
        $url = config('app.5gbaseurl') . '/v1/tutorial?masa=' . $masa . '&id_kelas=' . $id_kelas . '&id_tutorial=' .$id_tutorial;
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
            return $obj = json_decode($body);
        } catch (GuzzleException $e) {

        }
    }

    public static function getDataBYidkelas($masa, $id_kelas)
    {
        $login = self::login_5G();
        $token = $login->token;
        $url = config('app.5gbaseurl') . '/v1/tutorial/penjadwalan-kelas?masa=' . $masa . '&kode_upbjj=' . config('app.kode_upbjj') . '&id_kelas=' . $id_kelas;
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
            return $obj = json_decode($body);

        } catch (GuzzleException $e) {

        }
    }

    public static function getttmbytutorall($id)
    {
        $kodeupbjj = config('app.kode_upbjj');

        $login = self::login_5G();
        $token = $login->token;
        $url = config('app.5gbaseurl') . '/v1/tutor/kelas-tutorial?kode_upbjj=' . $kodeupbjj . '&id_tutor=' . $id;
        if (empty($token)) {
            Echo "Error";
        } else {
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ];
            $client = new Client();
        }
        try {
            $response = $client->request('GET', $url,
                [
                    'headers' => $headers,
                ]);
            $body = $response->getBody();
            $obj = json_decode($body);

            foreach ($obj->data as $items) {
                $data_array[] = array(
                    'masa' => $items->masa,
                    'id_tutor' => $items->id_tutor,
                    'id_tutorial' => $items->id_tutorial,
                    'nama_lengkap' => $items->nama_lengkap,
                    'kode_matakuliah' => $items->kode_matakuliah,
                    'nama_matakuliah' => $items->nama_matakuliah,
                    'kelas' => $items->id_kelas,
                );
            }
            return $data_array;
        } catch (GuzzleException $e) {

        }
    }

    public static function gtmatakuliahampu($id)
    {
        $kodeupbjj = config('app.kode_upbjj');

        $login = self::login_5G();
        $token = $login->token;
        $url = config('app.5gbaseurl') . '/v1/tutor/matakuliah-ampu?id_tutor=' . $id;
        if (empty($token)) {
            Echo "Error";
        } else {
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ];
            $client = new Client();
        }
        try {
            $response = $client->request('GET', $url,
                [
                    'headers' => $headers,
                ]);
            $body = $response->getBody();
            $obj = json_decode($body);
            if ($obj->status == true) {
                foreach ($obj->data as $items) {
                    $data_array[] = array(
                        'id_tutor' => $items->id_tutor,
                        'nama_lengkap' => $items->nama_lengkap,
                        'kode_matakuliah' => $items->kode_matakuliah,
                        'nama_matakuliah' => $items->nama_matakuliah,
                        'buku' => $items->buku,
                    );
                }
            }

            return $data_array;
        } catch (GuzzleException $e) {

        }
    }

    public static function getPendidikanTutor($id)
    {
        $kodeupbjj = config('app.kode_upbjj');

        $login = self::login_5G();
        $token = $login->token;
        $url = config('app.5gbaseurl') . '/v1/tutor/pendidikan-akhir?id_tutor=' . $id;
        if (empty($token)) {
            Echo "Error";
        } else {
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ];
            $client = new Client();
        }
        try {
            $response = $client->request('GET', $url,
                [
                    'headers' => $headers,
                ]);
            $body = $response->getBody();
            $obj = json_decode($body);
            if ($obj->status == true) {
                foreach ($obj->data as $items) {
                    $data_array[] = array(
                        'id_tutor' => $items->id_tutor,
                        'nama_lengkap' => $items->nama_lengkap,
                        'kode_perguruan_tinggi' => $items->kode_perguruan_tinggi,
                        'nama_perguruan_tinggi' => $items->nama_perguruan_tinggi,
                        'bidang_studi' => $items->bidang_studi,
                        'kode_pendidikan_akhir' => $items->kode_pendidikan_akhir,
                        'nama_pendidikan_akhir' => $items->nama_pendidikan_akhir,
                    );
                }
            }

            return $data_array;
        } catch (GuzzleException $e) {

        }
    }

    public static function getDPTutor($id)
    {
        $kodeupbjj = config('app.kode_upbjj');

        $login = self::login_5G();
        $token = $login->token;
        $url = config('app.5gbaseurl') . '/v1/tutor?kode_upbjj=' . $kodeupbjj . '&id_tutor=' . $id;
        if (empty($token)) {
            Echo "Error";
        } else {
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ];
            $client = new Client();
        }
        try {
            $response = $client->request('GET', $url,
                [
                    'headers' => $headers,
                ]);
            $body = $response->getBody();
            $obj = json_decode($body);
            if ($obj->status == true) {
                foreach ($obj->data as $items) {
                    $data_array = array(
                        'id_tutor' => $items->id_tutor,
                        'nama_lengkap' => $items->nama_lengkap,
                        'nip' => $items->nip,
                        'kode_upbjj' => $items->kode_upbjj,
                        'jenis_kelamin' => $items->jenis_kelamin,
                        'tanggal_lahir' => $items->tanggal_lahir,
                        'telepon' => $items->telepon,
                        'email' => $items->institusi,
                        'institusi' => $items->institusi,
//                        'btrim' => $items->btrim,
                        'status_institusi' => $items->status_institusi,
                    );
                }
            }
            return $data_array;
        } catch (GuzzleException $e) {

        }
    }

    public static function getttmbymatakuliah($id)
    {
        $login = self::login_5G();
        $token = $login->token;
        $url = config('app.5gbaseurl') . '/v1/tutor/kelas-tutorial?kode_upbjj=' .config('app.kode_upbjj') . '&kode_matakuliah=' . $id;
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
            return $obj;

        } catch (GuzzleException $e) {

        }
    }
}
