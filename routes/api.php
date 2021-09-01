<?php

use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\DonorPlasmaController;
use App\Http\Controllers\Api\ObatController;
use App\Http\Controllers\Api\OxygenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OxymeterController;
use App\Http\Controllers\Api\PasienController;
use App\Http\Controllers\Api\TelemedicineController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ApiObatController;
use App\Models\Berita;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\User;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/oxymeter',[OxymeterController::class,"save"]);
Route::post('/oxygen', [OxygenController::class,"save"]);
Route::post('/konsultasi',[TelemedicineController::class,"savingData"]);
Route::post('/donorplasma', [DonorPlasmaController::class,"savingData"]);
Route::get("/checkpasien",[PasienController::class,"checking"]);

Route::middleware(['admin:admin,doctor'])->group(function () {
    Route::get("admin",function(Request $request){
        // return Auth::guard('admin')->check();
        return dd(Auth::guard('doctor')->check());
    });
    Route::get("admin/test",function(Request $request){
        // return $request->user("admin");
        // session()->put("IDUsers","1");

        // session()->put("IDUser","ini berubah ke3");
        return ['test'=>session("IDUser")];
    });

});
Route::get("/berita",[BeritaController::class,"getData"]);
Route::get('berita/{id}',[BeritaController::class,"getDetailBerita"]);
Route::middleware(['admin:admin,doctor'])->group(function(){

    Route::get("konsultasi/dokter",[TelemedicineController::class,'getKonsultasiDokter']);
});

Route::middleware(['admin:admin,doctor'])->group(function(){
    Route::post("/uploadImages",[BeritaController::class,"uploadImages"]);
    Route::post("/berita",[BeritaController::class,'simpanData']);
    Route::delete("/deleteImages",[BeritaController::class,'deleteImages']);
    Route::delete("/berita/{id}",[BeritaController::class,'deleteData']);

    Route::post("user/admin",[UserController::class,"saveDataAdmin"]);
    Route::get("user/admin",[UserController::class,"getDataAdmin"]);
    Route::put("user/admin/{id}",[UserController::class,"updateDataAdmin"]);
    Route::delete('user/admin/{id}',[UserController::class,"deleteDataAdmin"]);
    Route::post("user/pasien",[PasienController::class,"saveDataPasien"]);
    Route::post("user/pasien/{id}",[PasienController::class,'editDataPasien']);
    Route::delete("user/pasien/{id}",[PasienController::class,'deleteDataPasien']);
    Route::get("user/pasien",[PasienController::class,"getAllPasien"]);
    
    Route::post("obat",[ObatController::class,'saveObat']);
    Route::get("obat",[ObatController::class,'getAllObat']);
    Route::get("obat/tersedia",[ObatController::class,'ketersediaanObat']);
    Route::delete("obat/{id}",[ObatController::class,'deleteObat']);
    Route::put("obat/{id}",[ObatController::class,'editObat']);
    
    Route::get("konsultasi",[TelemedicineController::class,'getAllKonsultasi']);
    Route::put("konsultasi/{id}",[TelemedicineController::class,'updateKonsultasi']);
    Route::put("dokter/konsultasi/{id}",[TelemedicineController::class,'dokterUpdateKonsultasi']);

    Route::post('user/dokter', [UserController::class,'saveDataDokter']);
    Route::get("user/dokter",[UserController::class,'getDataDokter']);
    Route::put('user/dokter/{id}',[UserController::class,'updateDataDokter']);
    Route::delete('user/dokter/{id}',[UserController::class,'deleteDataDokter']);

    Route::post("data/oxygen",[OxygenController::class,'saveDataOxy']);
    Route::get("data/oxygen",[OxygenController::class,'getAllData']);
    Route::put("data/oxygen/{id}",[OxygenController::class,'updateDataOxy']);
    Route::delete('data/oxygen/{id}',[OxygenController::class,'deleteDataOxy']);

    Route::get('oxy',[OxygenController::class,'getDataOxy']);
    Route::put('/oxy/{id}',[OxygenController::class,'updateDataPinjam']);
    // Route::put()

    Route::get("pendonor",[DonorPlasmaController::class,'getAllData']);
    Route::put("donor/{id}",[DonorPlasmaController::class,'adminUpdate']);
});
