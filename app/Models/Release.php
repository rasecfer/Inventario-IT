<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['date', 'assignment_id', 'employee_id', 'first_name', 'last_name', 'payroll_number', 'department_id', 'department_name', 'username', 'comments', 'user_id', 'user_name'])]
class Release extends Model
{
    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }

    public function release(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function release_details(): HasMany
    {
        return $this->hasMany(ReleaseDetail::class);
    }

}
