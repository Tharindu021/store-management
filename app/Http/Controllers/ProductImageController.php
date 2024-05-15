<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataResource;
use domain\Facades\ProductImageFacade\ProductImageFacade;
use Illuminate\Http\Request;


class ProductImageController extends Controller
{
    public function store(Request $request, $product_id)
    {
        $data= $request->all();
        return ProductImageFacade::store($data, $product_id);
    }

    public function getProducts($product_id)
    {
        $productsdata = ProductImageFacade::getProdoucts($product_id);
        return DataResource::collection($productsdata);
    }

    public function getImages($product_id)
    {
        $productimage = ProductImageFacade::getImages($product_id);
        return DataResource::collection($productimage);
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
