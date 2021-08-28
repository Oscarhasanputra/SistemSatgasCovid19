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

    protected $fillable = ['IDPasien','NamaPasien','NoHP','Alamat',
    'Usia','JenisKelamin','Agama','Profesi','Berat'
    ,'GolonganDarah','TanggalLahir','FotoKTP',
    'Penanggung','NoHPPenanggung','RhesusDarah'
    ,'IDPenanggung','StatusPenanggung'];
    
    public $incrementing = false;
    
    public function konsultasi(){
        return $this->hasMany(Telemedicine::class,"IDPasien");
    }

    public function pinjam(){
        return $this->hasMany(Pinjam::class,"IDPasien");
    }
}
