<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
 
    public function __invoke(Request $request)
    {
        $validator = validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('username', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'messege' => 'salah password bre'
            ], 401);
            
        }

        return response()->json([
            'success' => true,
            'datauser' => auth()->user(),
            'token' => $token,
        ]);
    }
}
