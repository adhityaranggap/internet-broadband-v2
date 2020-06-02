<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        $token = JWTAuth::attempt($credentials);

        if($token){
            return response()->json(
                [
                    'message'   =>  'berhasil login',
                    'code'      =>  200,
                    'data'      =>  'Bearer '. $token
                ], 200);
        }else{
            return response()->json(
                [
                    'message'   =>  'Gagal Login',
                    'code'      =>  400,
                    'data'      =>  null
                ], 400);
        }

    }
}
