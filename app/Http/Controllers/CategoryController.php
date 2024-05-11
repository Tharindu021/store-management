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

class CategoryController extends Controller
{
    public function index(){
        return Inertia::render('Settings/Category/all');
    }

    public function store(Request $request){
        if (Auth::user()->can('read_types')) {
            return CategoryFacade::store($request->all());
        } else {
            // $response['alert-danger'] = 'You do not have permission to read material types.';
            // return redirect()->route('dashboard')->with($response);
            dd("no permission");
        }
        
    }

    public function all(){
        $query = Category::orderBy('id', 'asc');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['code', 'name'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('name','code')))
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return DataResource::collection($payload);
    }

    public function delete($id){
        
        if (Auth::user()->can('delete_types')) {
            return CategoryFacade::delete($id);
        } else {
            // $response['alert-danger'] = 'You do not have permission to read material types.';
            // return redirect()->route('dashboard')->with($response);
            dd("no permission");
        }
    }

    public function get($id){
        
        if (Auth::user()->can('read_types')) {
            $data = CategoryFacade::get($id);
            return response()->json($data);
        } else {
            // $response['alert-danger'] = 'You do not have permission to read material types.';
            // return redirect()->route('dashboard')->with($response);
            dd("no permission");
        }
        
    }

    public function update(Request $request, int $id){
        
        if (Auth::user()->can('update_types')) {
            return CategoryFacade::update($request->all(),$id);
        } else {
            // $response['alert-danger'] = 'You do not have permission to read material types.';
            // return redirect()->route('dashboard')->with($response);
            dd("no permission");
        }
    }
}