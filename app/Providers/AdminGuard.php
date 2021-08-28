<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminGuard implements Guard
{
    protected $request;
    protected $provider;
    protected $user;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function __construct(GuardProvider $provider, Request $request)
    {
        $this->request=$request;
        $this->provider=$provider;
        $this->user=null;
    }
    public function setUser(Authenticatable $user)
    {
        $this->user=$user;
    }
    public function validate(array $credentials = [])
    {

        if(empty($credentials['Username']) || empty($credentials['Password']))
            return false;

        $user=$this->provider->retrieveByCredentials($credentials);
        if(! is_null($user)){
            $this->request->session()->put("IDUser",$user->IDUser);
            $this->request->session()->save();
            $this->setUser($user);
            // return dd($this->user->Nama);
            return true;
        }else{
            return false;
        }

    }
    public function id()
    {
        if(! is_null($this->user()))
            return $this->user()->getAuthIdentifier();
    }
    public function user()
    {
        if(! is_null($this->user))
            return $this->user;
        $id= $this->request->session()->get("IDUser",null);
        $user= $this->provider->retrieveById($id);
        $this->setUser($user);
        return $this->user;
    }

    public function check(){
        return $this->request->session()->has("IDUser") &&! is_null($this->user()) && $this->user()->Role=="admin";
    }

   public function guest()
   {
        return ! $this->check();
   }

   public function logout(){
       $this->user=null;
       $this->request->session()->flush();
       
   }

   public function test(){
        return "hello";
   }
}
