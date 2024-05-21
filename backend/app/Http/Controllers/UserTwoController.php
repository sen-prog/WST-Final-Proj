<?php

// namespace App\Http\Controllers\api\v1;

// use App\Models\UserTwo;
// use App\Http\Requests\v1\StoreUserTwoRequest;
// use App\Http\Requests\v1\UpdateUserTwoRequest;

// use App\Http\Controllers\Controller;

// class UserTwoController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         //something to return to-do??
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(StoreUserTwoRequest $request)
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(UserTwo $userTwo)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(UserTwo $userTwo)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(UpdateUserTwoRequest $request, UserTwo $userTwo)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(UserTwo $userTwo)
//     {
//         //
//     }
// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserTwo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class UserTwoController extends Controller
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
                'token' => 'User does not exist',
                'user' => 'User does not exist',
                ], 404);
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
            'username' => 'required|string|unique:user_twos,username',
            'password' => 'required|string|min:8'
        ]);

        $user = UserTwo::create([
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