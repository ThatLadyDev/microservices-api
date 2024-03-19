<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessedTask extends Model
{
    use HasFactory;

    protected $fillable = [
        "uuid",
        "title",
        "text",
        "action",
        "is_queued",
    ];

    protected $casts = [
        "is_queued" => "boolean"
    ];
}
