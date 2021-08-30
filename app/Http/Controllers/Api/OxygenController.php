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

use function PHPUnit\Framework\isEmpty;

class OxygenController extends Controller
{

    public function getDataOxy(Request $request){
        if($status=$request->Status){
            return Pinjam::where("Status","=",$status)->with(["pasien",'oxygen','oxymeter'])->get();
        }
       return Pinjam::with(["pasien",'oxygen','oxymeter'])->get();
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
                            ->whereIn("Status",["Menunggu",'Dipinjamkan'])
                            ->whereIn("JenisPinjaman",["Oxygen","Oxygen & Oxymeter"])
                            ->get();
        // jika data pinjam pasien masih dalam proses maka tidak dapat mengajukan peminjaman
        if($dataPinjamPasien->count()>0){
            return response(['message'=>"Masih terdapat Pengajuan lain dalam proses, tidak dapat mengajukan kembali"],Response::HTTP_BAD_REQUEST);
        }
        $dataTransaksiPinjam=array_diff_key($data,array_flip($fieldPasien));
       
        //

        try {
            //simpan bukti foto swab dan foto saturasi
            if($request->hasFile('BuktiSwab') && $request->hasFile("BuktiSaturasi"))
                $dataTransaksiPinjam=$this->saveDataPinjam($dataTransaksiPinjam,$request);
            //check apakah fotoktp dari pasien sudah ada atau belum
            if(!(file_exists(public_path()."/".$savedDataPasien->FotoKTP))){
                if($request->hasFile("FotoKTP")){

                    $file="FotoKTP{$savedDataPasien->NoHP}-{$date}.png";

                    $request->file("FotoKTP")->move(public_path()."/images/uploaded/",$file);
                    // $file=Storage::disk("public")->putFileAs("images/uploaded",$request->file("FotoKTP"),"FotoKTP{$savedDataPasien->NoHP}-{$date}.png");
                    $savedDataPasien->FotoKTP="images/uploaded/".$file;
                    // mengupdate fotoktp pasien
                    $savedDataPasien->save();
                }
            }
        } catch (\Throwable $th) {
            // throw $th;
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
            $fileName="BuktiSwab{$date}.png";
            $request->file("BuktiSwab")->move(public_path()."/images/uploaded/",$fileName);

            // $file=Storage::disk("public")->putFileAs("images/uploaded",$request->file("BuktiSwab"),"BuktiSwab{$date}.png");
            
            $dataTransaksiPinjam['BuktiSwab']="images/uploaded/".$fileName;

            $fotoSaturasi="BuktiSaturasi{$date}.png";
            $request->file("BuktiSaturasi")->move(public_path().'/images/uploaded/',$fotoSaturasi);
            // $fotoSaturasi=Storage::disk("public")->putFileAs("images/uploaded",$request->file("BuktiSwab"),"BuktiSaturasi{$date}.png");
            $dataTransaksiPinjam['BuktiSaturasi']="images/uploaded/".$fotoSaturasi;
            $dataTransaksiPinjam['JenisPinjaman']="Oxygen";
        } catch (\Throwable $th) {
            // throw $th;
            if(file_exists(public_path()."/".$dataTransaksiPinjam['BuktiSwab']))
                unlink(public_path()."/".$dataTransaksiPinjam['BuktiSwab']);

            if(file_exists(public_path()."/".$dataTransaksiPinjam['BuktiSaturasi']))
                unlink(public_path()."/".$dataTransaksiPinjam['BuktiSaturasi']);

            // Storage::disk("public")->delete([$dataTransaksiPinjam['BuktiSwab'],$dataTransaksiPinjam['BuktiSaturasi']]);
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

    public function getAllData(Request $request){
        if($status=$request->Status){
            return Oxygen::where("Status","=",$status)->get();
        }
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
        unset($data['IDOxygen']);
        unset($data['IDOxymeter']);
        $data['IDAdmin']=Auth::guard('admin')->user()->IDUser;
        try {
            //code...
            // return $request->all();
            $dataPinjam=Pinjam::findOrFail($id);
            $dataPinjam->update($data);
            if($request->Status=="Dipinjamkan"){

                if(!empty($request->IDOxygen))
                    Oxygen::findOrFail($request->IDOxygen)->update(['Status'=>'Terpakai']);
               
            
                if(!empty($request->IDOxymeter))
                    Oxygen::findOrFail($request->IDOxymeter)->update(['Status'=>'Terpakai']);

                $dataPinjam->update(['IDOxygen'=>$request->IDOxygen,'IDOxymeter'=>$request->IDOxymeter,
                                     'TglKirim'=>$date]);
           
            }
            elseif($request->Status=="Selesai"){
                if(!empty($request->IDOxygen))
                    Oxygen::findOrFail($request->IDOxygen)->update(['Status'=>'Tersedia']);
           
        
                if(!empty($request->IDOxymeter))
                    Oxygen::findOrFail($request->IDOxymeter)->update(['Status'=>'Tersedia']);

                $dataPinjam->update(['TglKembali'=>$date]);
            }

                // $this->updateData($Oxy->IDOxy,['Status'=>"Terpakai"]);
        } catch (\Throwable $th) {
            // throw $th;
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
