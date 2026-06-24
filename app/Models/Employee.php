<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['first_name', 'last_name', 'payroll_number', 'email', 'department_id', 'username', 'is_active', 'is_external'])]
class Employee extends Model
{
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }

    public function release(): HasMany
    {
        return $this->hasMany(Release::class);
    }
}
