<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $primaryKey = 'report_id';

    protected $fillable = ['generated_by', 'report_type', 'data'];

    protected $casts = ['data' => 'array'];
}