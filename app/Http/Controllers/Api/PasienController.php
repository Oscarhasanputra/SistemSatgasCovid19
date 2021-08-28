<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PasienController extends Controller
{
    //
    public function getAllPasien(){
        return Pasien::all();
    }
    public function checking(Request $request){
        // Auth::guard("admin")->check();
        // return ['hello'=>"mesage"];
        $IDPasien=$request->IDPasien;
        try {
            $dataPasien=Pasien::findOrFail($IDPasien);
            return ['DataPasien'=>$dataPasien,'message'=>"Data Pasien Ditemukan, Silahkan Lanjutkan Pengisian Form"];
        } catch (\Throwable $th) {
            //throw $th;
            return response(['message'=>"Data Pasien Tidak Ditemukan"],Response::HTTP_NOT_FOUND);
        }
    }
    
    public function saveDataPasien(Request $request){
        $date=Carbon::now();
        $dataPasien= $request->all();

        $dataPasien['IDPasien']="PSN{$dataPasien['NoHP']}";
        try {
            $savedDataPasien=Pasien::findOrFail($dataPasien['IDPasien']);
            // no hp pasien sudah digunakan, atau pasien sudah terdaftar
            return response(['message'=>"No HP Pasien sudah terdaftar, tidak dapat menambahkan pasien baru kembali"],Response::HTTP_BAD_REQUEST);
            // $savedDataPasien->update($dataPasien);
        } catch (\Throwable $th) {
            //throw $th;
            // ketika data valid dan pasien belum terdaftar;
                try {
                    $file=Storage::disk("public")->putFileAs("images/uploaded",$request->file("FotoKTP"),"FotoKTP{$request->NoHP}-{$date}.png");
                    $dataPasien['FotoKTP']=$file;
                    //code...
                } catch (\Throwable $th) {
                    //throw $th;
                    return response(['message'=>'Terjadi Kegagalan Server dalam mengupload FotoKTP Pasien'],Response::HTTP_CONFLICT);
                }
               
            
            $savedDataPasien=Pasien::create($dataPasien);
            return ['message'=>"Pasien berhasil ditambahkan"];
        }
    }

    public function editDataPasien(Request $request,$id){
        $date=Carbon::now();
        $dataPasien= $request->all();
        // return $dataPasien;
        $dataPasien['IDPasien']="PSN{$dataPasien['NoHP']}";
        try {
            $savedDataPasien=Pasien::findOrFail($id);
            // return $savedDataPasien;
            if($request->hasFile("FileFotoKTP")){
                try {
                    $file=Storage::disk("public")->putFileAs("images/uploaded",$request->file("FileFotoKTP"),"FotoKTP{$request->NoHP}-{$date}.png");
                    $bool=Storage::disk("public")->exists($request->FotoKTP);
                    if($bool)
                        Storage::disk("public")->delete($request->FotoKTP);
                    
                    $dataPasien['FotoKTP']=$file;
                    //code...
                } catch (\Throwable $th) {
                    //throw $th;
                    return response(['message'=>'Terjadi Kegagalan Server dalam mengupload FotoKTP Pasien'],Response::HTTP_CONFLICT);
                }
            }
           
            $savedDataPasien->update($dataPasien);
        }catch(QueryException $err){
            $e=$err->errorInfo[1];
            if($e==1062){
                return response(['message'=>"No HP Pasien telah digunakan (terdaftar) oleh Pasien Lain"],Response::HTTP_CONFLICT);
            
            }
        } 
        catch (Exception $th) {
            
            return response(['message'=>"ID Pasien Tidak terdaftar, dalam Database tidak dapat melakukan perubahan terhadap Pasien tersebut"],Response::HTTP_BAD_REQUEST);
        
    }
            return ['message'=>"Pasien berhasil ditambahkan"];
    }

    public function deleteDataPasien($id){
        $dataPasien=Pasien::find($id);
        try {
            if(Storage::disk('public')->exists($dataPasien->FotoKTP)){
                Storage::disk('public')->delete($dataPasien->FotoKTP);
            }
            $dataPasien->delete();
            //code...
        } catch (\Throwable $th) {
            return response(['message'=>'Terjadi Kegagalan dalam menghapus data pasien'],Response::HTTP_CONFLICT);
            //throw $th;
        }
        
        return ['message'=>'Data Pasien berhasil dihapus'];
    }

}
