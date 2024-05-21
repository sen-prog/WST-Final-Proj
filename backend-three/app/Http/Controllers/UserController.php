<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'string|required',
            'password' => 'string|required'
        ]);

        $credentials = $request->only([
            'username', 'password'
        ]);

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;
            return response()->json([
                'token' => $token,
                'user' => $user,
                ], 200);
        }else{
            return response()->json([
                'token' => 'Token does not exist',
                'user' => 'User does not exist',
                ], 401);
        }
    }

    public function logout(Request $request)
    {
        try{
            $token = $request->input('tokenValue');
            $check = PersonalAccessToken::findToken($token);
            if($check){
                $check->delete();
                return response()->json([
                    'message' => 'Logout Successfully'
                    ], 200);
            }else{
                return response()->json([
                    'message' => 'Token not found'
                    ], 404);
            }
        }catch(\Exception $e){
            return response()->json([
                'message' => $e
                ], 500);
        }
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user,
            'token' => $token
        ], 201);
    }
}
