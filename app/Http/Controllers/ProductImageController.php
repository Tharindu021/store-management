<?php

namespace App\Http\Controllers;

use domain\Facades\ProductImageFacade\ProductImageFacade;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function getProduct($product_id)
    {
       $data = ProductImageFacade::getProduct($product_id);
       return response()->json($data);
        
    }
    public function getImage($product_id)
    {
       $data = ProductImageFacade::getImage($product_id);
       return response()->json($data);
        
    }
}
