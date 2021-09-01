<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use User
use App\Models\User;
use App\Providers\AdminGuard;
use Auth;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware("auth:admin");
    // }
   
    public function login(Request $request){
        $credential=["Username"=>$request->Username,
                    "Password"=> $request->Password
    ];
        $login=Auth::guard('admin')->validate($credential);
        // return dd(Auth::guard("admin"));
        if($login){
            if(Auth::guard('admin')->check()){

                return ['route'=>'/admin'];
            }else
                return ['route'=>'/dokter'];

        }else{
            return response(['message'=>"Username atau Password Salah"],Response::HTTP_NOT_FOUND);
        }
        
    }

    public function logout(Request $request){
        $guard=Auth::guard('admin');
        if($guard instanceof AdminGuard){
            $guard->logout();

            return redirect(env("APP_URL")."/");
        }

    }

    public function saveDataAdmin(Request $request){

        $data= $request->all();
        unset($data['ConfirmPassword']);

        $data['Password']=md5($request->Password);
        $data['Role']='admin';
        try {

            User::create($data);
            //code...
        } catch (QueryException $th) {
            //throw $th;
            $e=$th->errorInfo[1];
            if($e==1062){
                return response(['message'=>"Username telah digunakan, Gunakan Username lain"],Response::HTTP_CONFLICT);
            }
            return response(['message'=>"Terjadi Kesalahan dalam membuat User Baru"],Response::HTTP_BAD_REQUEST);
        }

        return ['message'=>"User Berhasil dibuat"];

    }
    public function deleteDataAdmin($id,Request $request){
        try {
            User::find($id)->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return response(['message'=>"Terjadi Kesalahan dalam menghapus Data User"],Response::HTTP_BAD_REQUEST);
     
        }
        return ['message'=>"User Berhasil dihapus"];
    }
    public function updateDataAdmin($id,Request $request){
        $data=$request->all();
        unset($data['ConfirmPassword']);
        $data['Password']=md5($request->Password);
        $data['Role']='admin';
        try {
            User::find($id)->update($data);
        } catch (\Throwable $th) {
            //throw $th;
            return response(['message'=>"Terjadi Kesalahan dalam mengubah data User"],Response::HTTP_BAD_REQUEST);
     
        }
        return ['message'=>"User Berhasil diubah"];
    }
    public function getDataAdmin(){
        // return "hello";
        $admin= User::where("Role","=","admin")->orderBy("IDUser","desc")->get();
        return $admin;

    }
    public function getDataDokter(){
        $dokter= User::where("Role","=",'doctor')->orderBy("IDUser","desc")->get();
        return $dokter;
    }

    public function saveDataDokter(Request $request){
        $data= $request->all();
        unset($data['ConfirmPassword']);

        $data['Password']=md5($request->Password);
        $data['Role']='doctor';
        try {

            User::create($data);
            //code...
        } catch (QueryException $th) {
            //throw $th;
            $e=$th->errorInfo[1];
            if($e==1062){
                return response(['message'=>"Username telah digunakan, Gunakan Username lain"],Response::HTTP_CONFLICT);
            }
            return response(['message'=>"Terjadi Kesalahan dalam membuat User Baru"],Response::HTTP_BAD_REQUEST);
        }

        return ['message'=>"User Berhasil dibuat"];
    }

    public function updateDataDokter($id,Request $request){
        $data=$request->all();
        unset($data['ConfirmPassword']);
        $data['Password']=md5($request->Password);
        $data['Role']='doctor';
        try {
            User::find($id)->update($data);
        } catch (\Throwable $th) {
            //throw $th;
            return response(['message'=>"Terjadi Kesalahan dalam mengubah data User"],Response::HTTP_BAD_REQUEST);
     
        }
        return ['message'=>"User Berhasil diubah"];
    }

    public function deleteDataDokter($id){
        try {
            User::find($id)->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return response(['message'=>"Terjadi Kesalahan dalam menghapus Data Dokter"],Response::HTTP_BAD_REQUEST);
     
        }
        return ['message'=>"Dokter Berhasil dihapus"];
    }
    //
}
