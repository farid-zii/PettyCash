<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Hrd;
use App\Http\Controllers\Finance;
use App\Http\Controllers\Direktur;
use App\Http\Controllers\Home;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KategoriPgwController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\PengajuanController;

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
//     return view('login');
// });
Route::get('/login', [LoginController::class,'index'])->name('login');

Route::post('/login', [LoginController::class,'login']
);


/////////////////////////////////
//          ADMIN             //
///////////////////////////////
Route::middleware(['auth', 'checkLevel:admin'])->group(function () {
    Route::get('/', [Home::class,'admin']);
     Route::resource('/admin/pangkat', PangkatController::class);
     Route::resource('/admin/pegawai', PegawaiController::class);
     Route::resource('/admin/jabatan', JabatanController::class);
     Route::resource('/admin/kategoriPgw', KategoriPgwController::class);
     Route::resource('/admin/departemen', DepartemenController::class);

     Route::post('/admin/saldo', [SaldoController::class,'store']);
     #region /// USER ///
     Route::resource('/admin/user', UserController::class);
     Route::get('/export-data', [UserController::class,'excel']);
     Route::get('/user-pdf', [UserController::class,'pdf']);
     Route::get('/a', [PengajuanController::class,'index']);
     #endregion
});

/////////////////////////////////
//           HRD              //
///////////////////////////////
Route::middleware(['auth', 'checkLevel:hrd'])->group(function () {
    Route::get('/', [Home::class, 'hrd']);
    Route::resource('/admin/pegawai', PegawaiController::class);
    Route::resource('/admin/saldo', SaldoController::class);
    Route::resource('/admin/pengajuan', PengajuanController::class);
    Route::get('/export-data', [UserController::class, 'excel']);
    Route::get('/pegawai', function () {
        return view('hrd.pegawai.index');
    });
});

/////////////////////////////////
//          FINANCE           //
///////////////////////////////
Route::middleware(['auth', 'checkLevel:finance'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    });
    Route::get('/pegawai', function () {
        return view('admin.pegawai.index');
    });
});

/////////////////////////////////
//          DIREKTUR          //
///////////////////////////////
Route::middleware(['auth', 'checkLevel:direktur'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    });
    Route::get('/pegawai', function () {
        return view('admin.pegawai.index');
    });
});
