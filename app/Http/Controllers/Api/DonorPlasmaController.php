<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DonorPlasma;
use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Http\Response;

class DonorPlasmaController extends Controller
{
    //
    public function savingData(Request $request){
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
        $dataDonorPlasma=DonorPlasma::where("IDPasien","=",$savedDataPasien->IDPasien)
                            ->where("Status","=","Menunggu")
                            ->get();
        if($dataDonorPlasma->count()>0){
            return response(['message'=>"Masih ada Pengajuan Donor Plasma yang sedang berjalan, Tidak dapat Mengajukan Kembali"],Response::HTTP_BAD_REQUEST);

        }
        $dataPengajuanDonor=array_diff_key($data,array_flip($fieldPasien));
        $dataPengajuanDonor['IDPasien']= $savedDataPasien->IDPasien;
        DonorPlasma::create($dataPengajuanDonor);
        return ['message'=>'Pengajuan Form Donor Plasma Berhasil Dilakukan, Mohon Menunggu untuk Diproses'];
    }
}
