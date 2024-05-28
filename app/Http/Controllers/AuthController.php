<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $errors = [];

        $user = User::where('email', $request->email)->first();
        if($user == null) {
            $errors = [
                'email' => ['Email does not exists!']
            ];
        } else if(Hash::check($request->password, $user->password)) {
            $token = $user->createToken('login', ['basic']);

            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);
        } else {
            $errors = [
                'password' => ['Wrong password']
            ];
        }

        return response()->json([
            'errors' => $errors
        ], 422);
    }

    public function logout(Request $request) {
        $token = auth('sanctum')->user()->tokens()
            ->where('name', $request->tokenName);
        $token->delete();
    }

    public function check() {
        return auth('sanctum')->user();
    }
}
