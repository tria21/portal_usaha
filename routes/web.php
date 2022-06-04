<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::get('/', function () {
    return view('welcome');
});

//Route Login
Route::get('/login', [App\Http\Controllers\CustomAuthController::class, 'login'])->name('login');
Route::get('/registration', [App\Http\Controllers\CustomAuthController::class, 'registration']);
Route::get('/registration-owner-form', [App\Http\Controllers\CustomAuthController::class, 'registrationOwnerForm']);
Route::post('/registration-user', [App\Http\Controllers\CustomAuthController::class, 'registrationUser'])->name('register-user');
Route::post('/registration-owner', [App\Http\Controllers\CustomAuthController::class, 'registrationOwner'])->name('register-owner');
Route::post('/login-user', [App\Http\Controllers\CustomAuthController::class, 'loginUser'])->name('login-user');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::get('/dashboard', [App\Http\Controllers\CustomAuthController::class, 'dashboard']);
Route::get('/coba', function () {
    return view('auth.coba');
});
Route::get('/logout', ['as' => 'logout', function (){
    session()->pull('loginId');
    session()->pull('loginName');
    return redirect('login');
}]);

//tes

//DashboardAdminController
Route::get('/dashboard-admin', [App\Http\Controllers\DashboardAdminController::class, 'index'])->name('dashboard-admin');
Route::get('/data-akun-pemilik-usaha-admin', [App\Http\Controllers\DashboardAdminController::class, 'index_akun_pemilik'])->name('data-akun-pemilik-usaha-admin');
Route::get('/detail-akun-pemilik-usaha/{id}', [App\Http\Controllers\DashboardAdminController::class, 'detail_akun_pemilik'])->name('detail-akun-pemilik-usaha');
Route::get('/cetak-akun-pemilik-usaha', [App\Http\Controllers\DashboardAdminController::class, 'cetak_akun_pemilik'])->name('cetak-akun-pemilik-usaha');
Route::get('/export-excel-akun-pemilik-usaha', [App\Http\Controllers\DashboardAdminController::class, 'export_excel_pemilik'])->name('export-excel-akun-pemilik-usaha');
Route::get('/cari-akun-pemilik-usaha', [App\Http\Controllers\DashboardAdminController::class, 'cari_akun_pemilik'])->name('cari-akun-pemilik-usaha');

Route::get('/data-akun-masyarakat-admin', [App\Http\Controllers\DashboardAdminController::class, 'index_akun_masyarakat'])->name('data-akun-masyarakat-admin');
Route::get('/cetak-akun-masyarakat', [App\Http\Controllers\DashboardAdminController::class, 'cetak_akun_masyarakat'])->name('cetak-akun-masyarakat');
Route::get('/export-excel-akun-masyarakat', [App\Http\Controllers\DashboardAdminController::class, 'export_excel_masyarakat'])->name('export-excel-akun-masyarakat');

Route::get('/data-artikel-usaha', [App\Http\Controllers\DashboardAdminController::class, 'index_artikel_usaha'])->name('data-artikel-usaha');
Route::get('/detail-artikel-usaha/{id}', [App\Http\Controllers\DashboardAdminController::class, 'detail_artikel_usaha'])->name('detail-artikel-usaha');
Route::get('/cetak-artikel-usaha', [App\Http\Controllers\DashboardAdminController::class, 'cetak_artikel_usaha'])->name('cetak-artikel-usaha');
Route::get('/export-excel-artikel-usaha', [App\Http\Controllers\DashboardAdminController::class, 'export_excel_artikel_usaha'])->name('export-excel-artikel-usaha');
Route::get('/cari-artikel-usaha', [App\Http\Controllers\DashboardAdminController::class, 'cari_artikel_usaha'])->name('cari-artikel-usaha');

Route::get('/data-tentang', [App\Http\Controllers\DashboardAdminController::class, 'index_data_tentang'])->name('data-tentang');
Route::get('/input-tentang', [App\Http\Controllers\DashboardAdminController::class, 'create_tentang'])->name('input-tentang');
Route::post('/input-proses-tentang', [App\Http\Controllers\DashboardAdminController::class, 'store_tentang'])->name('input-proses-tentang');
Route::post('/update-tentang/{id}', [App\Http\Controllers\DashboardAdminController::class, 'update_data_beranda'])->name('update-tentang');
Route::get('/edit-tentang/{id}', [App\Http\Controllers\DashboardAdminController::class, 'edit_data_beranda'])->name('edit-tentang');
Route::post('/edit-proses-tentang/{id}', [App\Http\Controllers\DashboardAdminController::class, 'update_data_beranda'])->name('edit-proses-tentang');

Route::get('/data-beranda', [App\Http\Controllers\DashboardAdminController::class, 'index_data_beranda'])->name('data-beranda');
Route::get('/input-galeri', [App\Http\Controllers\DashboardAdminController::class, 'create_galeri'])->name('input-galeri');
Route::post('/input-proses-galeri', [App\Http\Controllers\DashboardAdminController::class, 'store_galeri'])->name('input-proses-galeri');
Route::get('/edit-galeri/{id}', [App\Http\Controllers\DashboardAdminController::class, 'edit_galeri'])->name('edit-galeri');
Route::post('/edit-proses-galeri/{id}', [App\Http\Controllers\DashboardAdminController::class, 'update_galeri'])->name('edit-proses-galeri');
Route::get('/hapus-galeri/{id}', [App\Http\Controllers\DashboardAdminController::class, 'destroy_galeri'])->name('hapus-galeri');
Route::get('/cari-galeri', [App\Http\Controllers\DashboardAdminController::class, 'cari_galeri'])->name('cari-galeri');

Route::get('/data-komentar', [App\Http\Controllers\DashboardAdminController::class, 'index_komentar'])->name('data-komentar');
Route::get('/cari-komentar', [App\Http\Controllers\DashboardAdminController::class, 'cari_komentar'])->name('cari-komentar');

//DashboardPemilikController
Route::get('/dashboard-pemilik-usaha', [App\Http\Controllers\DashboardPemilikController::class, 'index'])->name('dashboard-pemilik-usaha');
Route::get('/data-artikel-pemilik', [App\Http\Controllers\DashboardPemilikController::class, 'index_data_artikel'])->name('data-artikel-pemilik');
Route::get('/detail-artikel-pemilik/{id}', [App\Http\Controllers\DashboardPemilikController::class, 'detail'])->name('detail-artikel-pemilik');
Route::get('/cetak-artikel-pemilik', [App\Http\Controllers\DashboardPemilikController::class, 'cetak_artikel_pemilik'])->name('cetak-artikel-pemilik');
Route::get('/export-excel-artikel-pemilik', [App\Http\Controllers\DashboardPemilikController::class, 'export_excel_artikel_pemilik'])->name('export-excel-artikel-pemilik');
Route::get('/cari-artikel-pemilik', [App\Http\Controllers\DashboardPemilikController::class, 'cari_artikel_pemilik'])->name('cari-artikel-pemilik');
Route::get('/input-artikel-pemilik', [App\Http\Controllers\DashboardPemilikController::class, 'create'])->name('input-artikel-pemilik');
Route::post('/input-proses-artikel-pemilik', [App\Http\Controllers\DashboardPemilikController::class, 'store'])->name('input-proses-artikel-pemilik');
Route::get('/edit-artikel-pemilik/{id}', [App\Http\Controllers\DashboardPemilikController::class, 'edit'])->name('edit-artikel-pemilik');
Route::post('/edit-proses-artikel-pemilik/{id}', [App\Http\Controllers\DashboardPemilikController::class, 'update'])->name('edit-proses-artikel-pemilik');
Route::get('/hapus-artikel-pemilik/{id}', [App\Http\Controllers\DashboardPemilikController::class, 'destroy'])->name('hapus-artikel-pemilik');
Route::get('/data-komentar-pemilik', [App\Http\Controllers\DashboardPemilikController::class, 'index_komentar'])->name('data-komentar-pemilik');

//Admin_DataArtikelAdminController
Route::get('/data-artikel-admin', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'index'])->name('data-artikel-admin');
Route::get('/detail-artikel-admin/{id}', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'detail'])->name('detail-artikel-admin');
Route::get('/cetak-artikel-admin', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'cetak_artikel_admin'])->name('cetak-artikel-admin');
Route::get('/export-excel-artikel-admin', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'export_excel_artikel_admin'])->name('export-excel-artikel-admin');
Route::get('/input-artikel-admin', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'create'])->name('input-artikel-admin');
Route::post('/input-proses-artikel-admin', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'store'])->name('input-proses-artikel-admin');
Route::get('/edit-artikel-admin/{id}', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'edit'])->name('edit-artikel-admin');
Route::post('/edit-proses-artikel-admin/{id}', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'update'])->name('edit-proses-artikel-admin');
Route::get('/hapus-artikel-admin/{id}', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'destroy'])->name('hapus-artikel-admin');
Route::get('/cari-artikel-admin', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'cari'])->name('cari-artikel-admin');

//CustomAuthController
Route::get('/data-profil-pemilik', [App\Http\Controllers\CustomAuthController::class, 'profil'])->name('data-profil-pemilik');
Route::post('/update-profil-pemilik/{id}', [App\Http\Controllers\CustomAuthController::class, 'update'])->name('update-profil-pemilik');
Route::post('/update-password-pemilik/{id}', [App\Http\Controllers\CustomAuthController::class, 'update_password'])->name('update-password-pemilik');
Route::get('/input-sosmed', [App\Http\Controllers\CustomAuthController::class, 'create_sosmed'])->name('input-sosmed');
Route::post('/input-proses-sosmed', [App\Http\Controllers\CustomAuthController::class, 'store_sosmed'])->name('input-proses-sosmed');
Route::get('/edit-sosmed/{id}', [App\Http\Controllers\CustomAuthController::class, 'edit_sosmed'])->name('edit-sosmed');
Route::post('/edit-proses-sosmed/{id}', [App\Http\Controllers\CustomAuthController::class, 'update_sosmed'])->name('edit-proses-sosmed');
Route::get('/hapus-sosmed/{id}', [App\Http\Controllers\CustomAuthController::class, 'destroy'])->name('hapus-sosmed');

//DashboardPengunjungController
Route::get('/dashboard-pengunjung', [App\Http\Controllers\DashboardPengunjungController::class, 'index'])->name('dashboard-pengunjung');
Route::get('/read-more-artikel-beranda/{id}', [App\Http\Controllers\DashboardPengunjungController::class, 'readMore'])->name('read-more-artikel-beranda');
Route::get('/tampil-artikel-kategori/{kategori}', [App\Http\Controllers\DashboardPengunjungController::class, 'baseKategori'])->name('tampil-artikel-kategori');
Route::get('/tampil-artikel', [App\Http\Controllers\DashboardPengunjungController::class, 'tampilArtikel'])->name('tampil-artikel');
Route::get('/tampil-usaha', [App\Http\Controllers\DashboardPengunjungController::class, 'tampilUsaha'])->name('tampil-usaha');
Route::get('/profil-usaha/{id}', [App\Http\Controllers\DashboardPengunjungController::class, 'profilUsaha'])->name('profil-usaha');
Route::post('/read-more-artikel-beranda/{id}', [App\Http\Controllers\DashboardPengunjungController::class, 'store_komentar'])->name('input-proses-komentar');
Route::get('/hapus-komen/{id}', [App\Http\Controllers\DashboardPengunjungController::class, 'destroy_komen'])->name('hapus-komen');
Route::get('/tampil-tentang', [App\Http\Controllers\DashboardPengunjungController::class, 'tampilTentang'])->name('tampil-tentang');
Route::post('/edit-proses-akun-pengunjung/{id}', [App\Http\Controllers\DashboardPengunjungController::class, 'updateAkun'])->name('edit-proses-akun-pengunjung');
Route::get('/edit-akun-pengunjung', [App\Http\Controllers\DashboardPengunjungController::class, 'editAkun'])->name('edit-akun-pengunjung');
Route::get('/cari-artikel', [App\Http\Controllers\DashboardPengunjungController::class, 'cari_artikel'])->name('cari-artikel');
Route::get('/cari-usaha', [App\Http\Controllers\DashboardPengunjungController::class, 'cari_usaha'])->name('cari-usaha');