<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\registerrequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\LoginRequest;

class AuthenticationController extends Controller
{
    //  
    public function register(registerRequest $request){
        $request->validated();

        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ];

        $user = User::create($userData);
        $token = $user->createToken('forumapp')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function token(Request $request){
        $crsfToken = csrf_token();

        return response([
            'csrf_token' => $crsfToken
        ], 200);
    }

    public function login(LoginRequest $request){
        $request->validated();

        $user = User::whereUsername($request->username)->first();

        

        if (!($user && Hash::check($request->password, $user->password))){
            return response([
                'username' => $request->username,
                'password' => $request->password,
                'message' => 'Invalid credentials'
            ], 422);
        }

        $token = $user->createToken('forumapp')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token
        ], 200);
    }
}
