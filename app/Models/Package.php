<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory, UsesUuid, SoftDeletesBoolean;

    protected $fillable = [
        'shop_id',
        'id',
        'package_name',
        'desciption',
        'total_price',
        'created_at',
        'updated_at',
        'is_deleted',
    ];
}
