<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataResource;
use App\Models\ProductImages;
use domain\Facades\ImageFacade\ImageFacade;
use domain\Facades\ProductImageFacade\ProductImageFacade;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductImageController extends Controller
{
    protected $productImage;

    public function __construct()
    {
        $this->productImage = new ProductImages();
    }

    public function store(Request $request, $product_id)
    {
        $data = ($request->all());
        
        if (isset($data['images'])) {

            $imageIdArray = [];
            $storeImage = $data['images'];
            foreach ($storeImage as $image) {
                $imageId = ImageFacade::store($image);
                $imageIdArray[] = $imageId;
            };
        return ProductImageFacade::store($imageIdArray, $product_id);

        }
    }

    public function getProducts($product_id)
    {
        $productsData = ProductImageFacade::getProdoucts($product_id);
        return DataResource::collection($productsData);
    }

    public function getImages($product_id)
    {
        $productImage = ProductImageFacade::getImages($product_id);
        return DataResource::collection($productImage);
    }

    public function deleteImage($image_id)
    {
        ProductImageFacade::delete($image_id);
    }

    public function updateStatus($image_id)
    {
        ProductImageFacade::update($image_id);
    }

    public function deactiveStatus($image_id)
    {
        ProductImageFacade::deactive($image_id);
    }

    public function activeStatus($image_id)
    {
        ProductImageFacade::active($image_id);
    }
}
