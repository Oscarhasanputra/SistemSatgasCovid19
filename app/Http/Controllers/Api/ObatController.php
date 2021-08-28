<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ObatController extends Controller
{
    //
    public function getAllObat(){
        return Obat::all();
    }
    public function ketersediaanObat(){
        return Obat::where("Jumlah",">","0")->get();
    }
    public function saveObat(Request $request){
        $data=$request->all();
        $date= Carbon::now();
        $data['TglInsert']=$date;
        $data['UserInsert']=Auth::guard('admin')->user()->IDUser;
        // return $data;
        try {
            Obat::create($data);
            //code...
        } catch (\Throwable $th) {
            return response(['message'=>'Terjadi Kesalahan dalam Menambahkan Obat'],Response::HTTP_BAD_REQUEST);
            // throw $th;
        }
        return ['message'=>'Obat berhasil ditambahkan'];
    }

    public function deleteObat($id){
        try {
            Obat::findOrFail($id)->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return response(['message'=>'Terjadi Kesalahan dalam menghapus data Obat'],Response::HTTP_CONFLICT);
        }
        return ['message'=>'Data Obat berhasil dihapus'];
    }
    public function editObat(Request $request, $id){
        try {
            $dataObat= Obat::findOrFail($id);
            $data=$request->all();
            $data['TglUpdate']=Carbon::now();
            $data['UserUpdate']=Auth::guard('admin')->user()->IDUser;
            $dataObat->update($data);
            // $dataObat->update($request->al)
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return response(['message'=>'Terjadi Kesalahan dalam Mengupdate Data Obat'],Response::HTTP_BAD_REQUEST);
        }
        return ['message'=>'Data Obat berhasil diupdate'];
    }

}
