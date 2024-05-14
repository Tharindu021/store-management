<?php

namespace domain\Services\ProductImageServices;

use App\Http\Resources\DataResource;
use App\Models\ProductImages;
use Illuminate\Support\Facades\Storage;


class ProductImageServices
{
    protected $productImage;

    public function __construct()
    {
        $this->productImage = new ProductImages();
    }
    
    public function store($image_ids,$product_id){

        foreach ($image_ids as $data) {
            $this->productImage->create([
                'product_id' => $product_id,
                'image_id' => $data,
            ]);
        } 
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
        return  DataResource::collection($imageNames);
    }

}