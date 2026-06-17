<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['description', 'start_date', 'end_date', 'is_active'])]
class Lease extends Model
{
    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

}
