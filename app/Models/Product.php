<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, UsesUuid, SoftDeletesBoolean;

    protected $fillable = [
        'shop_id',
        'id',
        'name',
        'price',
        'current_stock',
        'measure_unit',
        'unit_per_serve',
        'product_type',
        'created_at',
        'updated_at',
        'is_deleted',
    ];
}
