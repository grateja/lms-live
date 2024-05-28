<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JobOrderPayment;
use App\Models\Shop;

class TestController extends Controller
{
    public function test() {
        // $user = User::find("6e0883b1-b605-4fcf-9df6-9343118c3399");
        // return response()->json($user->created_at->format("h:M"));

        // $payment = JobOrderPayment::find("7793d4be-11b1-45e8-b509-570705848cde");

        $result = Shop::all();
        return response()->json($result);
    }
}
