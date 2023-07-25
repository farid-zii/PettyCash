<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Home;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KategoriPgwController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\RealisasiController;

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
Route::get('/logout', [LoginController::class,'logout']);


/////////////////////////////////
//           HRD              //
///////////////////////////////
// Route::post('/iPengajuan', [PengajuanController::class,'awal']);
Route::middleware(['auth', 'checkLevel:hrd'])->group(function () {
    Route::get('/', [Home::class, 'hrd']);
    Route::resource('/hrd/pegawaai', PegawaiController::class);
    // Route::resource('/saldo', SaldoController::class);
    Route::resource('/hrd/realisasi', RealisasiController::class);
    Route::resource('/hrd/pengajuan', PengajuanController::class);
    Route::post('/hrd/pengajuan-edit', [PengajuanController::class,'editPengajuan']);
    // Route::get('/cetak-excel', [PengajuanController::class,'excel']);
    Route::post('/cetak-excel', [PengajuanController::class,'excel']);
    Route::resource('/hrd/jabatan', JabatanController::class);
    Route::resource('/hrd/departemen', DepartemenController::class);
    Route::get('/profile', [ProfileController::class, 'admin']);
    Route::post('/profile-edit', [UserController::class, 'pengaturanAkun']);
    // Route::get('/pegawai', function () {
    //     return view('hrd.pegawai.index');
    // });
});

/////////////////////////////////
//          FINANCE           //
///////////////////////////////
Route::middleware(['auth', 'checkLevel:finance'])->group(function () {
    Route::get('/', [Home::class, 'finance'
    ]);
    Route::resource('/finance/pegawaai', PegawaiController::class);
    Route::resource('/finance/saldo', SaldoController::class);
    Route::resource('/finance/realisasi', RealisasiController::class);
    Route::resource('/finance/pengajuan', PengajuanController::class);
    Route::get('/finance/pengajuan-index', [PengajuanController::class,'index_finance']);
    // Route::get('/cetak-excel', [PengajuanController::class,'excel']);
    Route::post('/cetak-excel', [PengajuanController::class, 'excel']);
    Route::resource('/jabatan', JabatanController::class);
    Route::resource('/departemen', DepartemenController::class);
    Route::get('/profilee', [ProfileController::class, 'finance']);
    Route::post('/profile-edit', [UserController::class, 'pengaturanAkun']);
    // Route::get('/pegawai', function () {
    //     return view('hrd.pegawai.index');
    // });
});

