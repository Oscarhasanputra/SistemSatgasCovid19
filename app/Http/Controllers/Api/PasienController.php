<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PasienController extends Controller
{
    //
    public function checking(Request $request){
        $IDPasien=$request->IDPasien;
        try {
            $dataPasien=Pasien::findOrFail($IDPasien);
            return ['DataPasien'=>$dataPasien,'message'=>"Data Pasien Ditemukan, Silahkan Lanjutkan Pengisian Form"];
        } catch (\Throwable $th) {
            //throw $th;
            return response(['message'=>"Data Pasien Tidak Ditemukan"],Response::HTTP_NOT_FOUND);
        }
    }
}
