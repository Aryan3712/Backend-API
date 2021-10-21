<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function login(Request $request){

        $request->validate([ 
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        
        $credentials = request(['email','password']);

        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Invalid email or password'
            ],401);
        }
        $user = $request->user();
        $token = $user->createToken('Access Token');
        $user->access_token = $token->accessToken;

        return response()->json([
            "user"=>$user
        ],200);
    }

    public function signup(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        return response()->json([
            "message" => "User Registered Successfully" 
        ],201);
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            "message"=>"User Logged Out Successfully"
        ],200);
    }

    public function index(){
        echo "authenticated";
    }
}
