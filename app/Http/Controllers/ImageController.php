<?php

namespace App\Http\Controllers;

use App\Models\Images;
use domain\Facades\ImageFacade\ImageFacade;
use Illuminate\Http\Request;

class ImageController extends ParentController
{
    public function store(Request $request , $product_id)
    {
       
        $image = ImageFacade::store($request->all(),$product_id);
        
    }

}
