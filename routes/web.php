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
Route::get('/', [LoginController::class,'index']);

Route::post('/login', [LoginController::class,'login']
);


/////////////////////////////////
//          ADMIN             //
///////////////////////////////
Route::middleware(['auth', 'checkLevel:admin'])->group(function () {
    Route::get('/admin/dashboard', [Home::class,'admin']);
    Route::get('/admin/pegawai', [PegawaiController::class,'admin']);
     Route::resource('/admin/user', UserController::class);
     Route::get('/export-data', [UserController::class,'excel']);
    // Route::get('/admin/user', [UserController::class,'index']);
    // Route::post('/admin/user', [UserController::class,'store']);
    // Route::post('/admin/user/{{$id}}', [UserController::class,'destroy']);
    // Route::get('/pegawai', function () {
    //     return view('admin.pegawai.index');
    // });
});

/////////////////////////////////
//           HRD              //
///////////////////////////////
Route::middleware(['auth', 'checkLevel:hrd'])->group(function () {
    Route::get('/hrd', function () {
        return view('hrd.index');
    });
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

// Route::get('admin', function(){ return view('admin.index');})->middleware(('checkLevel:admin'));
