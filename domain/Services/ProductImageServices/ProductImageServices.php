<?php

namespace domain\Services\ProductImageServices;

use App\Http\Resources\DataResource;
use App\Models\ProductImages;
use domain\Facades\ImageFacade\ImageFacade;
use Illuminate\Support\Facades\Storage;


class ProductImageServices
{
    protected $product_image;

    public function __construct()
    {
        $this->product_image = new ProductImages();
    }

    public function store($data, $product_id)
    {
        if (isset($data['images'])) {

            $storeimage = $data['images'];
            foreach ($storeimage as $image) {

                $imageid = ImageFacade::store($image);
                $this->product_image->create([
                    'product_id' => $product_id,
                    'image_id' => $imageid,
                ]);

            };
            
        }
    }

    public function getProdoucts($id)
    {
        $product_image = $this->product_image->where('product_id', $id)->get();
        $product_image->load('images');
        return  $product_image;
    }

    public function delete($id)
    {
        return ProductImages::where('id', $id)->delete();
    }

    public function updatePrimary($id)
    {
        $this->product_image->where('status', 0)->update(['status' => 1]);
        return $this->product_image->where('id', $id)->update(['status' => 0]);
    }

    public function deactive($id)
    {
        return $this->product_image->where('id', $id)->update(['status' => 2]);
    }

    public function active($id)
    {
        return $this->product_image->where('id', $id)->update(['status' => 1]);
    }
}
