<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Pasien;
use App\Models\Pinjam;

class OxygenController extends Controller
{
    static $fieldPasien=['IDPasien','NamaPasien','NoHP','Alamat','Usia','JenisKelamin'
    ,'GolonganDarah','TanggalLahir','FotoKTP','Penanggung','NoHPPenanggung'
    ,'IDPenanggung','StatusPenanggung'];

    public function save(Request $request){
       
        $date=Carbon::now();
        $data=$request->all();
        $dataPasien=array_intersect_key($data,array_flip(self::$fieldPasien));
        
        //cari data pasien atau buat data pasien baru
        $dataPasien['IDPasien']="PSN{$dataPasien['NoHP']}";
        // print($dataPasien);
        
        if($request->NoHPPenanggung!=null)
            $dataPasien['IDPenanggung']="PNG{$dataPasien['NoHPPenanggung']}";
        $savedDataPasien=[];
        try {
            $savedDataPasien=Pasien::findOrFail($dataPasien['IDPasien']);

        } catch (\Throwable $th) {
            //throw $th;
            $savedDataPasien=Pasien::create($dataPasien);
        }
        //check data transaksi pinjam dari pasien
        
        $dataTransaksiPinjam=array_diff_key($data,array_flip(self::$fieldPasien));
        $dataPinjamPasien=Pinjam::where("IDPasien","=",$savedDataPasien->IDPasien)
                            ->where("Status","=","Menunggu")
                            ->where("JenisPinjaman","=","Oxygen")
                            ->get();
        // jika data pinjam pasien masih dalam proses maka tidak dapat mengajukan peminjaman
        if($dataPinjamPasien->count()>0){
            return response(['message'=>"Masih terdapat Pengajuan lain dalam proses, tidak dapat mengajukan kembali"],Response::HTTP_BAD_REQUEST);
        }

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
}
