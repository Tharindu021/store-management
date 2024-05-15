<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataResource;
use domain\Facades\ProductImageFacade\ProductImageFacade;
use Illuminate\Http\Request;


class ProductImageController extends ParentController
{
    public function store(Request $request, $product_id)
    {
        return ProductImageFacade::store($request->all(), $product_id);
    }

    public function getProducts($product_id)
    {
        $productsdata = ProductImageFacade::getProdoucts($product_id);
        return DataResource::collection($productsdata);
    }

    public function deleteImage($image_id)
    {
        return ProductImageFacade::delete($image_id);
    }

    public function updateStatus($image_id)
    {
        return ProductImageFacade::updatePrimary($image_id);
    }

    public function deactiveStatus($image_id)
    {
        return ProductImageFacade::deactive($image_id);
    }

    public function activeStatus($image_id)
    {
        return ProductImageFacade::active($image_id);
    }
}
