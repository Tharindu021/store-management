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

    public function index(){
        return Inertia::render('Settings/Brands/all');
    }

    public function store(Request $request){
        return BrandFacade::create($request->all());
    }
    public function all(){
        $query = Brand::orderBy('id', 'desc');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['slug', 'name'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('name','slug')))
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return DataResource::collection($payload);

    }
    public function delete($id){
        return BrandFacade::delete($id);
    }
    public function get($id){
        $data = BrandFacade::get($id);
        return response()->json($data);
    }
    public function update(Request $request, int $id){
        return BrandFacade::update($request->all(),$id);
    }

}
