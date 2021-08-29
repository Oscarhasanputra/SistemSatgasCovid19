<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorPlasma extends Model
{
    use HasFactory;
    protected $table="trdonorplasma";

    protected $primaryKey = 'IDDonor';

    public $timestamps = false;

    protected $fillable = ['IDPasien','IDAdmin','TanggalPositif','TanggalSembuh','Status'];
    
    public $incrementing = true;

    public function pasien(){
        return $this->belongsTo(Pasien::class,"IDPasien");
    }
}
