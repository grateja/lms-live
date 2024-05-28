<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QrCodeController extends Controller
{
    public function initLink() {
        $user = auth('sanctum')->user();

        return DB::transaction(function () use ($user) {

            $authorizer = User::where('email', 'shop@authorizer.com')->first();
            $authorizer->tokens()->where('user_id', $user->id)->delete();

            $expiresAt = Carbon::now()->addMinutes(2);

            $token = $authorizer->createToken('shop-token', [
                'register-shop'
            ], $expiresAt, $user->id);

            return response()->json([
                'userId' => $user->id,
                'token' => $token->plainTextToken,
            ]);
        });
    }
}
