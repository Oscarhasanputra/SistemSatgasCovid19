<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oxygen extends Model
{
    use HasFactory;
    protected $table="msoxy";

    protected $primaryKey = 'IDOxy';

    public $timestamps = false;

    protected $fillable = ['NamaOxy','Jenis','TglInsert','UserInsert','TglUpdate','UserUpdate','Status'];
    
    public $incrementing = true;
}
