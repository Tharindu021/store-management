<?php

namespace domain\Facades\ProductImageFacade;

use domain\Services\ProductImageServices\ProductImageServices;
use Illuminate\Support\Facades\Facade;

class ProductImageFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return ProductImageServices::class;
    }
}