<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;
use App\Traits\UsesUuid;

class JobOrderPayment extends Model
{
    use HasFactory, UsesUuid, SoftDeletesBoolean;

    protected $fillable = [
        'shop_id',
        'id',
        'payment_method',
        'amount_due',
        'cash_received',
        'staff_id',
        'or_number',
        'cashless_provider',
        'cashless_ref_number',
        'cashless_amount',
        'created_at',
        'updated_at',
        'is_deleted',
    ];

    public function jobOrders() {
        return $this->hasMany(JobOrder::class);
    }
}
