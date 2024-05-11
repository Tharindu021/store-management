<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    const STATUS = [
        'STOCK' == 1,
        'OUT_OF_STOCK' == 0
    ];

    protected $fillable = [
        'code',
        'status',
        'category_id',
        'brand_id',
        'name',
        'price',
        'description',
    ];

    protected $appends = [
        'brand_name',
        'category_name',
    ];

    /**
     * brands
     *
     * @return void
     */
    public function brands()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    /**
     * categories
     *
     * @return void
     */
    public function categories()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * products
     *
     * @return void
     */
    public function products()
    {
        return $this->get();
    }

    /**
     * getBrandNameAttribute
     *
     * @return void
     */
    public function getBrandNameAttribute()
    {
        return $this->brands?$this->brands->name:'N/A';
    }

    /**
     * getCategoryNameAttribute
     *
     * @return void
     */
    public function getCategoryNameAttribute()
    {
        return $this->categories?$this->categories->name:'N/A';
    }

}
