<?php

namespace domain\Facades\CategoryFacade;

use domain\Services\CategoryServices\CategoryServices;
use Illuminate\Support\Facades\Facade;

class CategoryFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return CategoryServices::class;
    }
}