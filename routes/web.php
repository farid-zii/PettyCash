<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Home;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\FinancePengajuanController;
use App\Http\Controllers\FinanceRealisasiController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\RealisasiController;
use App\Http\Controllers\TransaksiController;

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
});

/////////////////////////////////
//          FINANCE           //
///////////////////////////////
Route::middleware(['auth', 'checkLevel:finance'])->group(function () {
    Route::get('finance/dashboard', [Home::class, 'finance'
    ]);
    Route::resource('/finance/saldo', SaldoController::class);
    Route::resource('/finance/realisasi', FinanceRealisasiController::class);
    Route::resource('/finance/pengajuan', FinancePengajuanController::class);
    Route::post('/finance/pengajuan', [FinancePengajuanController::class,'update']);
    Route::get('/finance/pengajuan-index', [PengajuanController::class,'index_finance']);
    Route::resource('finance/departemen', DepartemenController::class);
    Route::get('/finance/profile', [ProfileController::class, 'finance']);
    Route::post('/profile-edit', [UserController::class, 'pengaturanAkun']);
    // Route::get('/pegawai', function () {
    //     return view('hrd.pegawai.index');
    // });
});

