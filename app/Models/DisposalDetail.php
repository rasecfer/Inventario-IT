<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['disposal_id', 'line', 'device_id', 'status'])]
class DisposalDetail extends Model
{
    public function disposal(): BelongsTo
    {
        return $this->belongsTo(Disposal::class);
    }

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}
