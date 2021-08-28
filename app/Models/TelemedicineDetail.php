<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelemedicineDetail extends Model
{
    use HasFactory;
    protected $table="trdetailtelemedicine";

    protected $primaryKey = 'IDTrTeleDetail';

    public $timestamps = false;

    protected $fillable = ['IDTrTele','IDObat','Qty'];
    
    public $incrementing = true;

    public function obat(){
        return $this->belongsTo(Obat::class,"IDObat");
    }
}
