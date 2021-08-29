<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table="msberita";

    protected $primaryKey = 'IDBerita';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = ['Judul','Content','Status','created_at','IDAdmin'];
    
    public function admin(){
        return $this->belongsTo(User::class,"IDAdmin");
    }
}
