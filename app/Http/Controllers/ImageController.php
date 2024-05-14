<?php

namespace App\Http\Controllers;

use App\Models\Images;
use domain\Facades\ImageFacade\ImageFacade;
use Illuminate\Http\Request;

class ImageController extends ParentController
{
    public function deleteImage($id){
        return ImageFacade::delete($id);
    }
}
