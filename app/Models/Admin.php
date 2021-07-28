<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table="msadmin";

    protected $primaryKey = 'IDAdmin';

    public $timestamps = false;

    protected $fillable = ['NamaAdmin','Password'];
    public $incrementing = true;
}
