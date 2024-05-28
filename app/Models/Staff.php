<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;

class Staff extends Model
{
    use HasFactory, UsesUuid, SoftDeletesBoolean;

    protected $fillable = [
        'shop_id',
        'id',
        'role',
        'name',
        'email',
        'permissions',
        'contact_number',
        'created_at',
        'updated_at',
        'is_deleted',
    ];
}
