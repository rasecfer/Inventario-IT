<?php

namespace App\Models;

use App\Enums\DeviceStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['device_model_id', 'lease_id', 'serial_number', 'user_id', 'status', 'comments'])]
class Device extends Model
{
    protected $casts = [
        'status' => DeviceStatus::class
    ];

    public function device_model(): BelongsTo
    {
        return $this->belongsTo(DeviceModel::class);
    }

    public function lease(): BelongsTo
    {
        return $this->belongsTo(Lease::class);
    }

    public function assignment_details(): HasMany
    {
        return $this->hasMany(AssignmentDetail::class);
    }

    public function release_details(): HasMany
    {
        return $this->hasMany(ReleaseDetail::class);
    }

    public function disposal_detail(): HasOne
    {
        return $this->hasOne(DisposalDetail::class);
    }

}
