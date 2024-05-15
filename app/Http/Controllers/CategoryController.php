<?php

namespace App\Http\Controllers;

use domain\Facades\CategoryFacade\CategoryFacade;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Filters\FuzzyFilter;
use App\Http\Resources\DataResource;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class CategoryController extends ParentController
{
    public function index()
    {
        return Inertia::render('Settings/Category/all');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return CategoryFacade::store($data);
    }

    public function all()
    {
        $query = Category::orderBy('id', 'asc');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['code', 'name'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('name', 'code')))
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return DataResource::collection($payload);
    }

    public function delete($id)
    {
        return CategoryFacade::delete($id);
    }

    public function get($id)
    {
        $data = CategoryFacade::get($id);
        return response()->json($data);
    }

    public function update(Request $request, int $id)
    {
        return CategoryFacade::update($request->all(),$id);
    }

    public function deleteSelectedItems(Request $request)
    {
        $ids = request('ids');
        return CategoryFacade::deleteSelected($ids);
    }

    public function inactiveSelectedItems(Request $request)
    {
        $ids = request('ids');
        return CategoryFacade::inactive($ids);
    }

    public function activeSelectedItems(Request $request)
    {
        $ids = request('ids');
        return CategoryFacade::active($ids);
    }
}
