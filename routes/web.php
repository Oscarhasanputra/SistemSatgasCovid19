<?php

use App\Http\Controllers\Api\TelemedicineController;
use App\Http\Controllers\Api\UserController;
use App\Models\Telemedicine;
use Illuminate\Http\Request;
// use Auth;

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
// Route::get("/",function(){
//     return['message'=>"hello"];
// });



Route::get('/', function (Request $request) {
    // return dd(session("IDUser"));
    // return dd(Auth::guard('admin')->validate);
    return view('main.main');
});
Route::post("/logout",[UserController::class,"logout"]);
Route::get("/testsession",function(){

    return dd(Auth::guard('doctor')->check());   
});
Route::prefix("/admin")->middleware(['admin.route:admin'])->group(function(){
    Route::get("/",function(){
        return view("admin.main");
    });
    Route::get("/{any}",function(){
        return view("admin.main");
    });
    Route::get("/{any}/{url}",function(){
        return view("admin.main");
    });
});
Route::prefix("/dokter")->middleware(['admin.route:doctor'])->group(function(){
    Route::get("/",function(){
        return view("admin.main");
    });
    Route::get("/{any}",function(){
        return view("admin.main");
    });
});
// Route::get('/admin', function () {
//     // return dd("hello");
//     return view('admin.main');
// });

// Route::get('/konsultasi', function () {
//     return view('admin.main');
// });
// Route::get('/pasien', function () {
//     return view('admin.pasien');
// });

// Route::get('/obat', function () {
//     return view('admin.obat');
// });
// Route::get('/dokter', function () {
//     return view('admin.dokter');
// });
// Route::get('/oxy', function () {
//     return view('admin.oxy');
// });
// Route::get('/pinjamoxy', function () {
//     return view('admin.pinjamoxy');
// });
// Route::get('/donorplasma', function () {
//     return view('admin.donorplasma');
// }); gk ada file blade.php-nya

Route::get('/login', function () {
    return view('admin.login');
});
Route::post("/login",[UserController::class,"login"]);
// Route::post("/",fu)

//untuk login dokter
// Route::get('/konsuldokter', function () {
//     return view('admin.konsuldokter');
// });
Route::get('/{any}', function ($id) {
    // session()->put("IDUser","well");
    
    return view('main.main');
});
Route::get('/{any}/{id}', function ($id) {
    // session()->put("IDUser","well");
    
    return view('main.main');
});

