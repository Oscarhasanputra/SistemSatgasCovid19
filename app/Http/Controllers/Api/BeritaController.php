<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Storage;

class BeritaController extends Controller
{
    //
    public function getDetailBerita($id){
        try {
            //code...
            $berita= Berita::findOrFail($id);
            $list=Berita::all()->except($id);
            return ['berita'=>$berita,'list'=>$list];
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
                
                $fileName="blogImages-".$index."-".Carbon::now().'.png';
                try {

                $path=Storage::disk("public")->putFileAs("/images/blog",$file,$fileName);
                    //code...
                } catch (\Throwable $th) {
                    return response(['message'=>"Terjadi Kegagalan dalam mengupload Gambar"],Response::HTTP_BAD_REQUEST);
                }
                // $path=public_path()."/images/blog/";
                
                // $file->move($path,$fileName);
                array_push($filesReturn,"/".$path);
                // array_push($test,$file);
            }
        }
       
        return $filesReturn;
    }

    public function deleteImages(Request $request){
        $files=$request->get("filesDeleted");
       
        foreach($files as $file){
            if(file_exists(public_path().$file)){
                try {
                    //code...
                    $path=Storage::disk("public")->delete($file);
                } catch (\Throwable $th) {
                    //throw $th;
                }
                // unlink(public_path().$file);
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
            // throw $th;
            return response(['message'=>"Terjadi Kegagalan dalam mempublish Berita"],Response::HTTP_BAD_REQUEST);
     
        }
        return ['message'=>"Berita Berhasil dipublish"];
    }
}
