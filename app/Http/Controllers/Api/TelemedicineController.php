<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Pinjam;
use App\Models\Telemedicine;
use App\Models\TelemedicineDetail;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Response;

class TelemedicineController extends Controller
{
   public function getKonsultasiDokter(Request $request){
    $IDDokter=Auth::guard('doctor')->user()->IDUser;
    $tele=Telemedicine::where("IDDokter","=",$IDDokter)->with(["pasien",'detail','detail.obat','pasien.pinjam'=>function($q){
        $q->where("Status","=","Menunggu")->orderBy("IDTrPinjam","desc");
    }])->get();
    return $tele;
   }
   
    public function getAllKonsultasi(Request $request){
        if($status=$request->Status){
            return Telemedicine::where("Status","=",$status)->with("pasien")->get();
        }
        $tele=Telemedicine::with(["pasien",'detail','detail.obat'])->get();
        return $tele;
    }

    public function savingData(Request $request){
        $data=$request->all();

        $model= new Pasien();
        $fieldPasien= $model->getFillable();
        $dataPasien=array_intersect_key($data,array_flip($fieldPasien));
        
        //cari data pasien atau buat data pasien baru
        $dataPasien['IDPasien']="PSN{$dataPasien['NoHP']}";

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
        $dataKonsultasiPasien=Telemedicine::where("IDPasien","=",$savedDataPasien->IDPasien)
                            ->where("Status","=","Menunggu")
                            ->get();
        // jika data Konsultasi pasien masih dalam proses maka tidak dapat mengajukan Konsultasi
        if($dataKonsultasiPasien->count()>0){
            return response(['message'=>"Konsultasi Sedang dalam proses, tidak dapat mengajukan kembali"],Response::HTTP_BAD_REQUEST);
        }

        $dataKonsultasi=array_diff_key($data,array_flip($fieldPasien));

        $savedDataPasien->Agama=$request->Agama;
        $savedDataPasien->save();
        $dataKonsultasi['IDPasien']=$savedDataPasien->IDPasien;
        Telemedicine::create($dataKonsultasi);

        return ['message'=>"Pengajuan Konsultasi berhasil dilakukan, Silahkan Menunggu Konfirmasi"];
    }

    public function updateKonsultasi($id,Request $request){
        $data= $request->all();
        // return $data;
        try {
            Telemedicine::findOrFail($id)->update($data);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return response(['message'=>'Terjadi Kesalahan Dalam Memproses Pengajuan Konsultasi'],Response::HTTP_CONFLICT);

        }
        return ['message'=>'Pengajuan Konsultasi berhasil diproses'];
    }

    public function dokterUpdateKonsultasi($id,Request $request){
        $data= $request->all();

        // return $data;
        $updateData=array_intersect_key($data,array_flip(["Diagnosa","ButuhOksigen","ButuhOxymeter"]));
        $arrayObat=$request->listObat;

        try {
            Telemedicine::findOrFail($id)->update($updateData);
            $dataObat=[];
            foreach ($arrayObat as $index=>$obat){
                $savedObat=Obat::find($obat['IDObat']);
                $savedObat->update(['Jumlah'=>($savedObat->Jumlah-$obat['Qty'])]);

                $detail=['IDTrTele'=>$id,
                    'IDObat'=> $obat['IDObat'],
                    'Qty'=>$obat['Qty']
            ];
    
                array_push($dataObat,$detail);
            }
            TelemedicineDetail::insert($dataObat);
            if(!$request->has("StatusPeminjaman")){

                if($request->ButuhOksigen=="Ya" || $request->ButuhOxymeter=="Ya"){

                    Pinjam::create([
                        'IDPasien'=>$request->IDPasien,
                        'Sumber'=>"Rujukan Dokter",
                        'Saturasi'=>"-",
                        'Gejala'=>"-",
                        'KetersediaanTabung'=>"Belum",
                        'JenisPinjaman'=>$request->ButuhOksigen=="Ya" && $request->ButuhOxymeter=="Ya"? "Oxygen & Oxymeter" : ($request->ButuhOxymeter=="Ya"? "Oxymeter":"Oxygen"),
                        'AsalPinjam'=>"Anjuran Dokter",
                        'created_at'=>Carbon::now()
                    ]);

                }
            }
            //code...
        } catch (\Throwable $th) {
            // throw $th;
            return response(['message'=>'Terjadi Kesalahan Dalam Memproses Pengajuan Konsultasi'],Response::HTTP_CONFLICT);

        }
        return ['message'=>'Pengajuan Konsultasi berhasil diproses'];
    }

}
