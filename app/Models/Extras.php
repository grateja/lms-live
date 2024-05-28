<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extras extends Model
{
    use HasFactory, UsesUuid, SoftDeletesBoolean;

    protected $fillable = [
        'shop_id',
        'id',
        'name',
        'price',
        'category',
        'created_at',
        'updated_at',
        'is_deleted',
    ];

}
