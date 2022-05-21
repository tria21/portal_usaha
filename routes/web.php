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
    if(session()->has('loginId')){
        session()->pull('loginId');
        session()->pull('loginName');
        return redirect('login');
    }
}]);

//DashboardAdminController
Route::get('/dashboard-admin', [App\Http\Controllers\DashboardAdminController::class, 'index'])->name('dashboard-admin');
Route::get('/data-akun-pemilik-usaha-admin', [App\Http\Controllers\DashboardAdminController::class, 'index_akun_pemilik'])->name('data-akun-pemilik-usaha-admin');
Route::get('/data-akun-masyarakat-admin', [App\Http\Controllers\DashboardAdminController::class, 'index_akun_masyarakat'])->name('data-akun-masyarakat-admin');
Route::get('/data-artikel-usaha', [App\Http\Controllers\DashboardAdminController::class, 'index_artikel_usaha'])->name('data-artikel-usaha');

//DashboardPemilikController
Route::get('/dashboard-pemilik-usaha', [App\Http\Controllers\DashboardPemilikController::class, 'index'])->name('dashboard-pemilik-usaha');
Route::get('/data-artikel-pemilik', [App\Http\Controllers\DashboardPemilikController::class, 'index_data_artikel'])->name('data-artikel-pemilik');
Route::get('/input-artikel-pemilik', [App\Http\Controllers\DashboardPemilikController::class, 'create'])->name('input-artikel-pemilik');
Route::post('/input-proses-artikel-pemilik', [App\Http\Controllers\DashboardPemilikController::class, 'store'])->name('input-proses-artikel-pemilik');
Route::get('/edit-artikel-pemilik/{id}', [App\Http\Controllers\DashboardPemilikController::class, 'edit'])->name('edit-artikel-pemilik');
Route::post('/edit-proses-artikel-pemilik/{id}', [App\Http\Controllers\DashboardPemilikController::class, 'update'])->name('edit-proses-artikel-pemilik');
Route::get('/hapus-artikel-pemilik/{id}', [App\Http\Controllers\DashboardPemilikController::class, 'destroy'])->name('hapus-artikel-pemilik');

//Admin_DataArtikelAdminController
Route::get('/data-artikel-admin', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'index'])->name('data-artikel-admin');
Route::get('/input-artikel-admin', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'create'])->name('input-artikel-admin');
Route::post('/input-proses-artikel-admin', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'store'])->name('input-proses-artikel-admin');
Route::get('/edit-artikel-admin/{id}', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'edit'])->name('edit-artikel-admin');
Route::post('/edit-proses-artikel-admin/{id}', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'update'])->name('edit-proses-artikel-admin');
Route::get('/hapus-artikel-admin/{id}', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'destroy'])->name('hapus-artikel-admin');

//CustomAuthController
Route::get('/data-profil-pemilik', [App\Http\Controllers\CustomAuthController::class, 'profil'])->name('data-profil-pemilik');
Route::post('/update-profil-pemilik/{id}', [App\Http\Controllers\CustomAuthController::class, 'update'])->name('update-profil-pemilik');
Route::post('/update-password-pemilik/{id}', [App\Http\Controllers\CustomAuthController::class, 'update_password'])->name('update-password-pemilik');

//DashboardPengunjungController
Route::get('/dashboard-pengunjung', [App\Http\Controllers\DashboardPengunjungController::class, 'index'])->name('dashboard-pengunjung');