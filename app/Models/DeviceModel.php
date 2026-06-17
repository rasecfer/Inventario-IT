<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['brand_id', 'classification_id', 'description'])]
class DeviceModel extends Model
{
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function classification(): BelongsTo
    {
        return $this->belongsTo(Classification::class);
    }

    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }
}
