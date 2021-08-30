<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Pasien;
use App\Models\Pinjam;


class OxymeterController extends Controller
{
    //

    public function save(Request $request){
        // var_dump($request);
        $date=Carbon::now();
        $data=$request->all();
        $model= new Pasien();
        $fieldPasien= $model->getFillable();
        // return $request->file("FotoKTP");
        // return $request->file("FotoKTP");
   
        
        $dataPasien=array_intersect_key($data,array_flip($fieldPasien));
        // return $dataPasien;

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
                            ->whereIn("JenisPinjaman",["Oxymeter","Oxygen & Oxymeter"])
                            ->get();
        // jika data pinjam pasien masih dalam proses maka tidak dapat mengajukan peminjaman
        if($dataPinjamPasien->count()>0){
            return response(['message'=>"Masih terdapat Pengajuan lain dalam proses, tidak dapat mengajukan kembali"],Response::HTTP_BAD_REQUEST);
        }
        $dataTransaksiPinjam=array_diff_key($data,array_flip($fieldPasien));
        
        //

        try {
            //simpan bukti foto swab 
            if($request->hasFile("BuktiSwab"))
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
            // terjadi ketika file foto yang diinginkan tidak diupload oleh user
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
            $file="BuktiSwab{$date}.png";
            $request->file("BuktiSwab")->move(public_path()."/images/uploaded/",$file);
            // $file=Storage::disk("public")->putFileAs("images/uploaded",$request->file("BuktiSwab"),"BuktiSwab{$date}.png");
            $dataTransaksiPinjam['BuktiSwab']="images/uploaded/".$file;
            $dataTransaksiPinjam['JenisPinjaman']="Oxymeter";
        } catch (\Throwable $th) {
            //throw $th;
            if(file_exists(public_path()."/".$dataTransaksiPinjam['BuktiSwab']))
                unlink(public_path()."/".$dataTransaksiPinjam['BuktiSwab']);

            // Storage::disk("public")->delete($dataTransaksiPinjam['BuktiSwab']);
            throw $th;
        }
        return $dataTransaksiPinjam;
    }
}
