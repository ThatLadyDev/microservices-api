<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessedJob extends Model
{
    use HasFactory;

    protected $fillable = [
        "uuid",
        "type",
        "job_id",
        "metadata"
    ];

    protected $casts = [
        "metadata" => "array"
    ];
}
