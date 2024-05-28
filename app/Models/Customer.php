<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;

class Customer extends Model
{
    use HasFactory, SoftDeletesBoolean;

    protected $fillable = [
        'shop_id',
        'id',
        'crn',
        'name',
        'address',
        'contact_number',
        'email',
        'remarks',
        'created_at',
        'updated_at',
        'is_deleted',
    ];
}
