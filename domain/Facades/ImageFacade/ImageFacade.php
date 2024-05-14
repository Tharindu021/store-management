<?php

namespace domain\Facades\ImageFacade;

use domain\Services\ImageServices\ImageServices;
use Illuminate\Support\Facades\Facade;

class ImageFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return ImageServices::class;
    }
}