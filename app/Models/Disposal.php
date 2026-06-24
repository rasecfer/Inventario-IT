<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['date', 'comments', 'user_id', 'user_name'])]
class Disposal extends Model
{
    public function disposal_details(): HasMany
    {
        return $this->hasMany(DisposalDetail::class);
    }
}
