<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;

    const STATUS = [
        'IS_PRIMARY' == 0,
        'ACTIVE' == 1,
        'DEACTIVE' == 2
    ];

    protected $fillable = [
        'status',
        'product_id',
        'image_id',
    ];

    public function images()
    {
        return $this->hasOne(Images::class, 'id', 'image_id');
    }

}
