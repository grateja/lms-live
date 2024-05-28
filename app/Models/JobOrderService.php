<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrderService extends Model
{
    use HasFactory, UsesUuid, SoftDeletesBoolean;

    protected $fillable = [
        'shop_id',
        'id',
        'job_order_id',
        'service_id',
        'service_name',
        'price',
        'quantity',
        'used',
        'svc_machine_type',
        'svc_wash_type',
        'svc_minutes',
        'created_at',
        'updated_at',
        'is_deleted',
    ];
}
