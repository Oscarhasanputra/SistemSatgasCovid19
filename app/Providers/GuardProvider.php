<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
class GuardProvider implements UserProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    private $model;
    public function __construct(User $model)
    {
        $this->model=$model;
    }
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return ($credentials['Username']==$user->getAuthIdentifier() && 
        $credentials['Password']==$user->getAuthPassword());
    }
    public function retrieveByCredentials(array $credentials)
    {
        if(empty($credentials))
            return null;
        
        $user= $this->model->where("Username","=",$credentials['Username'])
                ->where("Password","=",md5($credentials['Password']))
                ->get();
                
        return $user->count()>0?$user[0]:null;
        ;
    }
    public function updateRememberToken(Authenticatable $user, $token)
    {
        
    }
    public function retrieveByToken($identifier, $token)
    {
        
    }
    public function retrieveById($identifier)
    {
       return $this->model->find($identifier);
    }
}
