<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

#[Fillable(['name'])]
class Classification extends Model
{
    public function device_models(): HasMany
    {
        return $this->hasMany(DeviceModel::class);
    }

    public function devices(): HasManyThrough
    {
        return $this->hasManyThrough(Device::class, DeviceModel::class);
    }
}
