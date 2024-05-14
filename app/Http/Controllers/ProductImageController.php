<?php

namespace App\Http\Controllers;

use domain\Facades\ProductImageFacade\ProductImageFacade;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function get($product_id)
    {
       $data = ProductImageFacade::get($product_id);
       return response()->json($data);
        
    }
}
