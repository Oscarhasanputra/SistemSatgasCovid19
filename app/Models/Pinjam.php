<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    use HasFactory;
    protected $table="trpinjam";

    protected $primaryKey = 'IDTrPinjam';

    public $timestamps = false;

    protected $fillable = ['IDPasien','IDOxy','TglPinjam','TglKembali','IDAdmin'
    ,'Sumber','Gejala','Saturasi','TanggalSwab','BuktiSwab','KonsumsiObat','PernahBerobat'
    ,'KetersediaanTabung','BuktiSaturasi','JenisPinjaman','AsalPinjam','created_at'];
    
    public $incrementing = false;

    public function pasien(){
        return $this->belongsTo(Pasien::class,"IDPasien");
    }
}
