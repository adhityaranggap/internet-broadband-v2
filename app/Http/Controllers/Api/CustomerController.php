<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class CustomerController extends Controller
{
    public function fetchAllCustomers(){
        // return -data All Array Role Customer
        $users = User::all();

        return response()->json([
            'message'   =>  $users->count(). ' Data user ditemukan',
            'code'      =>  200,
            'data'      =>  $users
        ], 200);
    }
    public function create (Request $request)
    {

        $data = User::create($request->all());

        return response()->json([
            'message'   =>  $request->username. ' Data berhasil masuk',
            'code'      =>  200,
            'data'      =>  $data
        ], 200);   
    }
    public function update (Request $request, $username)
    {        

        $data = User::where('username', $username)->first();
        
        if($data)
        {
            User::where('username', $username)->update($request->except('username'));
            return response()->json([
                'message'   =>  $request->username. ' Data berhasil update',
                'code'      =>  200,
                'data'      => $data
            ], 200); 
        }else{
            return response()->json([
                'message'   =>  $request->username. ' Data tidak ditemukan',
                'code'      =>  404
            ], 404); 
        }

    }
    public function delete ($username)
    {
        $data = User::where('username', $username)->first();
        if($data){
            $data->delete();
            return response()->json([
                'message'   =>  $username. ' Data berhasil dihapus',
                'code'      =>  200,
                'data'      => $data       
            ], 200); 
        }else{
            return response()->json([
                'message'   =>  $username. ' Data tidak ditemukan',
                'code'      =>  404
            ], 404); 
        }
    }
}
