<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Hrd;
use App\Http\Controllers\Finance;
use App\Http\Controllers\Direktur;

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
Route::get('/login', function () {
    return view('login');
});
Route::get('/admin', function () {
    return view('admin.index');
});
Route::get('/hrd', function () {
    return view('hrd.index');
});
Route::get('/pegawai', function () {
    return view('admin.pegawai.index');
});

Route::middleware(['auth', 'check'])->group(function () {

});


Route::post('/login', [LoginController::class,'login']
);

// Route::get('admin', function(){ return view('admin.index');})->middleware(('checkLevel:admin'));
