<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use domain\Facades\BrandFacade\BrandFacade;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrandsController extends Controller
{

    public function index(){
        return Inertia::render('Settings/Brands/all');
    }

    public function store(Request $request){
        return BrandFacade::create($request->all());
    }
    public function all(){
        $data = BrandFacade::all();
        return response()->json($data);

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
