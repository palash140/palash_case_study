<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller{


    public function login(AuthUserRequest  $request){
        $user = User::where('email', $request->email)->first(); 
        $token=$user->createToken('API_TOKEN')->plainTextToken;
        
        return  response([
            'message'=>'User logged in successfully',
            'token'=>$token
        ]);
    }
}
