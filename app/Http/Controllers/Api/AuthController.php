<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated=$request->validated();

        $user=User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password'])
        ]);

        $token=$user->createToken('auth_token')->plainTextToken;
        
        return new RegisterResource($user,$token);
    }

    public function login(LoginRequest $request)
    {
        $validated=$request->validated();
        $user=User::where('email',$validated['email'])->first();
        if (!$user || !Hash::check($validated['password'],$user->password))
            {
                return response()->json([
                    'message'=>'Invalid credentials'
                ],401);
            }
        $token=$user->createToken('auth_token')->plainTextToken;

        return new LoginResource($user,$token);
    }
}
