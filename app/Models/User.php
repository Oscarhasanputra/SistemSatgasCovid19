<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table="msuser";

    protected $primaryKey = 'IDUser';

    public $timestamps = false;

    protected $fillable = ['Username','Nama','Password','NoHP','Role'];

    public $incrementing = true;

    public function test(){
        return true;
    }
    public function getAuthPassword()
    {
        return $this->Password;
    }
    public function getAuthIdentifier()
    {
        return $this->Username;
    }
}
