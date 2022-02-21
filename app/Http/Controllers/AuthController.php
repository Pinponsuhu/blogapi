<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $accessToken = $user->createToken('UserToken')->accessToken;
        return response(['user'=>$user,'access_token'=> $accessToken]);
    }

    public function login(Request $request){
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(!auth()->attempt($login)){
            return response()->json([
                'data' =>[
                    'message'=> 'invalid credentials'
                ]
                ]);
        }
        
        $accessToken = auth()->user()->createToken('UserToken')->accessToken;
        return response()->json([
            'data'=>[
                'message' => $accessToken
            ]
        ]);
    }
}
