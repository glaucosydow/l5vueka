<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use JWTException;
use App\Http\Requests;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $level = ['level' => 'admin'];

        try {
            if (! $token = JWTAuth::attempt($credentials, $level)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));

        // if (Auth::attempt($request->only('email', 'password'))) {
        //     return response()->json(['token' => 'sajdkasdkadj'], 200);
        // }
    }
}
