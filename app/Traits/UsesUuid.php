<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UsesUuid {
    protected static function bootUsesUuid() {
        static::creating(function($model) {
            $model->primaryKey = 'id';
            $model->keyType = 'string'; // In Laravel 6.0+ make sure to also set $keyType
            $model->incrementing = false;

            if(!$model->getKey()) {
                $model->{$model->getKeyName()} = Str::uuid();
            }
        });
    }

    public function getIncrementing() {
        return false;
    }

    public function getKeyType() {
        return 'string';
    }
}
