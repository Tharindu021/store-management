<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use domain\Facades\BrandFacade\BrandFacade;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Filters\FuzzyFilter;
use App\Http\Resources\DataResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        if (Auth::user()->can('read_types')) {
            return BrandFacade::store($request->all());
        } else {
            $response['alert-danger'] = 'You do not have permission to read material types.';
            return redirect()->route('dashboard')->with($response);
        }
    }

    public function all(Request $request)
    {
        $query = Brand::orderBy('id');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('name' , 'slug')))
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return DataResource::collection($payload);
    }

    public function delete($id)
    {

        if (Auth::user()->can('delete_types')) {
            return BrandFacade::delete($id);
        } else {
            $response['alert-danger'] = 'You do not have permission to read material types.';
            return redirect()->route('dashboard')->with($response);
            
        }
    }

    public function get($id)
    {

        if (Auth::user()->can('read_types')) {
            $data = BrandFacade::get($id);
            return response()->json($data);
        } else {
            $response['alert-danger'] = 'You do not have permission to read material types.';
            return redirect()->route('dashboard')->with($response);
        }
    }

    public function update(Request $request, int $id)
    {

        if (Auth::user()->can('update_types')) {
            return BrandFacade::update($request->all(), $id);
        } else {
            $response['alert-danger'] = 'You do not have permission to read material types.';
            return redirect()->route('dashboard')->with($response);
        }
    }

    public function deleteSelectedItems(Request $request)
    {
        if (Auth::user()->can('delete_types')) { 
            return BrandFacade::deleteSelected($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to delete brands.';
            return redirect()->route('brand.index')->with($response);
        }
    }

    public function inactiveSelectedItems(Request $request)
    {
        if (Auth::user()->can('update_types')) {
            return BrandFacade::inactive($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to inactive brands.';
            return redirect()->route('brand.index')->with($response);
        }
    }

    public function activeSelectedItems(Request $request)
    {
        if (Auth::user()->can('update_types')) {
            return BrandFacade::active($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to inactive brands.';
            return redirect()->route('brand.index')->with($response);
        }
    }
}
