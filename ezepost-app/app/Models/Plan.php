<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'currency',
        'package_size_code',
        'team_size_code',
        'user_group_code',
        'is_active',
        'stripe_price_id_monthly',
        'stripe_price_id_yearly',
        'type',
        'code',
        'price',
        'icon',
        'slug',
        'stripe_plan',
        'description',
        'message',
        'options',
        'price_monthly',
        'price_yearly',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
