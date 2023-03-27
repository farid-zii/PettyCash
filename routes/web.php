<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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
//     return view('admin.index');
// });
Route::get('/login', function () {
    return view('login');
});
Route::get('/admin', function () {
    return view('admin.index');
});
Route::get('/pegawai', function () {
    return view('admin.pegawai.index');
});


Route::post('/login', [LoginController::class,'login']
);

// Route::get('admin', function(){ return view('admin.index');})->middleware(('checkLevel:admin'));
