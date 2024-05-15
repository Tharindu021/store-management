<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use domain\Facades\BrandFacade\BrandFacade;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Filters\FuzzyFilter;
use App\Http\Resources\DataResource;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class BrandsController extends ParentController
{

    public function index()
    {
        return Inertia::render('Settings/Brands/all');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return BrandFacade::store($data);
    }

    public function all()
    {
        $query = Brand::orderBy('id');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('name', 'slug')))
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return DataResource::collection($payload);
    }

    public function delete($id)
    {
        return BrandFacade::delete($id);
    }

    public function get($id)
    {
        $data = BrandFacade::get($id);
        return response()->json($data);
    }

    public function update(Request $request, int $id)
    {
        return BrandFacade::update($request->all(), $id);
    }

    public function deleteSelectedItems(Request $request)
    {
        $ids = request('ids');
        return BrandFacade::deleteSelected($ids);
    }

    public function inactiveSelectedItems(Request $request)
    {
        $ids = request('ids');
        return BrandFacade::inactive($ids);
    }

    public function activeSelectedItems(Request $request)
    {
        $ids = request('ids');
        return BrandFacade::active($ids);
    }
}
