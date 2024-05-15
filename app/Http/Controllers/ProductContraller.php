<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Filters\FuzzyFilter;
use App\Http\Resources\DataResource;
use App\Models\Products;
use domain\Facades\ProductFacade\ProductFacade;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class ProductContraller extends ParentController
{
    public function index()
    {
        return Inertia::render('Products/all');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return ProductFacade::store($data);
    }

    public function all()
    {
        $query = Products::orderBy('id', 'desc');
        if (request('search_product_code')) {
            $code = request('search_product_code');
            $query->where('code', 'like', "%{$code}%");
        }
        if (request('search_product_name')) {
            $name = request('search_product_name');
            $query->where('name', 'like', "%{$name}%");
        }
        if (request('search_product_brand')) {
            $brand_id = request('search_product_brand');
            $query->where('brand_id', $brand_id);
        }
        if (request('search_product_category')) {
            $category_id = request('search_product_category');
            $query->where('category_id', $category_id);
        }
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['code'])
            ->allowedFilters(
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->whereHas('categories', function (Builder $query) use ($value) {
                        $query->where('name', 'like', "%{$value}%");
                    });
                    $query->orWhereHas('brands', function (Builder $query) use ($value) {
                        $query->where('name', 'like', "%{$value}%");
                    });
                    $query->orWhere('code', 'like', "%{$value}%");
                    $query->orWhere('name', 'like', "%{$value}%");
                })
            )
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return DataResource::collection($payload);
    }

    public function delete($id)
    {
        return ProductFacade::delete($id);
    }

    public function get($id)
    {
        $data = ProductFacade::get($id);
        return response()->json($data);
    }

    public function edit($id)
    {
        $response['product'] = ProductFacade::get($id);
        Log::info('Response:', $response);
        return Inertia::render('Products/edit', $response);
    }

    public function update(Request $request,$id)
    {
        return ProductFacade::update($request->all(),$id);
    }
}
