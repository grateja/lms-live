<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;
use App\Traits\UsesUuid;

class Shop extends Model
{
    use HasFactory, UsesUuid, SoftDeletesBoolean;

    protected $fillable = [
        'id',
        'timezone',
        'name',
        'address',
        'contact_number',
        'email',
        'created_at',
        'updated_at',
        'is_deleted',
    ];

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
