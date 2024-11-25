<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){

        $rules = [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed']
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return $validator->errors();
        }

        $data = $validator->validated();

        $user = User::create($data);

        if($user){
            return response()->json([
                "success" => true,
                "status" => 201,
                "message" => "User registered successfully",
                "user" => $user
            ], 201);
        }

        return response()->json([
            "success" => true,
                "status" => 400,
                "message" => "Problem occured while registering user"
        ], 400);
    }

    public function login(Request $request){

        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return $validator->errors();
        }

        $data = $validator->validated();

        if(Auth::attempt($data)){

            $user = Auth::user();

            $token = $user->createToken('todo_app')->plainTextToken;

            return response()->json([
                "success" => true,
                "status" => 201,
                "message" => "User registered successfully",
                "user" => $user,
                "token" => $token
            ], 201);
        }

        return response()->json([
            "success" => false,
            "status" => 400,
            "message" => "Invalid email or password",
        ], 400);

    }

    public function logout(Request $request){

        Auth::user()->tokens()->delete();


        return response()->json([
            "success" => true,
            "status" => 201,
            "message" => "User Logged out.",
        ], 201);
    }
}
