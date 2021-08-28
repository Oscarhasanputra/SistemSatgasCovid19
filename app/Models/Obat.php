<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;
    protected $table="msobat";

    protected $primaryKey = 'IDObat';

    public $timestamps = false;

    protected $fillable = ['NamaObat','JenisObat','Jumlah','TglInsert','UserInsert','TglUpdate','UserUpdate'];
    
    public $incrementing = true;
}
