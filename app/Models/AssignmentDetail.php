<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['assignment_id', 'line', 'device_id', 'release_details_id'])]
class AssignmentDetail extends Model
{
    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

}
