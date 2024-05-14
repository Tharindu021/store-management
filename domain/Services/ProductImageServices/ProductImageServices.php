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
    
    public function getProduct($id){
        $product = $this->productImage->where('product_id', $id)->get();
        //dd($imageNames);
        return $product;
    }
    public function getImage($id){
        $productImages = $this->productImage->where('product_id', $id)->get();
        $imageNames = [];
        foreach ($productImages as $productImage) {
            $image = $productImage->images()->first();
            if ($image) {
                $imageNames[] = $image;
            }
        }
        //dd($imageNames);
        return $imageNames;
    }

}