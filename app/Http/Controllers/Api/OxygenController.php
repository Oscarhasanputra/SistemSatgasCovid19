<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Oxygen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Pasien;
use App\Models\Pinjam;
use Auth;

class OxygenController extends Controller
{

    public function getDataOxy(Request $request){
        if($status=$request->Status){
            return Pinjam::where("Status","=",$status)->with("pasien")->get();
        }
       return Pinjam::with("pasien")->get();
    }
   
    public function save(Request $request){
       
        $date=Carbon::now();
        $data=$request->all();

        $model= new Pasien();
        $fieldPasien= $model->getFillable();
        $dataPasien=array_intersect_key($data,array_flip($fieldPasien));
        
        //cari data pasien atau buat data pasien baru
        $dataPasien['IDPasien']="PSN{$dataPasien['NoHP']}";
        // print($dataPasien);
        
        if($request->NoHPPenanggung!=null)
            $dataPasien['IDPenanggung']="PNG{$dataPasien['NoHPPenanggung']}";
        $savedDataPasien=[];
        try {
            $savedDataPasien=Pasien::findOrFail($dataPasien['IDPasien']);
            $savedDataPasien->update($dataPasien);
        } catch (\Throwable $th) {
            //throw $th;
            $savedDataPasien=Pasien::create($dataPasien);
        }
        //check data transaksi pinjam dari pasien
        
         $dataPinjamPasien=Pinjam::where("IDPasien","=",$savedDataPasien->IDPasien)
                            ->where("Status","=","Menunggu")
                            ->where("JenisPinjaman","=","Oxygen")
                            ->get();
        // jika data pinjam pasien masih dalam proses maka tidak dapat mengajukan peminjaman
        if($dataPinjamPasien->count()>0){
            return response(['message'=>"Masih terdapat Pengajuan lain dalam proses, tidak dapat mengajukan kembali"],Response::HTTP_BAD_REQUEST);
        }
        $dataTransaksiPinjam=array_diff_key($data,array_flip($fieldPasien));
       
        //

        try {
            //simpan bukti foto swab dan foto saturasi
            $dataTransaksiPinjam=$this->saveDataPinjam($dataTransaksiPinjam,$request);
            //check apakah fotoktp dari pasien sudah ada atau belum
            if(!(Storage::disk("public")->exists($savedDataPasien->FotoKTP))){
                
                $file=Storage::disk("public")->putFileAs("images/uploaded",$request->file("FotoKTP"),"FotoKTP{$savedDataPasien->NoHP}-{$date}.png");
                $savedDataPasien->FotoKTP=$file;
                // mengupdate fotoktp pasien
                $savedDataPasien->save();
            }
        } catch (\Throwable $th) {
            // terjadi ketika file foto yang diinginkan tidak diupload oleh user
            // Storage::disk("public"->delete)
            return response(['message'=>"Terjadi Kegagalan dalam Memproses Data Anda, Mohon Ulangi Lagi"],Response::HTTP_BAD_REQUEST);
        }

        //simpan data peminjaman pasien
        $dataTransaksiPinjam['IDPasien']=$savedDataPasien->IDPasien;
        $dataTransaksiPinjam['created_at']=$date;
        Pinjam::create($dataTransaksiPinjam);
        
        return ['message'=>"Pengajuan Form Peminjaman Oxymeter berhasil dilakukan"];
    }

    private function saveDataPinjam($dataTransaksiPinjam,Request $request){
        try {

            $date=Carbon::now();
            $file=Storage::disk("public")->putFileAs("images/uploaded",$request->file("BuktiSwab"),"BuktiSwab{$date}.png");
            $dataTransaksiPinjam['BuktiSwab']=$file;
            $fotoSaturasi=Storage::disk("public")->putFileAs("images/uploaded",$request->file("BuktiSwab"),"BuktiSaturasi{$date}.png");
            $dataTransaksiPinjam['BuktiSaturasi']=$fotoSaturasi;
            $dataTransaksiPinjam['JenisPinjaman']="Oxygen";
        } catch (\Throwable $th) {
            //throw $th;
            Storage::disk("public")->delete([$dataTransaksiPinjam['BuktiSwab'],$dataTransaksiPinjam['BuktiSaturasi']]);
            throw $th;
        }
        return $dataTransaksiPinjam;
    }

    public function saveDataOxy(Request $request){
        $date= Carbon::now();
        $data= $request->all();
        $data['TglInsert']=$date;
        $data['UserInsert']=Auth::guard("admin")->user()->IDUser;
        // return $data;
        try {
            //code...
            Oxygen::create($data);
        } catch (\Throwable $th) {
            //throw $th;
            throw $th;
            // return response(['message'=>'Terjadi Kesalahan dalam menyimpan Data Oxygen'],Response::HTTP_CONFLICT);
        }
        return ['message'=>"Data Oxygen berhasil ditambahkan"];
        // Oxygen::create()
    }

    public function getAllData(){
        return Oxygen::all();
    }
    public function updateData($id,$data){
        try {
            //code...
            Oxygen::findOrFail($id)->update($data);
        } catch (\Throwable $th) {
            //throw $th;
            throw $th;
        }
    }
    public function updateDataOxy($id,Request $request){
        $data=$request->all();
        $date= Carbon::now();
        $data['TglUpdate']=$date;
        $data['UserUpdate']=Auth::guard('admin')->user()->IDUser;
        // return $data;
       try {
           $this->updateData($id,$data);
           //code...
       } catch (\Throwable $th) {
           throw $th;
        //    return response(['message'=>'Terjadi Kesalahan dalam melakukan perubahan Data Oxygen'],Response::HTTP_CONFLICT);
   
       }
        return ['message'=>'Data Oxygen Berhasil diubah'];
    }

    public function updateDataPinjam($id,Request $request){
        $data=$request->all();
        $date= Carbon::now();
        // return $data;
        try {
            //code...
            // return $request->all();
            Pinjam::findOrFail($id)->update($data);
            
            if($request->Status=="Dipinjamkan"){

                $Oxy=Oxygen::where("Status","=","Tersedia")->first();
                $Oxy->update(['Status'=>'Terpakai']);
            }

                // $this->updateData($Oxy->IDOxy,['Status'=>"Terpakai"]);
        } catch (\Throwable $th) {
            throw $th;
            return response(['message'=>'Terjadi Kesalahan dalam melakukan proses peminjaman Oxy'],Response::HTTP_CONFLICT);
        }
        return ['message'=>'Proses Peminjaman Oxy berhasil dilakukan'];
    }
    
    public function deleteDataOxy($id){
        try {
            //code...
            Oxygen::findOrFail($id)->delete();

        } catch (\Throwable $th) {
            //throw $th;
            return response(['message'=>'Terjadi Kesalahan dalam menghapus Data Oxygen'],Response::HTTP_CONFLICT);
      
        }
        return ['message'=>'Data Oxygen Berhasil Dihapus'];
    }
}
