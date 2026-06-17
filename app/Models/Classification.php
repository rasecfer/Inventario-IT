<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name'])]
class Classification extends Model
{
    public function device_models(): HasMany
    {
        return $this->hasMany(DeviceModel::class);
    }
}
