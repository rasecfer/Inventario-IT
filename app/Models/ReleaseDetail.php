<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['release_id', 'line', 'device_id', 'assignment_detail_id'])]
class ReleaseDetail extends Model
{
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    public function release(): BelongsTo
    {
        return $this->belongsTo(Release::class);
    }
}
