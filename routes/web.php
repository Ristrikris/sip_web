<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@log');


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

//Mahasiswa
Route::post('/home_mahasiswa', 'HomeController@isiData');

//Dosen
Route::get('/home_dosen', 'HomeController@index_dosen')->name('home_dosen');

//Perwalian Umum
Route::get('/sip/perwalianUmum', 'DosenController@tampilPerwalianUmum');
Route::get('/sip/tambahPerwalianUmum', 'DosenController@formPerwalianUmum');
Route::post('/sip/tambah_perwalianUmum', 'DosenController@tambahPerwalianUmum');
Route::get('/sip/editPerwalian/{id}', 'DosenController@formEdit');
Route::put('/sip/edit_perwalian/{id}', 'DosenController@simpanEdit');
Route::get('/sip/selesai/{id}', 'DosenController@perwalianSelesai');
Route::get('/sip/lihatPeserta/{id}', 'DosenController@lihatPeserta');
Route::get('/sip/tambahPeserta/{id}', 'DosenController@tambahPeserta');
Route::get('/sip/tambahCatatan/{id}', 'DosenController@tambahCatatan');
Route::put('/sip/simpanCatatan/{id}', 'DosenController@simpanCatatan');
Route::get('/sip/report/{id}', 'DosenController@report');

//Perwalian Mandiri
Route::get('/sip/perwalianMandiri', 'DosenController@tampilPerwalianMandiri');
Route::get('/sip/tambahPerwalianMandiri', 'DosenController@formPerwalianMandiri');
Route::post('/sip/tambah_perwalianMandiri', 'DosenController@tambahPerwalianMandiri');
Route::get('/sip/editPerwalianMandiri/{id}', 'DosenController@formEditMandiri');
Route::put('/sip/edit_perwalianMandiri/{id}', 'DosenController@simpanEditMandiri');
Route::get('/sip/lihatPesertaMandiri/{id}', 'DosenController@lihatPesertaMandiri');
Route::post('/sip/tambahPesertaMandiri/{id}', 'DosenController@tambahPesertaMandiri');
Route::get('/sip/tambahCatatanMandiri/{id}', 'DosenController@tambahCatatanMandiri');
Route::put('/sip/simpanCatatanMandiri/{id}', 'DosenController@simpanCatatanMandiri');
Route::get('/sip/reportMandiri/{id}', 'DosenController@reportMandiri');
Route::get('/sip/selesaiMandiri/{id}', 'DosenController@perwalianMandiriSelesai');

//Layanan Dosen
Route::get('/sip/lihatKhs', 'DosenController@lihatKhs');
Route::get('/sip/lihatMahasiswa', 'DosenController@lihatMahasiswa');
Route::get('/sip/lihatPengajuan', 'DosenController@listPengajuan');
Route::get('/sip/terimaPengajuan/{id}', 'DosenController@terimaPengajuan');
Route::get('/sip/tolakPengajuan/{id}', 'DosenController@tolakPengajuan');

//Admin
Route::get('/home_admin', 'HomeController@index_koor')->name('home_admin');

//Admin mengurus dosen
Route::get('/sip/tampilDosen', 'AdminController@tampilDosen');
Route::get('/sip/tambahDosen', 'AdminController@formTambahDosen');
Route::post('/sip/tambah_dosen', 'AdminController@tambahDosen');
Route::get('/sip/delete_dosen/{id}', 'AdminController@deleteDosen');
Route::get('/sip/editDosen/{id}', 'AdminController@editDosen');
Route::put('/sip/updated_dosen/{id}', 'AdminController@updateDosen');

//Admin mengurus mahasiswa
Route::get('/sip/tampilMahasiswa', 'AdminController@tampilMahasiswa');
Route::get('/sip/tambahMahasiswa', 'AdminController@formTambahMahasiswa');
Route::post('/sip/tambah_mahasiswa', 'AdminController@tambahMahasiswa');
Route::get('/sip/editMahasiswa/{id}', 'AdminController@editMahasiswa');
Route::put('/sip/updated_mahasiswa/{id}', 'AdminController@updateMahasiswa');
Route::get('/sip/delete_mahasiswa/{id}', 'AdminController@deleteMahasiswa');
Route::get('/sip/opentranskrip/{id}', 'AdminController@openTranskrip');
Route::get('/sip/tambahKhs/{id}', 'AdminController@tambahKhs');
Route::post('/sip/tambah_khs', 'AdminController@simpanKhs');
Route::get('/sip/openKhs/{id}', 'AdminController@openKhs');
Route::get('/sip/tampilKhs', 'AdminController@tampilanKhs');

//Mahasiswa
Route::get('/sip/mahasiswa', 'MahasiswaController@tampilanMahasiswa');
Route::get('/sip/pengajuan', 'MahasiswaController@tampilPengajuan');
Route::post('/sip/simpanPengajuan', 'MahasiswaController@simpanPengajuan');

//GOOGLE
Route::get('redirect/{driver}', 'Auth\LoginController@redirectToProvider')->name('login.provider');
Route::get('{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.callback');

