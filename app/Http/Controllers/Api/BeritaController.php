<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BeritaController extends Controller
{
    //
    public function getDetailBerita($id){
        try {
            //code...

            $berita= Berita::findOrFail($id);
            return $berita;
        } catch (\Throwable $th) {
            //throw $th;
            return response(['message'=>"Berita Tidak Ditemukan"],Response::HTTP_NOT_FOUND);
     
        }
    }
    public function getData(Request $request)
    {
        $data= Berita::orderBy("IDBerita")->with("admin")->get();
        return $data;
        # code...
    }
    public function uploadImages(Request $request){
        
        $filesReturn=[];
        if($request->hasFile("fileImages")){
            $files=$request->file("fileImages");
            foreach($files as $index=>$file){
                $path=public_path()."/images/blog/";
                $fileName="blogImages-".$index."-".Carbon::now().'.png';
                $file->move($path,$fileName);
                array_push($filesReturn,"/images/blog/".$fileName);
                // array_push($test,$file);
            }
        }
       
        return $filesReturn;
    }

    public function deleteImages(Request $request){
        $files=$request->get("filesDeleted");
        foreach($files as $file){
            if(file_exists(public_path().$file)){
                unlink(public_path().$file);
            }
        }
        return $files;
    }
    public function deleteData($id){
        try {
            Berita::findOrFail($id)->delete();
            
        return ['message'=>"Berita Berhasil dihapus"];
        } catch (\Throwable $th) {
            // throw $th;
            return response(['message'=>"Terjadi Kegagalan dalam Menghapus Berita"],Response::HTTP_BAD_REQUEST);
     
        }
    }
    public function simpanData(Request $request){
        $data=$request->all();
        $data['created_at']=Carbon::now();
        $data['IDAdmin']=Auth::guard("admin")->user()->IDUser;
        // return $data;
        try {
            //code...

        Berita::updateOrCreate(['IDBerita'=>$request->IDBerita],$data);
        } catch (\Throwable $th) {
            throw $th;
            return response(['message'=>"Terjadi Kegagalan dalam mempublish Berita"],Response::HTTP_BAD_REQUEST);
     
        }
        return ['message'=>"Berita Berhasil dipublish"];
    }
}
