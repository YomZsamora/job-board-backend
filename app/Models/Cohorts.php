<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cohorts extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'cohort',
        'start_date',
        'end_date'
    ];
}
