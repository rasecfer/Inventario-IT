<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['date', 'employee_id', 'first_name', 'last_name', 'payroll_number', 'department_id', 'department_name', 'username', 'comments', 'user_id', 'user_name'])]
class Assignment extends Model
{
    public function assignment_details(): HasMany
    {
        return $this->hasMany(AssignmentDetail::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function releases(): HasMany
    {
        return $this->hasMany(Release::class);
    }
}
