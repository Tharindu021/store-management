<?php

namespace domain\Services\ImageServices;
use App\Models\Images;
use App\Models\ProductImages;
use Illuminate\Support\Facades\Storage;


class ImageServices
{
    protected $image;
    protected $productImage;

    public function __construct()
    {
        $this->image = new Images();
        $this->productImage = new ProductImages();
    }
    public function store($data,$productId)
    {
        $imageIdArray = [];
        $storeImage = $data['images'];
        foreach ($storeImage as $file) {
            $name = rand(1,1000) . '_' . $file->getClientoriginalName();
            $path = $file->storeAs('uploads',$name);
            $image = $this->image->create([
                     'name' => $name
            ]);
            $imageId = $image->id;
            $imageIdArray[] =$imageId;

        } 
        foreach ($imageIdArray as $data) {
            $this->productImage->create([
                'product_id' => $productId,
                'image_id' => $data,
            ]);
        } 
        }

}