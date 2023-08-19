<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('profile/{id}', [UserController::class,'PengaturanAkun']);
Route::get('searchNama', [UserController::class,'getNamaUser']);
Route::get('get-project', [PengajuanController::class,'getProject']);
Route::post('iPengajuan', [PengajuanController::class,'awal']);
Route::resource('pengajuan-del', PengajuanController::class);
// Route::get('/tab1', [PengajuanController::class,'tab1']);
Route::get('get-pengajuan', [PengajuanController::class,'pengajuan']);
