<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    const DEFAULT_GRADE_ID = 1;

    const ELEMENTARY_MAX = 6;
    const MIDDLE_MAX     = 9;
    const HIGH_MAX       = 12;
}
