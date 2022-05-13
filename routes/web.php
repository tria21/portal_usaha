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

//Dashboard
Route::get('/dashboard-admin', [App\Http\Controllers\DashboardAdminController::class, 'index'])->name('dashboard-admin');
Route::get('/dashboard-pemilik-usaha', [App\Http\Controllers\DashboardPemilikController::class, 'index'])->name('dashboard-pemilik-usaha');

//Admin-Akun-Pemilik-Usaha
Route::get('/data-akun-pemilik-usaha-admin', [App\Http\Controllers\Admin_DataAkunPemilikUsahaController::class, 'index'])->name('data-akun-pemilik-usaha-admin');

//Admin-Akun-Masyarakat
Route::get('/data-akun-masyarakat-admin', [App\Http\Controllers\Admin_DataAkunMasyarakatController::class, 'index'])->name('data-akun-masyarakat-admin');

//Admin-Artikel-Admin
Route::get('/data-artikel-admin', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'index'])->name('data-artikel-admin');
Route::get('/input-artikel-admin', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'create'])->name('input-artikel-admin');
Route::post('/input-proses-artikel-admin', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'store'])->name('input-proses-artikel-admin');
Route::get('/edit-artikel-admin/{id}', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'edit'])->name('edit-artikel-admin');
Route::post('/edit-proses-artikel-admin/{id}', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'update'])->name('edit-proses-artikel-admin');
Route::get('/hapus-artikel-admin/{id}', [App\Http\Controllers\Admin_DataArtikelAdminController::class, 'destroy'])->name('hapus-artikel-admin');

//Admin-Artikel-Usaha
Route::get('/data-artikel-usaha', [App\Http\Controllers\Admin_DataArtikelUsahaController::class, 'index'])->name('data-artikel-usaha');