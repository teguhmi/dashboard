<?php

use App\Http\Controllers\angket\angketEvaluasiController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Home;
use App\Http\Controllers\jadwal\jadwalController;
use App\Http\Controllers\jadwal\ttmController;
use App\Http\Controllers\jadwal\tutorController;
use App\Http\Controllers\layanan\layanan_dataAsalController;
use App\Http\Controllers\layanan\layanan_dataKategoriController;
use App\Http\Controllers\layanan\layanan_dataKPController;
use App\Http\Controllers\layanan\layanan_dataPJController;
use App\Http\Controllers\layanan\layanan_dataStatusController;
use App\Http\Controllers\layanan\layanan_DeskripsiController;
use App\Http\Controllers\layanan\layanan_FormController;
use App\Http\Controllers\layanan\layanan_laporanController;
use App\Http\Controllers\layanan\mahasiswa\layananAduanController;
use App\Http\Controllers\layanan\mahasiswa\layananKTMController;
use App\Http\Controllers\layanan\mahasiswa\layananMahasiswaController;
use App\Http\Controllers\layanan\legalisir\legalisir_formController;
use App\Http\Controllers\layanan\mahasiswa\layananProsesController;
use App\Http\Controllers\layanan\mahasiswa\layananWifiIDController;
use App\Http\Controllers\layanan\orientasi\layananOrientasiController;
use App\Http\Controllers\layanan\tiket\tiket_UmumController;
use App\Http\Controllers\presensi\presensiController;
use App\Http\Controllers\sertifikat\sertifikatController;
use App\Http\Controllers\angket\angketETMController;
use App\Http\Controllers\angket\angketETUController;
use App\Http\Controllers\angket\angketTutorController;
use App\Http\Controllers\faq\faqController;
use App\Http\Controllers\faq\faqKategori;
use App\Http\Controllers\faq\faqDeskripsi;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\srs\QuerySRSController;
use App\Http\Controllers\ujian\NumpangUjianKeluarController;
use App\Http\Controllers\ujian\NumpangUjianLaporanController;
use App\Http\Controllers\ujian\NumpangUjianLaporanMasukController;
use App\Http\Controllers\ujian\NumpangUjianMasukController;
use App\Http\Controllers\view\SuratController;
use App\Http\Controllers\vote\VoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CropImageController;
use App\Http\Controllers\ImageCropperController;
use App\Http\Controllers\BotManController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::group(['middleware' => ['web']], function () {
//    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
//    Route::post('login', [LoginController::class, 'login']);
//    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
//
//
//    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
//    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
//    Route::get('password/reset', [ResetPasswordController::class, 'showResetForm']);
//    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
//
//    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.request');
//    Route::post('password/reset', 'Auth\ResetPasswordController@postReset')->name('password.reset');
//
//});
Route::group(['middleware' => ['auth']], function () {
//    Route::post('register', [RegisterController::class, 'register']);
//    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');;
////    Route::patch('/changePassword', [HomeController::class, 'changePassword']);
////    Route::get('/changePassword',  [HomeController::class, 'showChangePasswordForm'])->name('password.update');
});

Route::group(['prefix' => 'sertifikat'], function () {

    Route::get('/{id}/pdf', [sertifikatController::class, 'sertifikat_pdf'])->name('sertifikat.pdf');
    Route::get('/{id_sertifikat}/hapusconf', [sertifikatController::class, 'sertifikat_hapus_conf'])->name('sertifikat.hapus.conf');
    Route::get('/{id1}/{id2}', [sertifikatController::class, 'sertifikat_preview'])->name('sertifikat.preview');
    Route::get('/{id1}/{id2}/{id3}/hapusfilesertifikat', [sertifikatController::class, 'sertifikat_hapus_file'])->name('sertifikat.hapusfilesertifikat');
    Route::get('/{id}/{id_sertifikat}/hapuspeserta', [sertifikatController::class, 'sertifikat_hapus_peserta'])->name('sertifikat.hapus.peserta');
    Route::post('/uploadtemplate', [sertifikatController::class, 'sertifikat_upload_template'])->name('sertifikat.uploadtemplate');

    Route::get('/', [sertifikatController::class, 'sertifikat_index'])->name('sertifikat.dashboard');
    Route::get('/conf', [sertifikatController::class, 'sertifikat_konfigurasi'])->name('sertifikat.conf');
    Route::post('/excel', [sertifikatController::class, 'import'])->name('sertifikat.excel');
    Route::post('/find', [sertifikatController::class, 'sertifikat_find'])->name('sertifikat.find');
    Route::post('/new', [sertifikatController::class, 'sertifikat_new'])->name('sertifikat.new');
    Route::post('/newpeserta', [sertifikatController::class, 'sertifikat_new_peserta'])->name('sertifikat.new.peserta');
    Route::get('/import', [sertifikatController::class, 'sertifikat_import_view'])->name('sertifikat.import.view');
    Route::post('/import/select', [sertifikatController::class, 'sertifikat_import_select'])->name('sertifikat.import.select');
    Route::get('/import/{id}/reload', [sertifikatController::class, 'sertifikat_import_reload'])->name('sertifikat.import.reload');

});

Route::group(['prefix' => 'mahasiswa'], function () {
    Route::get('/', [layananMahasiswaController::class, 'index_layanan'])->name('mahasiswa.layanan');
    Route::post('/', [layananMahasiswaController::class, 'upload_file'])->name('mahasiswa.layanan.upload');
    Route::get('/dashboard', [layananMahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    Route::post('/simpan', [layananMahasiswaController::class, 'simpan'])->name('mahasiswa.layanan.simpan');
    Route::post('/upload',[layananMahasiswaController::class,'uploadCropImage'])->name('mahasiswa.upload');
    Route::get('/{id}/{jenis}',[layananMahasiswaController::class,'hapus'])->name('mahasiswa.hapus');
    Route::get('/getjenislayananbyid',[layananMahasiswaController::class,'Get_JenisLayanan_by_ID'])->name('mahasiswa.getjenislayananbyid');


    Route::get('/getjenisaduanbyid',[layananAduanController::class,'Get_JenisAduan_by_ID'])->name('mahasiswa.getjenisaduanbyid');
    Route::get('/simpanaduanumum',[layananAduanController::class,'Aduan_Umum_Simpan'])->name('mahasiswa.aduanumum.simpan');
//    Route::get('/presensi', [presensiController::class, 'index'])->name('presensi.dashboard');
//    Route::get('/presensi/find', [mahasiswaController::class, 'index_presensi'])->name('presensi.find');
});

Route::group(['prefix' => 'angket'], function () {
    Route::get('/etm/{id1}/{id2}/{id3}/{id4}', [angketETMController::class, 'index'])->name('angketetm');
    Route::post('/etm', [angketETMController::class, 'simpan'])->name('angketetmsimpan');
    Route::get('/etm/{id1}', [angketETMController::class, 'search'])->name('angketetmcari');

    Route::get('/etu/{id1}/{id2}/{id3}/{id4}', [angketETUController::class, 'index'])->name('angketetu');
    Route::post('/etu', [angketETUController::class, 'simpan'])->name('angketetusimpan');

    Route::get('/tutor', [angketTutorController::class, 'index'])->name('angket.tutor');
    Route::get('/tutor/{id}', [angketTutorController::class, 'reload'])->name('angket.tutor.cariid');
    Route::post('/tutor/cari', [angketTutorController::class, 'search'])->name('angket.tutor.cari');
//    Route::get('/dataetm', [angketTutorController::class, 'dataETM'])->name('angket.dataetm');
//    Route::get('/rekomendasi', [angketTutorController::class, 'rekomendasi'])->name('angket.rekomendasi');
    Route::get('/view/{id1}/{id2}/{id3}/{id4}', [angketTutorController::class, 'rekomendasi'])->name('angket.rekomendasi');
    Route::get('/view/{id1}', [angketTutorController::class, 'rekomendasi'])->name('angket.rekomendasi_etu');

    Route::get('/evaluasi', [angketEvaluasiController::class, 'index'])->name('angket.evaluasi');
    Route::get('/evaluasi/{id}/reload', [angketEvaluasiController::class, 'reload'])->name('angket.reload');
    Route::get('/evaluasi/{id}/{jenis}', [angketEvaluasiController::class, 'proses_penilaian'])->name('angket.penilaian');

});

Route::group(['prefix' => 'jadwal'], function () {
//    Route::get('/{id}/angketetm', [jadwalController::class, 'home'])->name('jadwal.tutorial.etm');
    Route::get('/', [jadwalController::class, 'dashboard'])->name('jadwal.dashboard');
    Route::get('/tutorial', [jadwalController::class, 'index'])->name('jadwal.tutorial');
    Route::post('/tutorial', [jadwalController::class, 'search'])->name('jadwal.tutorial.cari');
    Route::get('/{id}', [jadwalController::class, 'jadwal_home'])->name('jadwal.tutorial.home');
    Route::get('/tutorial/{id}', [jadwalController::class, 'searchBykelas'])->name('jadwal.tutorial.kelas');
    Route::get('/tutorial/{id}/{idtutorial}/daftarmhs', [jadwalController::class, 'searchBykelas'])->name('jadwal.tutorial.idtutorial');

    Route::get('/tutor/dp', [tutorController::class, 'index'])->name('tutor.dp');
    Route::get('/tutor/formtutorial', [tutorController::class, 'formtutorial'])->name('tutor.formtutorial');
    Route::get('/tutor/formtutorial/simpan', [tutorController::class, 'formtutorial_simpan'])->name('tutor.formtutorial_simpan');
    Route::post('/tutor/formtutorial/upload', [tutorController::class, 'formtutorial_upload'])->name('tutor.formtutorial_upload');
    Route::get('/tutor/formtutorial/{id}/reload', [tutorController::class, 'index_reload'])->name('tutor.formtutorial_reload');
    Route::POST('/tutor/formubahdp/{id}/ubah', [tutorController::class, 'formubahdp'])->name('tutor.formubahdp');
    Route::get('/tutor/formtutorial/{idmtk}/{id}/hapus', [tutorController::class, 'formtutorial_hapus'])->name('tutor.formtutorial_hapus');
    Route::get('/tutor/formtutorial/{id}/{masa}/{t}', [tutorController::class, 'formtutorial_pdf'])->name('tutor.formtutorial_pdf');

    Route::get('/uotap', [jadwalController::class, 'index'])->name('jadwal.uotap');
});

Route::group(['prefix' => 'presensi'], function () {
    Route::get('/', [presensiController::class, 'index_dashboard'])->name('presensi.dashboard');

    Route::get('/mahasiswa', [presensiController::class, 'index_mahasiswa'])->name('presensi.mahasiswa');
    Route::POST('/mahasiswa/search', [presensiController::class, 'search_mahasiswa'])->name('presensi.mahasiswa.search');

    Route::get('/umum', [presensiController::class, 'index_umum'])->name('presensi.umum');
    Route::post('/umum/save', [presensiController::class, 'save_umum'])->name('presensi.umum.save');

    Route::get('/jenis', [presensiController::class, 'index_conf'])->name('presensi.conf');
    Route::post('/jenis/save', [presensiController::class, 'save_conf'])->name('presensi.conf.save');
    Route::get('/jenis/{id}', [presensiController::class, 'delete_conf'])->name('presensi.conf.delete');

    Route::get('/laporan/daftar', [presensiController::class, 'index_laporan_daftar_peserta'])->name('presensi.laporan.daftar');
    Route::post('/laporan/daftar', [presensiController::class, 'getlaporan_daftar_peserta'])->name('presensi.laporan.daftar.cari');
    Route::get('/laporan/daftar/{id}', [presensiController::class, 'getlaporan_daftar_peserta_excel'])->name('presensi.laporan.daftar.excel');
    Route::get('/laporan/hapus/{id}', [presensiController::class, 'hapus_peserta'])->name('presensi.laporan.hapus.peserta');
});

Route::group(['prefix' => 'layanan'], function () {
    Route::get('/', [layanan_FormController::class, 'index'])->name('dashboardlayanan');
    Route::get('/formulir', [layanan_FormController::class, 'form_layanan'])->name('layanan.formulir');
    Route::get('/formulir/{id_deskripsi}/{id_data_dp}/deskripsi', [layanan_FormController::class, 'hapusdeskripsi'])->name('layanan.hapus.deskripsi');
    Route::post('/formulir', [layanan_FormController::class, 'update'])->name('layanan.formulir.update');
    Route::get('/formulir/{id_data_dp}/refresh', [layanan_FormController::class, 'refresh'])->name('layanan.formulir.refresh');
    Route::post('/formulir', [layanan_FormController::class, 'input'])->name('layanan.formulir.input');
    Route::post('/deskripsi/input', [layanan_FormController::class, 'input_deskripsi'])->name('layanan.deskripsi.input');

    /*Layanan Mahasiswa */
    Route::get('/tiketlayanan/', [tiket_UmumController::class, 'index'])->name('layanan.tiket');
    Route::post('/tiketlayanan/input', [tiket_UmumController::class, 'input'])->name('layanan.tiketinput');

    Route::get('/ktm', [layananKTMController::class, 'index'])->name('layanan.ktm');
    Route::get('/ktm/{jenis}/{status}/reload', [layananKTMController::class, 'reload'])->name('layanan.ktm.reload');
    Route::get('/ktm/{id}/{jenis}/validasi', [layananKTMController::class, 'validasi'])->name('layanan.ktm.validasi');
    Route::get('/ktm/{id}/unduh', [layananKTMController::class, 'UnduhFile'])->name('layanan.ktm.unduh');

    Route::get('/wifiID', [layananWifiIDController::class, 'index'])->name('layanan.wifiID');
    Route::get('/wifiID/{nim}/{jenis}', [layananWifiIDController::class, 'proses'])->name('layanan.wifiID.proses');


    Route::get('/deskripsi', [layanan_DeskripsiController::class, 'index'])->name('layanan.deskripsi.index');
    Route::get('/deskripsi/{id1}/{id2}/editdeskripsi', [layanan_DeskripsiController::class, 'index_edit'])->name('layanan.deskripsi.index_edit');
    Route::get('/deskripsi/{id1}/updatestatus', [layanan_DeskripsiController::class, 'update_status'])->name('layanan.deskripsi.updatestatus');
    Route::post('/deskripsi/update', [layanan_DeskripsiController::class, 'update'])->name('layanan.deskripsi.update');

    Route::get('/pj', [layanan_dataPJController::class, 'index'])->name('layanan.data.pj');
    Route::get('/pj/{id}/hapus', [layanan_dataPJController::class, 'hapus'])->name('layanan.data.pj.hapus');
    Route::post('/pj/ubah', [layanan_dataPJController::class, 'ubah'])->name('layanan.data.pj.ubah');
    Route::post('/pj/tambah', [layanan_dataPJController::class, 'tambah'])->name('layanan.data.pj.tambah');

    Route::get('/kp', [layanan_dataKPController::class, 'index'])->name('layanan.data.kp');
    Route::get('/kp/{id}/hapus', [layanan_dataKPController::class, 'hapus'])->name('layanan.data.kp.hapus');
    Route::post('/kp/ubah', [layanan_dataKPController::class, 'ubah'])->name('layanan.data.kp.ubah');
    Route::post('/kp/tambah', [layanan_dataKPController::class, 'tambah'])->name('layanan.data.kp.tambah');

    Route::get('/asal', [layanan_dataAsalController::class, 'index'])->name('layanan.data.asal');
    Route::get('/asal/{id}/hapus', [layanan_dataAsalController::class, 'hapus'])->name('layanan.data.asal.hapus');
    Route::post('/asal/ubah', [layanan_dataAsalController::class, 'ubah'])->name('layanan.data.asal.ubah');
    Route::post('/asal/tambah', [layanan_dataAsalController::class, 'tambah'])->name('layanan.data.asal.tambah');

    Route::get('/kategori', [layanan_dataKategoriController::class, 'index'])->name('layanan.data.kategori');
    Route::get('/kategori/{id}/hapus', [layanan_dataKategoriController::class, 'hapus'])->name('layanan.data.kategori.hapus');
    Route::post('/kategori/ubah', [layanan_dataKategoriController::class, 'ubah'])->name('layanan.data.kategori.ubah');
    Route::post('/kategori/tambah', [layanan_dataKategoriController::class, 'tambah'])->name('layanan.data.kategori.tambah');

    Route::get('/status', [layanan_dataStatusController::class, 'index'])->name('layanan.data.status');
    Route::get('/status/{id}/hapus', [layanan_dataStatusController::class, 'hapus'])->name('layanan.data.status.hapus');
    Route::post('/status/ubah', [layanan_dataStatusController::class, 'ubah'])->name('layanan.data.status.ubah');
    Route::post('/status/tambah', [layanan_dataStatusController::class, 'tambah'])->name('layanan.data.status.tambah');

    Route::get('/laporan', [layanan_laporanController::class, 'index'])->name('layanan.laporan');
    Route::post('/laporan', [layanan_laporanController::class, 'search'])->name('layanan.laporan.search');
    Route::get('/laporan/iso', [layanan_laporanController::class, 'index_iso'])->name('layanan.laporan.iso');
    Route::post('/laporan/iso', [layanan_laporanController::class, 'search_iso'])->name('layanan.laporan.iso.search');
    Route::get('/laporan/{id1}/{id2}/{id3}', [layanan_laporanController::class, 'pdf_iso'])->name('layanan.laporan.iso.pdf');

    Route::get('/jumlah', [layanan_laporanController::class, 'jumlah'])->name('layanan.jumlah');

    Route::get('/test/', [layanan_laporanController::class, 'test']);

    Route::get('/dp', [layanan_dataAsalController::class, 'index'])->name('layanan.dp.data');

//    Route::get('/', [layanan_dataAsalController::class, 'index'])->name('layanan.dp.data');
});


Route::group(['prefix' => 'orientasi'], function () {
    Route::get('/', [LayananOrientasiController::class, 'index'])->name('orientasi');
});

Route::group(['prefix' => 'helpdesk'], function () {
    Route::get('/aduan', [layananAduanController::class, 'index'])->name('helpdesk.aduan');
    Route::get('/aduan/{id}/{jenis}', [layananAduanController::class, 'ubah'])->name('helpdesk.aduan.ubah');
});


Route::group(['prefix' => 'legalisir'], function () {
    Route::get('/', [legalisir_formController::class, 'index'])->name('legalisir.index');
    Route::get('/{id}/refresh', [legalisir_formController::class, 'refresh'])->name('legalisir.refresh');
    Route::get('/{id}/pdf', [legalisir_formController::class, 'cetak_nota'])->name('legalisir.cetak');
    Route::post('/simpan', [legalisir_formController::class, 'simpan'])->name('legalisir.simpan');
    Route::post('/getlip', [legalisir_formController::class, 'getBYlip'])->name('legalisir.lip');
});

Route::group(['prefix' => 'faq'], function () {
    Route::get('/', [faqController::class, 'index'])->name('faq.dashboard');
    Route::get('/data', [faqController::class, 'data'])->name('faq.data');
    Route::get('/kategori', [faqKategori::class, 'index'])->name('faq.kategori');
    Route::get('/deskripsi', [faqDeskripsi::class, 'index'])->name('faq.deskripsi');
    Route::get('/{id}', [faqController::class, 'getFAQ'])->name('faq.get');
    Route::post('/deskripsi/simpan', [faqDeskripsi::class, 'simpan'])->name('faq.deskripsi.simpan');
    Route::get('/deskripsi/{id}/{jenis}', [faqDeskripsi::class, 'opsi'])->name('faq.deskripsi.opsi');

});


Route::group(['prefix' => 'srs'], function () {
    Route::post('/GetDP', [QuerySRSController::class, 'GetDP'])->name('srs.GetDP');
    Route::post('/getdpbynim', [QuerySRSController::class, 'getdpbynim'])->name('srs.getdpbynim');
    Route::post('/getdpbynimAJAX', [QuerySRSController::class, 'getdpbynimAJAX'])->name('srs.getdpbynimAJAX');
    Route::post('/getdpbynimCrop', [QuerySRSController::class, 'getdpbynimCrop'])->name('srs.getdpbynimCrop');
});


Route::group(['prefix' => 'ujian'], function () {
    Route::get('/numpangkeluar', [NumpangUjianKeluarController::class, 'index'])->name('ujian.numpangkeluar');
    Route::post('/numpangkeluar', [NumpangUjianKeluarController::class, 'cari'])->name('ujian.numpangkeluar.cari');
    Route::get('/numpangkeluar/{id}/reload', [NumpangUjianKeluarController::class, 'reload'])->name('ujian.numpangkeluar.reload');
    Route::get('/numpangkeluar/{id}/getD20an', [NumpangUjianKeluarController::class, 'get_d20an'])->name('ujian.numpangkeluar.getd20an');
    Route::get('/numpangkeluar/{id1}/{id2}/pdf', [NumpangUjianKeluarController::class, 'print_surat'])->name('ujian.numpangkeluar.cetaksurat');
    Route::get('/numpangkeluar/{id1}/{id2}/hapustpu', [NumpangUjianKeluarController::class, 'del_tpu'])->name('ujian.numpangkeluar.deltpu');
    Route::get('/numpangkeluar/{id1}/{id2}/hapusD20an', [NumpangUjianKeluarController::class, 'del_numpang'])->name('ujian.numpangkeluar.deld20an');
    Route::post('/tpu', [NumpangUjianKeluarController::class, 'cariTPU'])->name('ujian.caritpu');
    Route::post('/tpu/simpan', [NumpangUjianKeluarController::class, 'insertTPUTujuan'])->name('ujian.simpantpu');
    Route::post('/nomorsurat/simpan', [NumpangUjianKeluarController::class, 'simpan_nomorsurat'])->name('ujian.simpannomorsurat');



    Route::get('/l/numpangkeluar/', [NumpangUjianLaporanController::class, 'index'])->name('ujian.laporannumpang');
    Route::get('/l/numpangkeluar/jumlah', [NumpangUjianLaporanController::class, 'index_jumlah_mtk'])->name('ujian.laporannumpang.jumlahmtk');
    Route::post('/l/numpangkeluar/', [NumpangUjianLaporanController::class, 'get_daftar_numpang'])->name('ujian.laporannumpang.cari');
    Route::get('/l/pdf/{masa}/{t}', [NumpangUjianLaporanController::class, 'pdf'])->name('ujian.laporannumpang.pdf');


    Route::get('/numpangmasuk', [NumpangUjianmasukController::class, 'index'])->name('ujian.numpangmasuk');
    Route::post('/numpangmasuk', [NumpangUjianmasukController::class, 'cari'])->name('ujian.numpangmasuk.cari');
    Route::get('/numpangmasuk/{id}/reload', [NumpangUjianmasukController::class, 'reload'])->name('ujian.numpangmasuk.reload');
    Route::get('/numpangmasuk/{id}/getD20an', [NumpangUjianmasukController::class, 'get_d20an'])->name('ujian.numpangmasuk.getd20an');
    Route::get('/numpangkeluar/{id1}/{id2}/hapustpu', [NumpangUjianmasukController::class, 'del_tpu'])->name('ujian.numpangkeluar.deltpu');
    Route::get('/numpangkeluar/{id1}/{id2}/hapusD20an', [NumpangUjianmasukController::class, 'del_numpang'])->name('ujian.numpangkeluar.deld20an');

    Route::get('/l/numpangmasuk/', [NumpangUjianLaporanMasukController::class, 'index'])->name('ujian.laporannumpangmasuk');
    Route::post('/l/numpangmasuk/', [NumpangUjianLaporanMasukController::class, 'cari'])->name('ujian.laporannumpangmasuk.cari');
    Route::get('/l/{a}/{b}/{c}/{d}/{e}', [NumpangUjianLaporanMasukController::class, 'excel'])->name('ujian.laporannumpangmasuk.excel');

});

Route::group(['prefix' => 'ttm'], function () {
    Route::get('/jadwal', [ttmController::class, 'index'])->name('ttm.jadwal');
    Route::post('/jadwal', [ttmController::class, 'search'])->name('ttm.jadwal.cari');
    Route::get('/jadwal/{id1}/{id2}/{id3}', [ttmController::class, 'kelas'])->name('ttm.jadwal.kelas');
    Route::get('/mhs', [ttmController::class, 'ttm_mhs_by_nim'])->name('ttm.mhs');

});

Route::group(['prefix' => 'user'], function () {
    Route::get('/data', [Home::class, 'user_data'])->name('user.data');
});
Route::get('/refreshCaptcha', [Home::class, 'refreshCaptcha'])->name('refresh.captcha');

Route::group(['prefix' => 'view'], function () {
    Route::get('/surat/{id}/{jenis}', [SuratController::class,'index'])->name('verifikasisurat');

});

Route::group(['prefix' => 'vote'], function () {
    Route::get('/', [VoteController::class,'index'])->name('vote');
    Route::post('/', [VoteController::class,'simpan'])->name('vote.simpan');

});

Route::get('/home', [App\Http\Controllers\Home::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\Home::class, 'index']);


Route::get('crop-image-upload', [CropImageController::class, 'index']);
Route::post('crop-image-upload', [CropImageController::class, 'uploadCropImage']);

Route::get('image-cropper',[App\Http\Controllers\ImageCropperController::class,'index']);
Route::post('image-cropper/upload',[App\Http\Controllers\ImageCropperController::class,'upload']);

Auth::routes();



//Route::match(['get', 'post'], 'botman', [BotManController::class, 'handle']);
Route::match(['get', 'post'], '/botman', 'BotManController@handle');
