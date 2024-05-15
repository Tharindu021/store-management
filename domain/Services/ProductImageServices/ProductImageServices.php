<?php

namespace domain\Services\ProductImageServices;

use App\Http\Resources\DataResource;
use App\Models\ProductImages;
use domain\Facades\ImageFacade\ImageFacade;
use Illuminate\Support\Facades\Storage;


class ProductImageServices
{
    protected $productimage;

    public function __construct()
    {
        $this->productimage = new ProductImages();
    }

    public function store($data, $product_id)
    {
        if (isset($data['images'])) {

            $storeimage = $data['images'];
            foreach ($storeimage as $image) {

                $imageid = ImageFacade::store($image);

                $this->productimage->create([
                    'product_id' => $product_id,
                    'image_id' => $imageid,
                ]);
            };
        }
    }

    public function getProdoucts($id)
    {
        $productimages = $this->productimage->where('product_id', $id)->get();
        $productimages->load('images');
        return  $productimages;
    }

    public function delete($id)
    {
        ProductImages::where('id', $id)->delete();
    }

    public function update($id)
    {
        $this->productimage->where('status', 0)->update(['status' => 1]);
        return $this->productimage->where('id', $id)->update(['status' => 0]);
    }

    public function deactive($id)
    {

        return $this->productimage->where('id', $id)->update(['status' => 2]);
    }

    public function active($id)
    {
        return $this->productimage->where('id', $id)->update(['status' => 1]);
    }
}
