<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telemedicine extends Model
{
    use HasFactory;
    protected $table="trtelemedicine";

    protected $primaryKey = 'IDTrTele';

    public $timestamps = false;

    protected $fillable = ['IDDokter','IDPasien','IDAdmin','Tanggal','Status','Diagnosa'
    ,'Gejala','PernahBerobat','RiwayatPenyakit','KonsumsiObat','ButuhOksigen','ButuhOxymeter'
];
    
    public $incrementing = true;

    public function pasien(){
        return $this->belongsTo(Pasien::class,"IDPasien");
    }
    public function dokter(){
        return $this->belongsTo(User::class,'IDDokter');
    }
    public function detail(){
        return $this->hasMany(TelemedicineDetail::class,'IDTrTele');
    }
    // public function listObat
    public function listObat(){
        return $this->detail()->with("obat")->get();
    }
    public function obat(){
        return $this->detail()->obat;
    }
}
