<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    const STATUS = [
        'STOCK' == 1,
        'OUT_OF_STOCK' == 0
    ];

    protected $fillable = [
        'name',
        'code',
        'status',
    ];
}
