<?php

namespace domain\Services\ProductImageServices;

use App\Models\ProductImages;
use Illuminate\Support\Facades\Storage;


class ProductImageServices
{
    protected $productImage;

    public function __construct()
    {
        $this->productImage = new ProductImages();
    }
    
    public function get($id){
        $productImages = $this->productImage->where('product_id', $id)->get();
        return $productImages;
    }

}