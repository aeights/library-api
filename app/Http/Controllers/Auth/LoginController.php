<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $loginRequest){
        try {
            $validatedData = $loginRequest->validated();

            $auth = Auth::attempt($validatedData);

            $user = User::where('email',$validatedData['email'])->first();

            if ($user and $auth) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login Successfully!',
                    'token' => $user->createToken("auth_token")->plainTextToken,
                    'data' => $user
                ],200);
            }

            return response()->json([
                'status' => true,
                'message' => 'Invalid Email or Password!',
                'data' => $validatedData
            ],401);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'errors' => $th
            ],500);
        }
    }
}
