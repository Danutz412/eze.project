<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'months_count',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
