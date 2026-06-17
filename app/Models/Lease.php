<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['description', 'start_date', 'end_date', 'is_active'])]
class Lease extends Model
{

}
