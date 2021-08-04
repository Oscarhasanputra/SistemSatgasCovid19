<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    
    use HasFactory;
    protected $table="mspasien";

    protected $primaryKey = 'IDPasien';

    public $timestamps = false;

    protected $fillable = ['IDPasien','NamaPasien','NoHP','Alamat','Usia','JenisKelamin'
    ,'GolonganDarah','TanggalLahir','FotoKTP','Penanggung','NoHPPenanggung','RhesusDarah'
    ,'IDPenanggung','StatusPenanggung'];
    
    public $incrementing = false;
    
   
}
