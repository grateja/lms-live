<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        sleep(1);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['keme']);
        } else {
            return response()->json([
                'errors' => [
                    'email' => [
                        'Invalid login credentials'
                    ]
                ]
            ], 401);
        }
    }

    public function logout() {
        Auth::guard('web')->logout();
    }

    public function check(Request $request) {
        return $request->user('sanctum');
    }
}
