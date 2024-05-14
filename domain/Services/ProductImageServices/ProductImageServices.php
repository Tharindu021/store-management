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

    public function store($image_ids, $product_id)
    {

        foreach ($image_ids as $data) {
            $this->productImage->create([
                'product_id' => $product_id,
                'image_id' => $data,
            ]);
        }
    }

    public function getImage($id)
    {
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

    public function delete($id)
    {
        ProductImages::where('image_id', $id)->delete();
    }

    public function update($id)
    {
        $this->productImage->where('status', 0)->update(['status' => 1]);
        return $this->productImage->where('image_id', $id)->update(['status' => 0]);
    }

    public function deactive($id)
    {
        return $this->productImage->where('image_id', $id)->update(['status' => 2]);
    }

    public function active($id)
    {
        return $this->productImage->where('image_id', $id)->update(['status' => 1]);
    }
}
