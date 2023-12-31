<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function register(RegisterRequest $registerRequest)
    {
        try {
            $validatedData = $registerRequest->validated();

            $user = User::create([
                'name' => $registerRequest->name,
                'email' => $registerRequest->email,
                'password' => Hash::make($registerRequest->password)
            ]);
            
            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully!',
                'token' => $user->createToken("auth_token")->plainTextToken,
                'data' => $validatedData,
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'errors' => $th
            ],500);

        }
    }
}
