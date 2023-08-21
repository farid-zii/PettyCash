<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Home;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\FinanceHistoryController;
use App\Http\Controllers\FinancePegawaiController;
use App\Http\Controllers\FinancePengajuanController;
use App\Http\Controllers\FinanceRealisasiController;
use App\Http\Controllers\PegawaiPengajuanController;
use App\Http\Controllers\PegawaiRealisasiController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PimpinanaHistoryController;
use App\Http\Controllers\PimpinanHistoryController;
use App\Http\Controllers\PimpinanPegawaiController;
use App\Http\Controllers\PimpinanPengajuanController;
use App\Http\Controllers\RealisasiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\CetakHistoryController;
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
    return redirect('/login');
});
Route::get('/login', [LoginController::class,'index'])->name('login');

Route::post('/login', [LoginController::class,'login']
);
Route::get('/logout', [LoginController::class,'logout']);

Route::post('/cetak-excel', [PengajuanController::class, 'excel']);


/////////////////////////////////
//           HRD              //
///////////////////////////////
// Route::post('/iPengajuan', [PengajuanController::class,'awal']);
Route::middleware(['auth', 'checkLevel:hrd'])->group(function () {
    Route::get('hrd/dashboard', [Home::class, 'hrd']);
    Route::resource('/hrd/realisasi', RealisasiController::class);
    Route::resource('/hrd/pengajuan', PengajuanController::class);
    Route::post('/hrd/pengajuan-edit', [PengajuanController::class,'edit']);
    Route::resource('/hrd/pegawai', UserController::class);
    Route::resource('/hrd/departemen', DepartemenController::class);
    Route::resource('/hrd/bank', BankController::class);
    Route::resource('/hrd/saldo', SaldoController::class);
    Route::resource('/hrd/history', TransaksiController::class);
    Route::get('/hrd/profile', [ProfileController::class, 'admin']);
    Route::post('/hrd/profile', [ProfileController::class, 'update']);
    Route::get('/hrd/cetakhistory', [CetakHistoryController::class, 'cetakhistory'])->name('cetakhistory');
});

/////////////////////////////////
//          FINANCE           //
///////////////////////////////
Route::middleware(['auth', 'checkLevel:finance'])->group(function () {
    Route::get('finance/dashboard', [Home::class, 'finance'
    ]);
    Route::resource('/finance/saldo', SaldoController::class);
    Route::resource('/finance/realisasi', FinanceRealisasiController::class);
    Route::resource('/finance/history', FinanceHistoryController::class);
    Route::resource('/finance/pengajuan', FinancePengajuanController::class);
    Route::resource('/finance/pegawai', FinancePegawaiController::class);
    Route::post('/finance/pengajuan', [FinancePengajuanController::class,'update']);
    Route::get('/finance/pengajuan-index', [PengajuanController::class,'index_finance']);
    Route::resource('finance/departemen', DepartemenController::class);
    Route::get('/finance/profile', [ProfileController::class, 'finance']);
    Route::post('/profile-edit', [UserController::class, 'pengaturanAkun']);
});

/////////////////////////////////
//          Pimpinan          //
///////////////////////////////
Route::middleware(['auth', 'checkLevel:pimpinan'])->group(function () {
    Route::get('pimpinan/dashboard', [Home::class, 'pimpinan'
    ]);
    // Route::resource('/finance/saldo', SaldoController::class);
    // Route::resource('/finance/realisasi', FinanceRealisasiController::class);
    Route::resource('/pimpinan/history', PimpinanHistoryController::class);
    Route::resource('/pimpinan/pengajuan', PimpinanPengajuanController::class);
    Route::resource('/pimpinan/pegawai', PimpinanPegawaiController::class);
    Route::get('/pimpinan/profile', [ProfileController::class, 'pimpinan']);
    Route::post('/profile-edit', [UserController::class, 'pengaturanAkun']);
});

Route::middleware(['auth', 'checkLevel:pegawai'])->group(function () {
    Route::resource('/pegawai/realisasi', PegawaiRealisasiController::class);
    Route::resource('/pegawai/history', pegawaiHistoryController::class);
    Route::resource('/pegawai/pengajuan', PegawaiPengajuanController::class);
    Route::get('/pegawai/profile', [ProfileController::class, 'pegawai']);
    Route::post('/profile-edit', [UserController::class, 'pengaturanAkun']);
});

