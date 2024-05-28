<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrderProduct extends Model
{
    use HasFactory, UsesUuid, SoftDeletesBoolean;

    protected $fillable = [
        'shop_id',
        'id',
        'job_order_id',
        'product_id',
        'product_type',
        'product_name',
        'price',
        'measure_unit',
        'unit_per_serve',
        'quantity',
        'created_at',
        'updated_at',
        'is_deleted',
    ];
}
