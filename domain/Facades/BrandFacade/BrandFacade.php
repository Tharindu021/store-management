<?php

namespace domain\Facades\BrandFacade;

use domain\Services\BrandServices\BrandServices;
use Illuminate\Support\Facades\Facade;

class BrandFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return BrandServices::class;
    }
}