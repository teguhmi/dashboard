<?php

namespace App\Models\presensi;

use DB;
use Illuminate\Database\Eloquent\Model;

class presensiModel extends Model
{

    public static $db = 'dblokal';
    public static $db4g = 'db4g';

    public static function getpresensikonfigurasi()
    {
        $sql = "SELECT * FROM presensi_data AS a
                JOIN presensi_jenis AS b on  a.id_jenis_kegiatan = b.id_jenis_kegiatan
                WHERE a.tanggal_buka <= NOW() AND a.tanggal_tutup >= NOW() ORDER by a.nama_kegiatan DESC";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getpresensimahasiswa()
    {
        $sql = "SELECT * FROM presensi_data AS a
                JOIN presensi_jenis AS b on  a.id_jenis_kegiatan = b.id_jenis_kegiatan
                WHERE a.tanggal_buka <= NOW() AND a.tanggal_tutup >= NOW()
                AND b.kelompok = 'mahasiswa' ORDER by a.nama_kegiatan DESC";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getpresensitutor()
    {
        $sql = "SELECT * FROM presensi_data AS a
                JOIN presensi_jenis AS b on  a.id_jenis_kegiatan = b.id_jenis_kegiatan
                WHERE a.tanggal_buka <= NOW() AND a.tanggal_tutup >= NOW()
                AND b.kelompok = 'tutor' ORDER by a.nama_kegiatan DESC";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getpresensiumum()
    {
        $sql = "SELECT * FROM presensi_data AS a
                JOIN presensi_jenis AS b on  a.id_jenis_kegiatan = b.id_jenis_kegiatan
                WHERE a.tanggal_buka <= NOW() AND a.tanggal_tutup >= NOW()
                AND b.kelompok = 'umum' ORDER by a.nama_kegiatan DESC";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }

    public static function getJenisAll()
    {

        $sql = "SELECT a.*, b.jenis_kegiatan FROM presensi_data AS a JOIN presensi_jenis AS b ON a.id_jenis_kegiatan = b.id_jenis_kegiatan  ORDER BY  a.tanggal_buka DESC";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getJenisKegiatanAll()
    {

        $sql = "SELECT * FROM presensi_jenis AS a ORDER BY a.jenis_kegiatan asc";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getJenisKegiatanbyNIM($nim, $id_kegiatan)
    {

        $sql = "SELECT * FROM presensi AS a where a.nim = '$nim' and a.id_kegiatan = '$id_kegiatan'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getJenisKegiatanByID($id_kegiatan, $nim, $nama, $telepon)
    {

        $sql = "SELECT * FROM presensi AS a
                WHERE (a.id_kegiatan = '$id_kegiatan' and a.nim = '$nim') OR (a.id_kegiatan = '$id_kegiatan' and a.nama = '$nama') OR (a.id_kegiatan = '$id_kegiatan' and a.nim = '$telepon')";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;

    }

    public static function getDaftarPeserta($id)
    {
        $sql = "SELECT a.*, b.nama_kegiatan FROM presensi AS a JOIN presensi_data AS b ON a.id_kegiatan = b.id_kegiatan WHERE a.id_kegiatan = '$id'";
        $results = DB::connection(self::$db)
            ->select(DB::raw($sql));
        return $results;
    }


    public static function insert($data)
    {
        $results = DB::table('presensi')
            ->insert($data);
        return $results;
    }



    public static function insert_conf($data)
    {
        $results = DB::table('presensi_data')
            ->insert($data);
        return $results;
    }

    public static function update_conf($data, $id_kegiatan)
    {
        $results = DB::table('presensi_data')
            ->where('id_kegiatan', $id_kegiatan)
            ->update($data);

        return $results;
    }
    public static function delete_conf($id)
    {
        DB::table('presensi_data')
            ->where('id_kegiatan', $id)
            ->delete();
    }

    public static function delete_peserta($id)
    {
        DB::table('presensi')
            ->where('id_presensi', $id)
            ->delete();
    }
}

