<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrderDeliveryCharge extends Model
{
    use HasFactory, UsesUuid, SoftDeletesBoolean;

    protected $fillable = [
        'shop_id',
        'id',
        'delivery_profile_id',
        'vehicle',
        'delivery_option',
        'price',
        'distance',
        'created_at',
        'updated_at',
        'is_deleted',
    ];
}
