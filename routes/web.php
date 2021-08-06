<?php

use Illuminate\Support\Facades\Route;
use App\Models\Pasien;
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
// Route::get("/",function(){
//     return['message'=>"hello"];
// });
Route::get('/', function () {
    return view('main.main');
});
// Route::get('/{any}', function ($id) {
    
//     return view('main.main');
// });

Route::get('/admin', function () {
    return view('admin.admin');
});

Route::get('/konsultasi', function () {
    return view('admin.konsultasi');
});
Route::get('/pasien', function () {
    return view('admin.pasien');
});

Route::get('/obat', function () {
    return view('admin.obat');
});
Route::get('/dokter', function () {
    return view('admin.dokter');
});
Route::get('/oxy', function () {
    return view('admin.oxy');
});
Route::get('/pinjamoxy', function () {
    return view('admin.pinjamoxy');
});
Route::get('/donorplasma', function () {
    return view('admin.donorplasma');
});
Route::get('/login', function () {
    return view('admin.login');
});

//untuk login dokter
Route::get('/konsuldokter', function () {
    return view('admin.konsuldokter');
});