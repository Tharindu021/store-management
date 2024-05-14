<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataResource;
use App\Models\ProductImages;
use domain\Facades\ImageFacade\ImageFacade;
use domain\Facades\ProductImageFacade\ProductImageFacade;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductImageController extends Controller
{
    protected $productImage;

    public function __construct()
    {
        $this->productImage = new ProductImages();
    }
    public function store(Request $request , $product_id)
    {
       
        $image = ImageFacade::store($request->all());
        //dd($image);
        return ProductImageFacade::store($image,$product_id);
        
    }

    public function getProduct()
    {
        $code = request('search_product_id');
        $productDetails = QueryBuilder::for(ProductImages::class)
        ->allowedFilters(AllowedFilter::exact('name', $code))
        ->get();
            return DataResource::collection($productDetails);
        
    }

    public function getImage($product_id)
    {
       return ProductImageFacade::getImage($product_id);
       //return response()->json($data);
    }
}
