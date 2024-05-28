<?php

namespace App\Models\Sanctum;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;


class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use HasFactory, UsesUuid;

    protected $fillable = [
        'name', 'abilities', 'user_id', 'token', 'expires_at'
    ];
}
