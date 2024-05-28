<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\User;

class ShopsController extends Controller
{
    public function link(Request $request, $ownerId) {
        if($request->validate([
            'name' => 'required',
            'address' => 'required'
        ])) {
            $user = User::with('shops')->find($ownerId);
            $shop = Shop::find($request->id);
            $_shop = $request->only([
                'id',
                'timezone',
                'name',
                'address',
                'email',
                'contact_number',
            ]);

            if($shop == null) {
                $user->shops()->create($_shop);
                // $user->shops()->create([
                //     'id' => $request->id,
                //     'timezone' => $request->timezone,
                //     'name' => $request->name,
                //     'address' => $request->address,
                //     'email' => $request->email,
                //     'contact_number' => $request->contact_number,
                // ]);
            } else {
                // $shop->update([
                //     'timezone' => $request->timezone,
                //     'name' => $request->name,
                //     'address' => $request->address,
                //     'email' => $request->email,
                //     'contact_number' => $request->contact_number,
                // ]);
                $shop->update($_shop);
                if(!$user->shops->contains($shop->id)) {
                    $user->shops()->attach($shop->id);
                }
            }

            $token = $user->createToken('shop-uploader', [
                'sync-update-data'
            ]);

            $res = [
                'name' => $token->accessToken->name,
                'abilities' => json_encode($token->accessToken->abilities),
                'plainTextToken' => $token->plainTextToken,
            ];

            \Log::debug($res);

            return response()->json($res);
        }
    }
}
