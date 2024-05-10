<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    const STATUS = [
        'STOCK' == 1,
        'OUT_OF_STOCK' == 0
    ];

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];
}
