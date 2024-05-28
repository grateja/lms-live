<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;
use App\Traits\UsesUuid;

class JobOrder extends Model
{
    use UsesUuid, HasFactory, SoftDeletesBoolean;

    protected $fillable = [
        'shop_id',
        'id',
        'job_order_number',
        'customer_id',
        'staff_id',
        'subtotal',
        'discount_in_peso',
        'discounted_amount',
        'is_deleted',
        'created_at',
        'updated_at',
    ];
}
