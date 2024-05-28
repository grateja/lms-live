<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageService extends Model
{
    use HasFactory, UsesUuid, SoftDeletesBoolean;

    protected $fillable = [
        'shop_id',
        'id',
        'package_id',
        'service_id',
        'quantity',
        'created_at',
        'updated_at',
        'is_deleted',
    ];
}
